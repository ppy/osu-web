###
#    Copyright 2015-2017 ppy Pty. Ltd.
#
#    This file is part of osu!web. osu!web is distributed with the hope of
#    attracting more community contributions to the core ecosystem of osu!.
#
#    osu!web is free software: you can redistribute it and/or modify
#    it under the terms of the Affero GNU General Public License version 3
#    as published by the Free Software Foundation.
#
#    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
#    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
#    See the GNU Affero General Public License for more details.
#
#    You should have received a copy of the GNU Affero General Public License
#    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###

class @BeatmapsetDownloadObserver
  targetSelector: '.support-osu-popup'
  container: '#popup-container'
  wrapperClass: 'empty-popup'

  constructor: ->
    $(document).on 'click mouseup', '.js-beatmapset-download-link', @quotaCheck


  quotaCheck: (e) =>
    return if currentUser?.is_supporter
    return if (e.type == 'mouseup' && e.which != 2) # we only use mouseup to catch middle-click

    $.ajax laroute.route('download-quota-check')
    .done (json) =>
      downloaded = json.quota_used
      # after 20 downloads and every multiple of 50 thereafter, maybe move this to a config var later?
      if (downloaded == 20 || (downloaded > 0 && downloaded % 50 == 0))
        @loadAndShowPopup


  loadAndShowPopup: =>
    if $(@targetSelector).length == 0
      $.get laroute.route('support-osu-popup'), (data) =>
        @createPopup data
        @showPopup()
    else
      @showPopup()


  createPopup: (content) =>
    return if content is undefined

    $popup = $(".#{@wrapperClass}--clone").clone()
    $popup.removeClass "#{@wrapperClass}--clone"
    $popup.find('.popup-content').html content
    $popup.find('.support-osu-popup__close-button').on 'click', (e) ->
      e.preventDefault()
      $popup.fadeOut()
      Blackout.hide()

    $popup.appendTo($(@container))


  showPopup: =>
    document.activeElement.blur?()
    Blackout.show()
    $(@targetSelector).parents(".#{@wrapperClass}").fadeIn()
