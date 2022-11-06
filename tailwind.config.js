const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
	content: [
		'./resources/**/*.blade.php',
		'./resources/**/**/*.blade.php',
		'./resources/**/*.js',
		'./vendor/usernotnull/tall-toasts/config/**/*.php',
		'./vendor/usernotnull/tall-toasts/resources/views/**/*.blade.php'
	],

	theme: {
		extend: {
			zIndex: {
				60: '60',
				70: '70',
				80: '80',
				90: '90',
				100: '100'
			}
		}
	},

	plugins: [require('@tailwindcss/forms', '@tailwindcss/typography')]
};
