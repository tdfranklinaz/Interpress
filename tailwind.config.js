/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.php",
    "./functions.php",
    "./components/**/*.php",
  ],
  theme: {
    // fontFamily: {
    //   'sans': ['Space\\ Grotesk', 'system-ui'],
    //   'display': ['Space\\ Grotesk', 'system-ui'],
    //   'mono': ['Space\\ Mono', 'monospace']
    // },
    extend: {},
  },
  plugins: [
    require("@tailwindcss/typography"),
    require("daisyui"),
  ],
  daisyui: {
    styled: true,
    themes: [
      {
        interpressTheme: {
          "primary": "#02AAB0",
          "secondary": "#00CDAC",
          "accent": "#A368FC",
          "neutral": "#1F2933",
          "base-100": "#27333F",
          "info": "#47A3F3",
          "success": "#00CDAC",
          "warning": "#F7C948",
          "error": "#F86A6A"
        }
      }
    ],
    base: true,
    utils: true,
    logs: true,
    rtl: false,
    prefix: "",
  }
}
