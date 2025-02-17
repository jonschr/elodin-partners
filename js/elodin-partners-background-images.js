function fadeInWhenVisible() {
	const partnerElements = document.querySelectorAll('.partners');
	const featuredImageElements = document.querySelectorAll(
		'.partners .featured-image'
	); // Get featured images
	const totalElements = partnerElements.length;

	function fadeInSequentially(elements) {
		const shuffledElements = [...elements].sort(() => Math.random() - 0.5); // Shuffle array
		const baseDelay = 1000 / totalElements; // Distribute over 1 second
		const maxIndividualDelay = 50; // Cap individual delay

		shuffledElements.forEach((el, index) => {
			const individualDelay = Math.min(baseDelay, maxIndividualDelay); // Ensure delay is not too long
			setTimeout(() => {
				el.style.transition = 'opacity 0.3s ease-in-out'; // Increased transition duration and added easing
				el.style.opacity = '1';
			}, index * individualDelay);
		});
	}

	function isElementInViewport(el) {
		const rect = el.getBoundingClientRect();
		return (
			rect.top >= 0 &&
			rect.left >= 0 &&
			rect.bottom <=
				(window.innerHeight || document.documentElement.clientHeight) &&
			rect.right <=
				(window.innerWidth || document.documentElement.clientWidth)
		);
	}

	function checkVisibilityAndFadeIn() {
		const targetElement = document.querySelector(
			'.loop-container .partners'
		);

		if (targetElement && isElementInViewport(targetElement)) {
			// Fade in after background colors are processed
			fadeInSequentially(partnerElements);
			fadeInSequentially(featuredImageElements); // Fade in featured images too

			window.removeEventListener('scroll', checkVisibilityAndFadeIn);
			window.removeEventListener('resize', checkVisibilityAndFadeIn);
		}
	}

	// Hide elements before background color processing
	partnerElements.forEach((el) => {
		el.style.opacity = '0';
	});
	featuredImageElements.forEach((el) => {
		el.style.opacity = '0';
	});

	// Process background colors immediately
	processBackgroundColors(() => {
		// Check visibility and fade in
		checkVisibilityAndFadeIn();

		// Check on scroll and resize
		window.addEventListener('scroll', checkVisibilityAndFadeIn);
		window.addEventListener('resize', checkVisibilityAndFadeIn);
	});
}

function processBackgroundColors(callback) {
	const imageElements = document.querySelectorAll(
		'.partners .featured-image'
	);
	let imagesProcessed = 0;

	imageElements.forEach((image) => {
		const parent = image.closest('.loop-item-inner');
		const imageUrl = image.style.backgroundImage.slice(5, -2);

		if (!imageUrl) {
			imagesProcessed++;
			if (imagesProcessed === imageElements.length) {
				callback(); // All images processed, execute callback
			}
			return;
		}

		const img = new Image();
		img.crossOrigin = 'Anonymous';

		img.onload = () => {
			const canvas = document.createElement('canvas');
			const ctx = canvas.getContext('2d');
			canvas.width = img.width;
			canvas.height = img.height;
			ctx.drawImage(img, 0, 0);

			const corners = [
				[5, 5],
				[canvas.width - 5, 5],
				[5, canvas.height - 5],
				[canvas.width - 5, canvas.height - 5],
			];

			let isWhite = true;
			let hasTransparency = false;

			for (const [x, y] of corners) {
				const pixelData = ctx.getImageData(x, y, 1, 1).data;
				const alpha = pixelData[3]; // Alpha value

				if (alpha < 255) {
					hasTransparency = true;
					break; // Exit loop early if transparency is found
				}

				if (
					pixelData[0] !== 255 ||
					pixelData[1] !== 255 ||
					pixelData[2] !== 255
				) {
					isWhite = false;
				}
			}

			if (hasTransparency) {
				// Do nothing
			} else if (isWhite) {
				parent.style.backgroundColor = 'white';
			} else {
				let dominantColor = '';
				let maxCount = 0;
				const colorCount = {};

				for (const [x, y] of corners) {
					const pixelData = ctx.getImageData(x, y, 1, 1).data;
					const color = `rgb(${pixelData[0]}, ${pixelData[1]}, ${pixelData[2]})`;
					colorCount[color] = (colorCount[color] || 0) + 1;
				}

				for (const color in colorCount) {
					if (colorCount[color] > maxCount) {
						maxCount = colorCount[color];
						dominantColor = color;
					}
				}

				parent.style.backgroundColor = dominantColor;
			}

			imagesProcessed++;
			if (imagesProcessed === imageElements.length) {
				callback(); // All images processed, execute callback
			}
		};

		img.onerror = () => {
			console.error('Error loading image:', imageUrl);
			imagesProcessed++;
			if (imagesProcessed === imageElements.length) {
				callback(); // All images processed, execute callback
			}
		};

		img.src = imageUrl;
	});
}

fadeInWhenVisible();
