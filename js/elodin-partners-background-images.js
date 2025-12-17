function fadeInWhenVisible() {
	function initFade() {
		const partnerElements = document.querySelectorAll('.partners');
		const featuredImageElements = document.querySelectorAll(
			'.partners .featured-image'
		);
		const totalElements = partnerElements.length;

		// Hide elements first
		partnerElements.forEach((el) => {
			el.style.opacity = '0';
		});
		featuredImageElements.forEach((el) => {
			el.style.opacity = '0';
		});

		// Process background colors
		processBackgroundColors(() => {
			fadeInSequentially(partnerElements);
			fadeInSequentially(featuredImageElements);
		});
	}

	function fadeInSequentially(elements) {
		const shuffledElements = [...elements].sort(() => Math.random() - 0.5);
		const baseDelay = 1000 / elements.length;
		const maxIndividualDelay = 50;

		shuffledElements.forEach((el, index) => {
			const individualDelay = Math.min(baseDelay, maxIndividualDelay);
			setTimeout(() => {
				el.style.transition = 'opacity 0.3s ease-in-out';
				el.style.opacity = '1';
			}, index * individualDelay);
		});
	}

	function processBackgroundColors(callback) {
		const imageElements = document.querySelectorAll(
			'.partners .featured-image'
		);

		// If no images exist, call callback immediately and return
		if (imageElements.length === 0) {
			callback();
			return;
		}

		let imagesProcessed = 0;

		imageElements.forEach((image) => {
			const parent = image.closest('.loop-item-inner');
			const imageUrl = image.style.backgroundImage.slice(5, -2);

			if (!imageUrl) {
				imagesProcessed++;
				if (imagesProcessed === imageElements.length) {
					callback();
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
					const alpha = pixelData[3];

					if (alpha < 255) {
						hasTransparency = true;
						break;
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
					callback();
				}
			};

			img.onerror = () => {
				console.error('Error loading image:', imageUrl);
				imagesProcessed++;
				if (imagesProcessed === imageElements.length) {
					callback();
				}
			};

			img.src = imageUrl;
		});
	}

	// Run on initial load
	initFade();

	// Run after FacetWP updates
	document.addEventListener('facetwp-loaded', initFade);
}

// Initialize
fadeInWhenVisible();
