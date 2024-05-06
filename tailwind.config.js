// import preset from './vendor/filament/support/tailwind.config.preset';
// import forms from '@tailwindcss/forms';

// /** @type {import('tailwindcss').Config} */

// export default {
//     content: [
//         './app/Filament/**/*.php',
//         './resources/views/filament/**/*.blade.php',
//         './vendor/filament/**/*.blade.php',
//     ],
//     theme: {
//         extend: {},
//       },
//     plugins: [forms],
// }

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    theme: {
        extend: {},
    },
    plugins: [],
}