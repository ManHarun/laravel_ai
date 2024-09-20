/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    darkMode: "media",
    theme: {
        container: {
            center: true,
            padding: "16px",
        },
        extend: {
            colors: {
                primary: "#7DB0DE",
                dark: "#12395D",
                secondary: "#1D5C96",
                light: "#dbeafe",
            },
            screens: {
                "2xl": "1320px",
            },
        },
    },
    plugins: [require("@tailwindcss/typography"), require("flowbite/plugin")],
};
