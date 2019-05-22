import {NfqTeams} from "./nfqTeams";
import {teamsData} from "./teamsData";

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
    let data = teamsData;
    let domElement = document.getElementById('dynamicMember');
    if (NfqTeams && domElement) {
        domElement.innerHTML = 'Giedriaus komanda: ' + NfqTeams.getTeamByMentor(data, 'Giedrius Gerulis');
    }
});
