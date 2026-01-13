import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'

export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        phoenix: {
          DEFAULT: '#18A8A6',
          dark: '#0F7F7D',
          light: '#E6F6F6',
          ink: '#0B2F2E',
        },
      },
    },
  },
  plugins: [forms],
}
