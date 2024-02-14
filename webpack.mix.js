const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");
const path = require("path");
const glob = require("glob-all");
const { PurgeCSSPlugin } = require("purgecss-webpack-plugin");

/* ==========================================================================
  Config
  ========================================================================== */


/* ==========================================================================
  Purge CSS Extractors
  ========================================================================== */
const TailwindExtractor = (content) => {
  return content.match(/[A-Za-z0-9-_:\/]+/g) || [];
};

/* ==========================================================================
  Laravel Mix Config
  ========================================================================== */
mix
  // handle site-wide JS files
  .scripts(["resources/js/twentytwenty.js", "resources/js/wai-dropdown.js" ,"resources/js/wai-accordion.js","resources/js/navbar.js", "resources/js/custom-jquery.js"], "dist/js/bundle.min.js")

  //Minify and move isotope to dist directory
  .scripts(
    ["resources/js/isotope.js"], "dist/js/isotope.js")

 //Minify and move swiper to dist directory
  //.js(
  //  ["resources/js/swiper.js"], "dist/js/swiper.js")

 //Minify and move People Tabs to dist directory
  .scripts(
    ["resources/js/people-tabs.js"], "dist/js/people-tabs.js")
  //.disableNotifications()

  .postCss("./resources/css/style.css", "./dist/css/style.css", [
    require("tailwindcss")("./tailwind.config.js"),
  ])

  // Minify spotlight blocks
  .minify("./blocks/spotlight/spotlight.css")

  // Move images to dist directory
  .copyDirectory("resources/images", "dist/images")

  // Move fonts to dist directory
  .copyDirectory("resources/fonts", "dist/fonts")

  .options({
    processCssUrls: false,
  })

  // BrowserSync
  .browserSync({
    proxy: "https://stage.krieger.jhu.edu/philosophy",
    host: "localhost",
    injectChanges: true,
    port: 3000,
    openOnStart: true,
    files: [
      "**/*"
    ]
  });

// remove unused CSS from files - only used when running npm run production
if (mix.inProduction()) {
  mix.options({
    uglify: {
      uglifyOptions: {
        mangle: true,

        compress: {
          warnings: false, // Suppress uglification warnings
          pure_getters: true,
          conditionals: true,
          unused: true,
          comparisons: true,
          sequences: true,
          dead_code: true,
          evaluate: true,
          if_return: true,
          join_vars: true,
        },

        output: {
          comments: false,
        },

        exclude: [/\.min\.js$/gi], // skip pre-minified libs
      },
    },
  });

  // Purge CSS config
  // more examples can be found at https://gist.github.com/jack-pallot/217a5d172ffa43c8c85df2cb41b80bad
  mix.webpackConfig({
    plugins: [
      new PurgeCSSPlugin({
        paths: glob.sync([
          path.join(__dirname, "./**/*.php"),
          path.join(__dirname, "resources/js/**/*.js")
        ]),

        extractors: [
          {
            extractor: TailwindExtractor,
            extensions: ["html", "php", "js", "vue"],
          },
        ],

        safelist: [
          "p",
          "h1",
          "h2",
          "h3",
          "h4",
          "h5",
          "h6",
          "hr",
          "ol",
          "ol li",
          "ul",
          "ul li",
          "em",
          "b",
          "strong",
          "blockquote",
          "cite",
          "wp-block-quote",
          "main-navigation",
          "nav-menu",
          "menu-main-menu-container",
          "menu-all-pages-container",
          "menu-item-has-children",
          "toggled",
          "menu-toggle",
          "sub-menu",
          "callout",
          "breadcrumbs",
          "current-item",
          "current_page_item",
          "page-numbers",
          "sticky",
          "current_page_ancestor",
          "loop-entry",
          "role-title",
          "people",
          ":after",
          ":before",
          "form",
          "ginput_container",
          "gform_footer",
          "gfield_label",
          "blog",
          "md:inline",
          "wp-post-image",
          "!list-none",
          "tablepress",
          "a:where(:not(.wp-element-button))",
          "!mt-0",
          /^has-/,
          /(^wp-block-)\w+/,
          /(^c-accordion)\w+/,
          /^wp-block-/,
          /^class/,
          /^align/,
          /^schema/,
          /([href$=])\w+/,
        ],
      }),
    ],
  });
}
