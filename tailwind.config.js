const { NoEmitOnErrorsPlugin } = require("webpack");

module.exports = {
  content: [
    "./404.php",
    "./archive.php",
    "./comments.php",
    "./footer.php",
    "./front-page.php",
    "./header.php",
    "./home.php",
    "./index.php",
    "./page.php",
    "./search.php",
    "./searchform.php",
    "./sidebar.php",
    "./single.php",
    "./inc/*.php",
    "./page-templates/*.php",
    "./resources/js/*.js",
    "./resources/css/*.css",
    "./template-parts/*.php",
    "./template-parts/*/*.php",
    "./template-parts/*/*/*.php",
  ],
  theme: {
    container: {
      padding: {
          DEFAULT: '1rem',
          sm: '2rem',
          lg: '0rem'
      },
  },
    screens: {
      /*sm: "36rem",
      md: "48rem",
      lg: "62rem",
      xl: "80rem",
      "2xl": "100rem",*/
      sm: '640px',
      md: '768px',
      lg: '1024px',
      xl: '1280px',
      '2xl': '1536px',
    },
    colors: {
      primary: "#31261D",
      "old-black": "#2c2c33",
      "grey-darkest": "#4A484C",
      grey: "#e5e2e0",
      "grey-lightest": "#F8F8F8",
      "grey-cool": "#bfccd9",
      white: "#fefefe",
      blue: "#002d72",
      "blue-light": "#68ace5",
      "original-black": "#000",
    },
    fontSize: {
      base: "1rem",
      lg: "1.125rem",
      xl: "1.25rem",
      "2xl": "1.5rem",
      "3xl": "1.875rem",
      "4xl": "2.25rem",
    },
    fontWeight: {
      normal: "400",
      semibold: "600",
      bold: "700",
    },
    fontFamily: {
      sans: [
        "Gentona-Light",
        "system-ui",
        "BlinkMacSystemFont",
        "-apple-system",
        "Segoe UI",
        "sans-serif",
      ],
      serif: ["Quadon", "Georgia", "serif"],
      mono: [
        "Menlo",
        "Monaco",
        "Consolas",
        "Liberation Mono",
        "Courier New",
        "monospace",
      ],
      heavy: [
        "Gentona-Bold",
        "system-ui",
        "BlinkMacSystemFont",
        "-apple-system",
        "Segoe UI",
        "sans-serif",
      ],
      semi: [
        "Gentona-SemiBold",
        "system-ui",
        "BlinkMacSystemFont",
        "-apple-system",
        "Segoe UI",
        "sans-serif",
      ],
    },
    extend: {
      typography: {
        DEFAULT: {
          css: [
            {
              color: "#31261D",
              lineHeight: "1.6",
              fontSize: "1.25rem",
              maxWidth: "100ch",
              '--tw-prose-body': "#31261D",
              '--tw-prose-bullets': "#31261D",
              '--tw-prose-headings': "#31261D",
              '--tw-prose-links': "#002d72",
              '--tw-prose-bold': "#31261D",
              '--tw-prose-code': "#31261D",
              '--tw-prose-pre-code': "#31261D",
              '--tw-prose-pre-bg': "#f8f8f8",
              '--tw-prose-quotes': "#31261D",
              '--tw-prose-counters': "31261D",
              "ul > li::before": {
                backgroundColor: "#31261D",
              },
              "ol > li::before": {
                display: "none",
                backgroundColor: "#fefefe",
                color: "#31261D",
              },
              "ol > li": {
                display: "list-item",
              },
              "ul > li": {
                display: "list-item",
              },
              h1: {
                marginBottom: "0rem",
                fontSize: "2.25rem",
              },
              h2: {
                marginTop: "0.5rem",
                marginBottom: "0.5rem",
                maxWidth: "90ch",
                fontSize: "2rem",
              },
              h3: {
                marginTop: "0.5rem",
                marginBottom: "0.5rem",
                fontSize: "1.6rem",
              },
              h4: {
                marginTop: "0.5rem",
                marginBottom: "0.5rem",
                fontSize: "1.25rem",
              },
              p: {
                marginTop: "1rem",
                marginBottom: "1rem",
              },
              li: {
                maxWidth: "90ch",
                marginTop: "0rem",
                marginBottom: ".25rem",
              },
              a: {
                textDecoration: "none",
                transition: "none",
              },
              strong: {
                fontFamily: "Gentona-Bold, system-ui",
              },
              table: {
                fontSize: "1rem",
                marginTop: ".5rem",
                marginBottom: ".5rem",
              },
              thead: {
                color: "#31261D",
              },
              img: {
                marginTop: "1rem",
                marginBottom: "1rem",
              },
              hr: {
                marginTop: "1.25rem",
                marginBottom: "1.25rem",
                borderColor: "#bfccd9",
              },
              figure: {
                marginTop: ".5rem",
                marginBottom: ".5rem",
              },
              small: {
                fontSize: "75%",
              },
              blockquote: {
                fontFamily: "Gentona-SemiBold, system-ui",
                fontWeight: "600",
                borderLeftColor: "#bfccd9",
              },
              "blockquote p:first-of-type::before": {
                content: "none",
              },
            },
          ],
        },
        lg: {
          css: {
            maxWidth: "110ch",
            h2: {
              marginTop: "0.5rem",
              marginBottom: "0.5rem",
            },
            h3: {
              marginTop: "0.5rem",
              marginBottom: "0.5rem",
            },
            img: {
              marginTop: "0rem",
              marginBottom: "0rem",
            },
          },
        },
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require("@tailwindcss/typography")({
      modifiers: ["lg"],
    }),
  ]
};
