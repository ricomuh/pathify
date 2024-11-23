import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        container: {
            center: true,
            padding: "3rem",
        },
        colors: {
            white: "#FFFFFF",
            primary: {
                DEFAULT: "#4696E6",
                surface: "#DAEAFA",
                border: "#C1DCF7",
                hover: "#3A7DC0",
                pressed: "#234B73",
                focus: "#DAEAFA",
            },
            secondary: {
                DEFAULT: "#50D7BE",
                surface: "#DCF7F2",
                border: "#C5F2E9",
                hover: "#43B39E",
                pressed: "#286B5F",
                focus: "#DCF7F2",
            },
            neutral: {
                10: "#FDFDFD",
                20: "#F5F5F6",
                30: "#EEEEEE",
                40: "#E2E2E3",
                50: "#C5C6C6",
                60: "#A3A4A5",
                70: "#7C7E7F",
                80: "#696B6C",
                90: "#494C4D",
                100: "#171A1B",
            },
        },
        extend: {
            fontFamily: {
                gabarito: ["Gabarito", "sans-serif"],
            },
        },
    },

    plugins: [forms],
};
