module.exports = {
    plugins: {
        '@tailwindcss/postcss': {},
    },
    ...(process.env.NODE_ENV === 'production' ? {
        'cssnano': {},
        'postcss-discard-comments': {removeAll: true}
    } : {})
};
