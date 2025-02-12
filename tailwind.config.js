const { NoEmitOnErrorsPlugin } = require("webpack");

module.exports = {
  content: {
    relative: true,
    files: [
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
    "./single-ksasexhibits.php",
    "./single-people.php",
    "./single-profile.php",
    "./single-research-highlight.php",
    "./inc/*.php",
    "./page-templates/*.php",
    "./resources/js/*.js",
    "./template-parts/*.php",
    ],
  },
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
      blue: "#002d72",
      primary: "#31261D",
      white: "#fefefe",
      grey: "#e5e2e0",
      "blue-light": "#68ace5",
      "grey-lightest": "#F8F8F8",
      "grey-cool": "#bfccd980",
      "grey-darkest": "#4A484C",
      "old-black": "#2c2c33",
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
      light: "300",
      normal: "400",
      medium: "500",
      semibold: "600",
      bold: "700",
    },
    fontFamily: {
      mono: [
        "Menlo",
        "Monaco",
        "monospace",
      ],
      sans: [
        "gentona-light",
        "system-ui",
        "BlinkMacSystemFont",
        "-apple-system",
        "Segoe UI",
        "sans-serif",
      ],
      semi: [
        "gentona-semibold",
        "system-ui",
        "BlinkMacSystemFont",
        "-apple-system",
        "Segoe UI",
        "sans-serif",
      ],
      heavy: [
        "gentona-bold",
        "system-ui",
        "BlinkMacSystemFont",
        "-apple-system",
        "Segoe UI",
        "sans-serif",
      ],
      serif: ["quadon-medium",  "Georgia", "serif"],
      serifbold: ["quadon-bold",  "Georgia", "serif"],
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
                fontWeight: "500",
                fontFamily: "quadon-bold, Georgia, serif",
              },
              h2: {
                marginTop: "0.5rem",
                marginBottom: "0.5rem",
                maxWidth: "90ch",
                fontSize: "2rem",
                fontWeight: "600",
                fontFamily: "gentona-semibold, system-ui, BlinkMacSystemFont, -apple-system, Segoe UI, sans-serif",
              },
              h3: {
                marginTop: "0.5rem",
                marginBottom: "0.5rem",
                fontSize: "1.6rem",
                fontWeight: "600",
                fontFamily: "gentona-semibold, system-ui, BlinkMacSystemFont, -apple-system, Segoe UI, sans-serif",
              },
              h4: {
                marginTop: "0.5rem",
                marginBottom: "0.5rem",
                fontSize: "1.25rem",
                fontWeight: "600",
                fontFamily: "gentona-semibold, system-ui, BlinkMacSystemFont, -apple-system, Segoe UI, sans-serif",
              },
              h5 : {
                fontWeight: "600",
                fontFamily: "gentona-semibold, system-ui, BlinkMacSystemFont, -apple-system, Segoe UI, sans-serif",
              },
              p: {
                marginTop: "1rem",
                marginBottom: "1rem",
                fontWeight: 300,
              },
              li: {
                maxWidth: "90ch",
                marginTop: "0rem",
                marginBottom: ".25rem",
                fontWeight: 300,
              },
              a: {
                textDecoration: "none",
                transition: "none",
                fontWeight: 300,
              },
              strong: {
                fontFamily: "Gentona-Bold, system-ui",
                fontWeight: 700,
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
                fontStyle: "normal",
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
            li: {
              lineHeight:"1.6",
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
