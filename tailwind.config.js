import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import { iconsPlugin, getIconCollections } from '@egoist/tailwindcss-icons';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        forms,
        iconsPlugin({
            // Sélectionner les collections d'icônes qu'on veut utiliser
            collections: getIconCollections([
                'lucide',      
                'heroicons',    
                'tabler',      
                'material-symbols', 
            ])
        })
    ],
};