/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["*.{js,php,html}", "js/**/*.js"],
  theme: {
    extend: {},
    fontFamily: {
      'sans': ['Montserrat', 'sans-serif'],
      'serif': ['Recoleta', 'serif'],
      'display': ['Domine', 'serif'],
      'body': ['Montserrat', 'sans-serif']
    }
  },
  plugins: [],
}
