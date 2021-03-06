/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require("../css/app.css");

// require font-awesome
require("@fortawesome/fontawesome-free/css/all.min.css");
require("@fortawesome/fontawesome-free/js/all.js");

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require("jquery");

require("bootstrap");

$(document).ready(function() {
  $('[data-toggle="popover"]').popover();
});

$("#menu-toggle").click(function(e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
});

console.log("Hello Webpack Encore! Edit me in assets/js/app.js");
