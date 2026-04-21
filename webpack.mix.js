const mix = require("laravel-mix");
const path = require("path");
const webpack = require('webpack');

/* ==========================================================================
  Laravel Mix Config
  ========================================================================== */
mix.options({
    showStepProgress: false
});

mix.setResourceRoot("../");
mix.setPublicPath(path.resolve("./"));

// Watch Options: Keep the build quiet and ignore dist files to prevent infinite loops
mix.webpackConfig({
  stats: { children: true },
  watchOptions: {
    ignored: /node_modules|dist/,
  },
  plugins: [
        // Provide an empty object to satisfy the new Webpack 5.105 schema
        new webpack.ProgressPlugin({})
    ]
});

/* ==========================================================================
  JavaScript Bundling
  ========================================================================== */

// Main Site Bundle
mix.scripts(
  [
    "resources/js/twentytwenty.js",
    "resources/js/custom-jquery.js",
    "resources/js/wai-dropdown.js",
    "resources/js/wai-accordion.js",
    "resources/js/navbar.js",
  ],
  "dist/js/bundle.min.js",
);

// Independent Modules (Keep as separate files for conditional loading)
mix.scripts(["resources/js/isotope.js"], "dist/js/isotope.js");
mix.scripts(["resources/js/people-tabs.js"], "dist/js/people-tabs.js");

/* ==========================================================================
  CSS Processing
  ========================================================================== */
// Note: Ensure your tailwind.config.js handles the 'content' paths
// so Tailwind's built-in Purge engine works correctly.
mix.postCss("resources/css/style.css", "dist/css/style.css", [
  require("@tailwindcss/postcss"),
  require("autoprefixer"),
]);

mix.options({
  processCssUrls: false, // Prevents Mix from trying to "fix" font/image paths in CSS
  manifest: false, // WordPress themes rarely need a mix-manifest.json
  terser: {
    terserOptions: {
      compress: { drop_console: mix.inProduction() },
    },
  },
});

/* ==========================================================================
  Production Only
  ========================================================================== */
// remove unused CSS from files - only used when running npm run production
if (mix.inProduction()) {
  // Minify and Versioning
  mix.minify("dist/js/bundle.min.js");
  mix.version();

  // Asset Management
  mix.copyDirectory("resources/images", "dist/images");
  mix.copyDirectory("resources/fonts", "dist/fonts");
}
