module.exports = {
  content: ['./themes/gzalo/layouts/**/*.html'],
  darkMode: false, // or 'media' or 'class'
  theme: {
    fontFamily: {
      sans: ['Roboto', 'Arial', 'sans-serif'],
      mono: ["Roboto Mono", "ui-monospace", "SFMono-Regular"],
    },
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/typography'),
  ],
};
