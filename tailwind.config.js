/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'black-primary': {
          100: '#272B30',
          200: '#1A1D1F',
        },
      },
    },
  },
  plugins: [],
}