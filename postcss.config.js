module.exports = {
  plugins: {
    'postcss-import': {},
    'postcss-simple-vars': {},
    'tailwindcss/nesting': {},
    'tailwindcss': {},
    'postcss-font-display': {
      display: 'swap',
      replace: false
    },
    'autoprefixer': {},
    'postcss-sort-media-queries': {
      sort: 'mobile-first'
    }
  },
};
