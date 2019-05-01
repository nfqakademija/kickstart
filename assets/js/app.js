const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

require('../css/app.scss');

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

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
