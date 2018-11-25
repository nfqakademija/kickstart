require('bootstrap');
const axios = require('axios');

axios.get('/build/manifest.json')
    .then(function(response) {
        console.log(response.data);
    })
    .catch(function (error) {
        console.error(error);
    });
