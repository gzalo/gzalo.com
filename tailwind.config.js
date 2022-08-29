module.exports = {
  content: ['./themes/gzalo/layouts/**/*.html', './content/**/*.md'],
  darkMode: false, // or 'media' or 'class'
  theme: {
    fontFamily: {
      sans: ['Roboto', 'Arial', 'sans-serif'],
      mono: ["Roboto Mono", "ui-monospace", "SFMono-Regular"],
    },
    extend: {
      typography: {
        DEFAULT: {
            css: {
                "code::before": {content: ''},
                "code::after": {content: ''}
            }
        }
      }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/typography'),
  ],
};
