/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                poppins: ["Poppins", "sans-serif"],
            },

            screens: {
                smallpc: "1440px",
                largepc: "1920px",
            },

            spacing: {
                "1/5": "20%",
            },

            colors: {
                transparent: "transparent",
                current: "currentColor",
                mainwhitebg: "#EDF0F5",
                darthmouthgreen: "#025C26",
                seagreen: "#1F8247",
                lemonchiffon: "#FFFBCE",
                ashgray: "#9FAFA1",
                mintgreen: "#79C586",
            },

            backgroundImage: {
                homeImg:
                    "url('/public/assets/alexander-grey-eMP4sYPJ9x0-unsplash.jpg')",
            },

            homeIcon: {
                homeico: "url('/public/assets/home-icon.svg')",
            },
        },
        plugins: [],
    },
};
