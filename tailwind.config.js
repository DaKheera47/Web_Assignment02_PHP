/** @type {import('tailwindcss').Config} */

let plugin = require("tailwindcss/plugin");

module.exports = {
    content: [
        "./*.php",
        "./*.html",
        "./src/**/*.php",
        "./src/**/*.component.php",
        "./src/**/*.js",
    ],

    darkMode: "class", // or 'media' or 'class'
    theme: {
        extend: {
            colors: {
                "uclan-red": "#bc1c26",
                "uclan-blue": "#37526c",
                "uclan-yellow": "#f3be00",
            },
            // https://onesheep.org/insights/animate-on-scroll-with-tailwind-css
            animation: {
                fadeIn: "fadeIn 300ms ease-in forwards",
            },
            keyframes: {
                fadeIn: {
                    "0%": { opacity: 0 },
                    "100%": { opacity: 1 },
                },
            },
        },
        variants: {
            animation: ["motion-safe"],
        },
    },

    plugins: [
        plugin(function ({ addVariant }) {
            // Add a `third` variant, ie. `third:pb-0`
            addVariant("children", "&>*");
        }),
        // https://www.npmjs.com/package/tailwind-scrollbar
        require("tailwind-scrollbar")({ nocompatible: true }),
    ],
};
