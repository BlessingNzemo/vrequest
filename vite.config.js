import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'node_modules/bootstrap-3-typeahead/bootstrap3-typeahead.min.js',
                'node_modules/jquery/dist/jquery.min.js',
                'node_modules/bootstrap/dist/css/bootstrap.min.css',
                'node_modules/apexcharts/dist/apexcharts.js',
                'node_modules/jquery-ui/dist/jquery-ui.js',
                'node_modules/leaflet/dist/leaflet.js',
                'node_modules/axios/dist/axios.min.js',
                'node_modules/leaflet-control-geocoder/dist/Control.Geocoder.css',
                'node_modules/leaflet/dist/leaflet.css',
                'node_modules/jquery-ui-css/jquery-ui.css',
            ],
            refresh: true,
        }),
    ],
});
