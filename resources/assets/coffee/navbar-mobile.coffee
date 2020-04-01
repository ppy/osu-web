# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

topIcon = document.getElementsByClassName('js-navbar-mobile--top-icon')

$(document).on 'show.bs.collapse', '.js-navbar-mobile--menu', ->
  Fade.out topIcon[0]

$(document).on 'hide.bs.collapse', '.js-navbar-mobile--menu', ->
  Fade.in topIcon[0]
