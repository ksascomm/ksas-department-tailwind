import { defineConfig } from "vite";
import path from "path";
import fs from "fs";
import { minify } from "terser"; // Modern JS minification

// ESM Imports for PostCSS plugins
import tailwindcss from "@tailwindcss/postcss";
import autoprefixer from "autoprefixer";

// Recursive directory copying helper (Mimics mix.copyDirectory)
function copyDirRecursive(src, dest) {
  if (!fs.existsSync(src)) return;

  if (!fs.existsSync(dest)) {
    fs.mkdirSync(dest, { recursive: true });
  }

  const entries = fs.readdirSync(src, { withFileTypes: true });

  for (const entry of entries) {
    const srcPath = path.join(src, entry.name);
    const destPath = path.join(dest, entry.name);

    if (entry.isDirectory()) {
      copyDirRecursive(srcPath, destPath);
    } else {
      fs.copyFileSync(srcPath, destPath);
    }
  }
}

// Custom plugin that handles multiple JS bundles & Asset Syncing
function customWordPressAssets(options) {
  const processAssets = async () => {
    const { bundles, copyDirectories, isProduction } = options;

    // 1. Process each JS bundle configuration independently
    for (const bundle of bundles) {
      const { files, outputFile } = bundle;
      const outputDir = path.dirname(outputFile);

      if (!fs.existsSync(outputDir)) {
        fs.mkdirSync(outputDir, { recursive: true });
      }

      // Concatenate files in the current bundle
      let concatenatedContent = files
        .map((file) => {
          const absolutePath = path.resolve(__dirname, file);
          if (fs.existsSync(absolutePath)) {
            return (
              `/* --- Source: ${file} --- */\n` +
              fs.readFileSync(absolutePath, "utf-8")
            );
          }
          console.warn(`\x1b[33m⚠ [assets-plugin] File not found: ${file}\x1b[0m`);
          return "";
        })
        .join("\n\n");

      // Minify this bundle if in production mode
      if (isProduction && concatenatedContent.trim().length > 0) {
        try {
          const minified = await minify(concatenatedContent, {
            compress: {
              drop_console: true, // Drops console.log statements
            },
            mangle: true,
          });
          concatenatedContent = minified.code || concatenatedContent;
          console.log(`\x1b[32m✓\x1b[0m minified JS bundle: ${path.basename(outputFile)}`);
        } catch (err) {
          console.error(`\x1b[31m✗ [Terser Error] Minification failed for ${path.basename(outputFile)}:\x1b[0m`, err);
        }
      }

      fs.writeFileSync(outputFile, concatenatedContent, "utf-8");
      console.log(`\x1b[32m✓\x1b[0m compiled JS bundle → ${outputFile}`);
    }

    // 2. Sync Static Directories (For images/fonts not loaded via CSS)
    if (copyDirectories) {
      Object.entries(copyDirectories).forEach(([srcDir, destDir]) => {
        const absoluteSrc = path.resolve(__dirname, srcDir);
        const absoluteDest = path.resolve(__dirname, destDir);
        copyDirRecursive(absoluteSrc, absoluteDest);
        console.log(`\x1b[32m✓\x1b[0m synced directory ${srcDir} → ${destDir}`);
      });
    }
  };

  return {
    name: "custom-wordpress-assets",
    async buildStart() {
      await processAssets();
    },
    async handleHotUpdate({ file }) {
      // Check if the modified file belongs to any of our configured JS bundles
      const isWatchedJS = options.bundles.some((bundle) =>
        bundle.files.some((f) => path.resolve(f) === path.resolve(file))
      );
      
      const isStaticAsset = Object.keys(options.copyDirectories || {}).some(
        (dir) => path.resolve(file).startsWith(path.resolve(dir))
      );

      if (isWatchedJS || isStaticAsset) {
        await processAssets();
      }
    },
  };
}

export default defineConfig(({ mode }) => {
  const isProduction = mode === "production";

  return {
    // Note: Update this directory name if this theme has a different folder name
    base: "/wp-content/themes/ksas-department-tailwind/dist/",

    publicDir: false, // Disables copying of default /public/ folder

    css: {
      postcss: {
        plugins: [
          tailwindcss(),
          autoprefixer()
        ],
      },
    },

    build: {
      outDir: "dist",
      assetsDir: "",
      emptyOutDir: false,
      manifest: false,
      sourcemap: !isProduction, // Generates source maps only for development builds
      
      // Forces Vite to process ALL font and image files through rollup instead of inlining them
      assetsInlineLimit: 0, 

      // Only watch during development. Turns off during production builds so it exits!
      watch: isProduction 
        ? null 
        : { exclude: ["node_modules/**", "dist/**"] },

      rollupOptions: {
        input: {
          "css/style": path.resolve(__dirname, "resources/css/style.css"),
        },
        output: {
          // Dynamic asset router. Rebuilds the original nested folder hierarchies.
          assetFileNames: (assetInfo) => {
            const info = assetInfo.name || "";
            
            if (info.endsWith(".css")) {
              return "css/style.css";
            }
            
            // Check if Rollup provided an original file location (e.g. source file system path)
            const originalPath = assetInfo.originalFileName || "";
            
            if (originalPath) {
              const resourcesIndex = originalPath.indexOf("resources/");
              if (resourcesIndex !== -1) {
                return originalPath.substring(resourcesIndex + "resources/".length);
              }
            }

            // Fallbacks if Rollup cannot find original path metadata
            if (/\.(woff2?|eot|ttf|otf)$/i.test(info)) {
              return "fonts/[name].[ext]";
            }
            if (/\.(jpe?g|png|gif|svg|webp|ico)$/i.test(info)) {
              return "images/[name].[ext]";
            }
            
            return "[name].[ext]";
          },
        },
      },
    },

    plugins: [
      customWordPressAssets({
        isProduction,
        // Define your multiple separate bundles here:
        bundles: [
          {
            // Main Site Bundle
            files: [
              "resources/js/twentytwenty.js",
              "resources/js/custom-jquery.js",
              "resources/js/wai-dropdown.js",
              "resources/js/wai-accordion.js",
              "resources/js/navbar.js",
            ],
            outputFile: path.resolve(__dirname, "dist/js/bundle.js"),
          },
          {
            // Independent Isotope Module
            files: ["resources/js/isotope.js"],
            outputFile: path.resolve(__dirname, "dist/js/isotope.js"),
          },
          {
            // Independent People Tabs Module
            files: ["resources/js/people-tabs.js"],
            outputFile: path.resolve(__dirname, "dist/js/people-tabs.js"),
          }
        ],
        // Static directories mirrored dynamically
        copyDirectories: {
          "resources/images": "dist/images",
          "resources/fonts": "dist/fonts",
        } 
      }),
    ],
  };
});