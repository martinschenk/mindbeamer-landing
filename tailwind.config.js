/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.php",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        pink: {
          100: '#FFF5F7',
          500: '#EC4899',  // True pink color matching production site
          600: '#DB2777',
          700: '#BE185D',
        },
        teal: {
          100: '#E6FFFA',
          400: '#4ECDC4',  // Keep this consistent teal color
          500: '#38B2AC',
        },
        purple: {
          400: '#9F7AEA',  // Keep this consistent purple color
          500: '#805AD5',
          600: '#6B46C1',
        },
      },
    },
  },
  plugins: [],
}
