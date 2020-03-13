# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

$(document).on 'ajax:before', ->
  LoadingOverlay.show()
  $(document).one 'ajax:complete.ujsHideLoadingOverlay', LoadingOverlay.hide


$(document).on 'ajax:success', (event, data) ->
  showPopup = ->
    return if _.isEmpty data?.message
    osu.popup data.message, 'success'

  if event.target.getAttribute('data-reload-on-success') == '1'
    resetScroll = event.target.getAttribute('data-reload-reset-scroll') == '1'

    $(document).one 'turbolinks:load', showPopup
    osu.reloadPage(!resetScroll)
  else
    showPopup()


$(document).on 'ajax:error', (event, xhr) ->
  return if event.target.dataset.skipAjaxErrorPopup == '1'
  # authentication logic is handled in user-dropdown-modal.js
  return if xhr.status == 401

  osu.ajaxError xhr
