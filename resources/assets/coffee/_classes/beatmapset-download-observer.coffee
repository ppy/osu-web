# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class @BeatmapsetDownloadObserver
  targetSelector: '.js-support-osu-popup'
  container: '#popup-container'

  constructor: ->
    $(document).on 'click mouseup', '.js-beatmapset-download-link', @quotaCheck


  $currentPopup: => $(@targetSelector)


  quotaCheck: (e) =>
    return if currentUser?.is_supporter
    return if (e.type == 'mouseup' && e.which != 2) # we only use mouseup to catch middle-click

    $.ajax laroute.route('download-quota-check')
    .done (json) =>
      downloaded = json.quota_used
      # after 20 downloads and every multiple of 50 thereafter, maybe move this to a config var later?
      if (downloaded == 20 || (downloaded > 0 && downloaded % 50 == 0))
        @loadAndShowPopup()


  loadAndShowPopup: =>
    if $(@targetSelector).length == 0
      $.get laroute.route('support-osu-popup'), (data) =>
        @createPopup data
        @showPopup()
    else
      @showPopup()


  createPopup: (content) =>
    return unless content?

    $popup = $(content)

    $popup.appendTo($(@container))


  showPopup: =>
    document.activeElement.blur?()
    Blackout.show()
    @$currentPopup().fadeIn()

    close = (immediate = false) =>
      if immediate
        @$currentPopup().hide()
      else
        @$currentPopup().fadeOut()
      Blackout.hide()
      $(document).off('.support-osu-popup')

    maybeClose = (e) =>
      close() if e.target.closest("#{@targetSelector}--close")? || !e.target.closest(@targetSelector)?

    $(document).on('click.support-osu-popup', maybeClose)
    $(document).on('turbolinks:before-cache.support-osu-popup', -> close(true))
