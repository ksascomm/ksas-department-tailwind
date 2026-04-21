KSAS Department Tailwind Theme
==============================

A block-centric WordPress theme built for Johns Hopkins University (KSAS) departments. This theme leverages the utility-first power of **Tailwind CSS** on a foundation scaffolded from **\_s (Underscores)** and **Twenty Twenty**.

🚀 Features
-----------

*   **Tailwind CSS Integration**: Optimized for modern UI development with a utility-first workflow.
*   **Hybrid Architecture**: Combines the lightweight efficiency of Underscores with the refined block styling of Twenty Twenty.
*   **Laravel Mix Pipeline**: Simplified asset compilation and Webpack management.
*   **Responsive & Accessible**: Built to meet JHU branding and accessibility standards.

🛠 Prerequisites
----------------

Ensure you have the following installed in your development environment:

*   [Node.js](https://nodejs.org/) (LTS recommended)
*   [NPM](https://www.npmjs.com/)
*   A local WordPress development environment (e.g., LocalWP, MAMP, or Lando)

📦 Installation
---------------

1.  **Navigate** to your WordPress themes directory:
    
        cd wp-content/themes/
    
2.  **Clone** this repository:
    
        git clone https://github.com/ksascomm/ksas-department-tailwind.git
    
3.  **Install** the required Node packages:
    
        npm install
    

💻 Development Workflow
-----------------------

The asset pipeline is managed via Laravel Mix. Use the following commands during development:

### Initial/Single Build

To compile assets for development without minification:

    npm run dev

### Active Development

To watch for changes in your CSS, JS, and PHP files and trigger automatic recompilation:

    npm run watch

### Production Build

To compile and minify assets for the live environment (this triggers Tailwind's optimization/purging):

    npm run production

📂 Key Files
------------

*   `webpack.mix.js`: Configuration for Laravel Mix asset paths.
*   `inc/`: Theme-specific PHP functions, hooks, and custom template logic.
*   `template-parts/`: Reusable theme components and block-based templates.

* * *

**Built & Maintained by [KSAS Communications](https://github.com/ksascomm)**