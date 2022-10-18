/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./www/*/**.{html,php,js,pug}",
    './www/components/*.pug',
    './www/*.pug',
  ],
  darkMode: "class",
  theme: {
    extend: {},
    fontFamily: {
      'sans': ['Montserrat', 'sans-serif'],
      'serif': ['Recoleta', 'serif'],
      'display': ['Domine', 'serif'],
      'body': ['Montserrat', 'sans-serif']
    }
  },
  variants: {
    extend: {},
  },
  plugins: [],
};
