//公式のをそのままコピーして使う
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/**/*.blade.php',

  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
