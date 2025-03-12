const mix = require('laravel-mix');
const globImporter = require('node-sass-glob-importer');

mix.sass('css/elodin-partners.scss', 'css', {
	sassOptions: {
		importer: globImporter(),
	},
}).options({
	processCssUrls: false,
});
