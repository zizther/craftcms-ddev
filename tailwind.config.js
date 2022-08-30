// tailwind.config.js
const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
  content: [
    './templates/**/*.{html,twig,html.twig}',
    './src/js/**/*.{js,jsx,ts,tsx,vue}'
  ],
  safelist: [
    {
      pattern: /c/ // secures any class starting with `c-`
    }
  ],
  darkMode: 'class', // or 'media' or 'class'
  theme: {
    extend: {
    },
    zIndex: {
      'minus': '-1',
      '0': 0,
      '1': 1,
      '2': 2,
      '3': 3,
      '4': 4,
      '5': 5,
      '6': 6,
      '7': 7,
      '8': 8,
      '9': 9,
      '10': 10,
      '20': 20,
      '30': 30,
      '40': 40,
      '50': 50,
      '60': 60,
      '70': 70,
      '80': 80,
      '90': 90,
      '100': 100,
      'auto': 'auto',
    },
  },
  corePlugins: {
    container: false,
  },
  plugins: [],
}
