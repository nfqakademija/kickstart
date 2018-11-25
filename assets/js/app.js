require('bootstrap');
const axios = require('axios');

let versionedFileElement = document.getElementById('versionedFile');
axios.get('/build/manifest.json')
    .then(function(response) {
        versionedFileElement.innerText = response.data['build/js/app.js'];
    })
    .catch(function (error) {
        versionedFileElement.innerText = 'Error: ' . error;
    });
