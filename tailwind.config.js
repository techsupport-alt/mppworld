/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",
    "./index.php",
    "./components/**/*.{js,ts,jsx,tsx,php}",
    "./js/**/*.{js,ts}",
    "./*.{html,php}"
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        // MMP Brand Colors
        'mmp-orange': '#FF6600',
        'mmp-orange-dark': '#CC5500',
        'mmp-orange-light': '#FF8533',
        'mmp-brown': '#8B4513',
        'mmp-brown-dark': '#6B3E2A',
        'mmp-brown-light': '#A0522D',
        'mmp-white': '#FFFFFF',
        'mmp-black': '#000000',
        'mmp-charcoal': '#1A1A1A',
        'mmp-cream': '#FFF8F0',
        
        // Dark Theme Colors
        'background': '#0A0A0A',
        'foreground': '#FFFFFF',
        'muted': '#1A1A1A',
        'muted-foreground': '#CCCCCC',
        'card': '#1A1A1A',
        'card-foreground': '#FFFFFF',
        'border': '#333333',
        'ring': '#FF6600',
        'secondary': '#2A2A2A',
        'secondary-foreground': '#FFFFFF',
        
        // Semantic Colors with Good Contrast
        'primary': '#FF6600',
        'primary-foreground': '#FFFFFF',
        'accent': '#8B4513',
        'accent-foreground': '#FFFFFF',
      },
      fontFamily: {
        'heading': ['Montserrat', 'sans-serif'],
        'body': ['Inter', 'sans-serif'],
      },
      animation: {
        'fade-in': 'fadeIn 0.5s ease-in-out',
        'slide-up': 'slideUp 0.5s ease-out',
        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        slideUp: {
          '0%': { transform: 'translateY(10px)', opacity: '0' },
          '100%': { transform: 'translateY(0)', opacity: '1' },
        }
      }
    },
  },
  plugins: [],
}
