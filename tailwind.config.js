module.exports = {
  content: ['./themes/gzalo/layouts/**/*.html', './content/**/*.md'],
  darkMode: false, // or 'media' or 'class'
  theme: {
    fontFamily: {
      sans: ['Roboto', 'Arial', 'sans-serif'],
      mono: ["Roboto Mono", "ui-monospace", "SFMono-Regular"],
    },
    borderWidth: {
      DEFAULT: '1px',
      '0': '0',
      '2': '2px',
      '3': '3px',
      '4': '4px',
      '8': '8px',
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
    require('@tailwindcss/forms'),
  ],
};
