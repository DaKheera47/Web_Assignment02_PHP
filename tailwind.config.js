/** @type {import('tailwindcss').Config} */

// let plugin = require("tailwindcss/plugin");

module.exports = {
    // content: ["./*.php", "./*.html", "./src/**/*.php", "./src/**/*.component.php"],
    content: ["./*.php", "./*.html", "./src/**/*.php", "./src/**/*.component.php"],
    theme: {
        extend: {
            colors: {
                "uclan-red": "#bc1c26",
                "uclan-blue": "#37526c",
                "uclan-yellow": "#f3be00",
            },
        },
    },
    // plugins: [
    //     plugin(function ({ addVariant }) {
    //         // Add a `third` variant, ie. `third:pb-0`
    //         addVariant("children", "&>*");
    //     }),
    // ],
};
