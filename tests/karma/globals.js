// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

'use strict';

window.currentLocale = 'en';
window.fallbackLocale = 'en';
// stub all the things
window.currentUser = {};

var audioElement = document.createElement('audio');
audioElement.className = 'js-audio';
document.body.appendChild(audioElement);
