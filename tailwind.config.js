/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["views/**/*.{js,php,html,pug}", "js/**/*.js"],
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
