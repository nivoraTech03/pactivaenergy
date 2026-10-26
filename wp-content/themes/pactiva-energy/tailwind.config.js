/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.php',
    './templates/**/*.php',
    './template-parts/**/*.php',
    './inc/**/*.php',
    './woocommerce/**/*.php',
    './assets/js/**/*.js'
  ],
  theme: {
    extend: {
      colors: {
        brand: {
          orange: '#FF8A00',
          deep: '#E96F00',
          amber: '#FFA233',
          black: '#0B0B0D',
          dark: '#16171A',
          charcoal: '#202124',
          slate: '#2D3139',
          light: '#F5F6F8',
          border: '#E2E8F0',
          muted: '#667085',
          green: '#10B981',
          cyan: '#06B6D4'
        }
      },
      fontFamily: {
        sans: ['"Plus Jakarta Sans"', 'Inter', 'system-ui', '-apple-system', 'sans-serif'],
        heading: ['"Plus Jakarta Sans"', '"Outfit"', 'sans-serif'],
        mono: ['"Space Grotesk"', 'ui-monospace', 'monospace'],
        tech: ['"Space Grotesk"', 'sans-serif']
      },
      boxShadow: {
        'glow': '0 0 25px rgba(255, 138, 0, 0.25)',
        'glow-lg': '0 0 40px rgba(255, 138, 0, 0.35)',
        'card': '0 4px 20px -2px rgba(11, 11, 13, 0.06)',
        'card-hover': '0 12px 30px -4px rgba(11, 11, 13, 0.12)'
      }
    },
  },
  plugins: [],
}
