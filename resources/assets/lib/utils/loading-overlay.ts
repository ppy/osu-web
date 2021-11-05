# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

overlay = document.getElementsByClassName 'js-loading-overlay'


show = ->
  return if overlay.length == 0

  overlay[0].classList.add 'loading-overlay--visible'


show = _.debounce show, 5000, maxWait: 5000


hide = ->
  return if overlay.length == 0

  show.cancel()
  overlay[0].classList.remove 'loading-overlay--visible'


window.LoadingOverlay =
  show: show
  hide: hide
