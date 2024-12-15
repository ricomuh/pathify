import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

const animate = require("tailwindcss-animate");

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            container: {
                center: true,
                padding: {
                    DEFAULT: "1rem",
                    md: "1.5rem",
                    lg: "2rem",
                    "2xl": "3rem",
                },
                screens: {
                    sm: "100%",
                    md: "100%",
                    lg: "1120px",
                    xl: "1280px",
                    "2xl": "1440px",
                },
            },
            backgroundImage: {
                home: "linear-gradient(180deg, #171A1B 20%, rgba(23, 26, 27, 0.90) 100%)",
                "box-course":
                    "linear-gradient(180deg, rgba(23, 26, 27, 0.00) 25%, rgba(23, 26, 27, 0.80) 70%, #171A1B 95%)",
            },
            borderRadius: {
                DEFAULT: "0.25rem",
                md: "0.375rem",
                lg: "0.5rem",
                xl: "0.75rem",
                "2xl": "1rem",
                "3xl": "1.5rem",
                full: "9999px",
            },
            keyframes: {
                "accordion-down": {
                    from: { height: 0 },
                    to: { height: "var(--radix-accordion-content-height)" },
                },
                "accordion-up": {
                    from: { height: "var(--radix-accordion-content-height)" },
                    to: { height: 0 },
                },
                "collapsible-down": {
                    from: { height: 0 },
                    to: { height: "var(--radix-collapsible-content-height)" },
                },
                "collapsible-up": {
                    from: { height: "var(--radix-collapsible-content-height)" },
                    to: { height: 0 },
                },
            },
            animation: {
                "accordion-down": "accordion-down 0.2s ease-out",
                "accordion-up": "accordion-up 0.2s ease-out",
                "collapsible-down": "collapsible-down 0.2s ease-in-out",
                "collapsible-up": "collapsible-up 0.2s ease-in-out",
            },
            fontSize: {
                xxs: ".625rem",
                xs: ".75rem",
                sm: ".875rem",
                base: "1rem",
                lg: "1.125rem",
                xl: "1.25rem",
                "xl-plus": "1.3125rem",
                "2xl": "1.5rem",
                "2xl-plus": "1.75rem",
                "3xl": "1.875rem",
                "3xl-plus": "2rem",
                "4xl": "2.25rem",
                "4xl-plus": "2.3125rem",
                "5xl": "3rem",
                "5xl-plus": "3.0625rem",
                "6xl": "4rem",
                "6xl-plus": "4.5rem",
                "7xl": "5rem",
                "8xl": "6rem",
                "9xl": "8rem",
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
                red: {
                    100: "#FEE2E2",
                    200: "#FECACA",
                    300: "#FCA5A5",
                    400: "#F87171",
                    500: "#EF4444",
                    600: "#DC2626",
                    700: "#B91C1C",
                    800: "#991B1B",
                    900: "#7F1D1D",
                },
                yellow: {
                    100: "#FFFBEB",
                    200: "#FEF3C7",
                    300: "#FDE68A",
                    400: "#FCD34D",
                    500: "#FBBF24",
                    600: "#F59E0B",
                    700: "#D97706",
                    800: "#B45309",
                    900: "#92400E",
                },
                green: {
                    100: "#ECFDF5",
                    200: "#D1FAE5",
                    300: "#A7F3D0",
                    400: "#6EE7B7",
                    500: "#34D399",
                    600: "#10B981",
                    700: "#059669",
                    800: "#047857",
                    900: "#065F46",
                },
                blue: {
                    100: "#EFF6FF",
                    200: "#DBEAFE",
                    300: "#BFDBFE",
                    400: "#93C5FD",
                    500: "#60A5FA",
                    600: "#3B82F6",
                    700: "#2563EB",
                    800: "#1D4ED8",
                    900: "#1E40AF",
                },
                indigo: {
                    100: "#EEEDFF",
                    200: "#DDD9FE",
                    300: "#B4A9F6",
                    400: "#8B5CF6",
                    500: "#7C3AED",
                    600: "#6D28D9",
                    700: "#5B21B6",
                    800: "#4C1D95",
                    900: "#321E6C",
                },
                purple: {
                    100: "#F5F3FF",
                    200: "#EDE9FE",
                    300: "#DDD6FE",
                    400: "#C4B5FD",
                    500: "#A78BFA",
                    600: "#8B5CF6",
                    700: "#7C3AED",
                    800: "#6D28D9",
                    900: "#5B21B6",
                },
                pink: {
                    100: "#FDF2F8",
                    200: "#FCE7F3",
                    300: "#FBCFE8",
                    400: "#F9A8D4",
                    500: "#F472B6",
                    600: "#EC4899",
                    700: "#DB2777",
                    800: "#BE185D",
                    900: "#9D174D",
                },
                gray: {
                    100: "#F5F5F5",
                    200: "#EEEEEE",
                    300: "#E0E0E0",
                    400: "#BDBDBD",
                    500: "#9E9E9E",
                    600: "#757575",
                    700: "#616161",
                    800: "#424242",
                    900: "#212121",
                },
                destructive: {
                    DEFAULT: "hsl(var(--destructive))",
                    foreground: "hsl(var(--destructive-foreground))",
                },
                muted: {
                    DEFAULT: "hsl(var(--muted))",
                    foreground: "hsl(var(--muted-foreground))",
                },
                accent: {
                    DEFAULT: "hsl(var(--accent))",
                    foreground: "hsl(var(--accent-foreground))",
                },
                popover: {
                    DEFAULT: "hsl(var(--popover))",
                    foreground: "hsl(var(--popover-foreground))",
                },
                card: {
                    DEFAULT: "hsl(var(--card))",
                    foreground: "hsl(var(--card-foreground))",
                },
            },
            fontFamily: {
                gabarito: ["Gabarito", "sans-serif"],
            },
        },
    },

    plugins: [forms, animate],
};
