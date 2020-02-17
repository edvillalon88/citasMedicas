/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.css';
import '../css/sb-admin-2.min.css';
import '../css/global.scss';
require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');
const $ = require('jquery');
require('jquery.easing')($);
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

// or you can include specific pieces
require('bootstrap/js/dist/tooltip');
require('bootstrap/js/dist/popover');
var dt = require( 'datatables.net' )( window, $ );
var Chart = require('chart.js');
var myChart = new Chart(ctx);
$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
    $('table').dataTable();
});
// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';
require('./sb-admin-2.min.js')
console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
