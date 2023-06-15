/** @type {import('tailwindcss').Config} */
const colors = require("tailwindcss/colors");
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./src/**/*.{html,js}",
        "./node_modules/tw-elements/dist/js/**/*.js",
    ],
    theme: {
        extend: {
            backgroundImage: {
                "hero-pattern":
                    "linear-gradient(to top, rgba(115, 104, 92, 1), rgba(0,0,0, 0)), url('https://hips.hearstapps.com/hmg-prod/images/enjoying-the-beauty-of-the-beach-while-working-out-royalty-free-image-621495090-1530543183.jpg?crop=1.00xw:0.835xh;0,0.0732xh&resize=1200:*')",
            },
            fontFamily: {
                poppins: ["Poppins", "sans-serif"],
            },
        },
    },
    plugins: [],
};

