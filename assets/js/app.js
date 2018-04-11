/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');
require('bootstrap');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});

const axios = require('axios');
if (typeof usingVersionedFileJs !== "undefined") {
    let versionedFileElement = document.getElementById('versionedFile');
    axios.get('/build/manifest.json')
        .then(function (response) {
            versionedFileElement.innerText = response.data['build/app.js'];
        })
        .catch(function (error) {
            versionedFileElement.innerText = 'Error: '.error;
        });
}
