'use strict';

window.currentLocale = 'en';
// stub all the things
window.currentUser = {};

var audioElement = document.createElement('audio');
audioElement.className = 'js-audio';
document.body.appendChild(audioElement);
