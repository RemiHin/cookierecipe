module.exports = {
  content: ['./resources/views/**/*.blade.php',],
  theme: {
    extend: {},
  },
  plugins: [
      require('@tailwindcss/forms'),
  ],
}
