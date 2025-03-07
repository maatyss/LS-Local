/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      fontFamily: {
        lato: ['Lato', 'serif'],
        nunito: ['Nunito', 'sans-serif'],
      },
      colors: {
        lavender: '#FCEFEF',
        silver: '#BDBDBD',
        electric: {
          blue: '#0D47A1',
        },
        neon: {
          orange: '#FF9800',
          purple: '#9C27B0',
          red: '#E53935',
          green: '#4CAF50',
          pink: '#FF4081',
          yellow: '#FFFF00',
        },
      },
    },
  },
  plugins: [],
}

