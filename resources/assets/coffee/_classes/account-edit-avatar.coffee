###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

class @AccountEditAvatar
  constructor: ->
    $(document).on 'turbolinks:load', @initialize
    $(document).on 'turbolinks:before-cache', @rollback

    $.subscribe 'dragenterGlobal', @overlayStart
    $.subscribe 'dragendGlobal', @overlayEnd
    $(document).on 'dragenter', '.js-account-edit-avatar', @overlayEnter
    $(document).on 'dragover', '.js-account-edit-avatar', @overlayHover

    @main = document.getElementsByClassName('js-account-edit-avatar')


  $button: ->
    $('.js-account-edit-avatar__button')


  initialize: =>
    return if !@main[0]?

    @isAvailable = true

    @$main = $(@main)

    @$button().fileupload
      url: laroute.route('account.avatar')
      dataType: 'json'
      dropZone: @$main

      submit: =>
        @main[0].classList.add 'js-account-edit-avatar--saving'
        $.publish 'dragendGlobal'

      done: (_e, data) =>
        $.publish 'user:update', data.result

      fail: osu.fileuploadFailCallback(@$button)

      complete: =>
        @main[0].classList.remove 'js-account-edit-avatar--saving'


  overlayEnd: =>
    return if !@isAvailable

    @main[0].classList.remove 'js-account-edit-avatar--start'


  overlayEnter: =>
    @dragging ?= true


  overlayHover: =>
    return if !@dragging

    @main[0].classList.add 'js-account-edit-avatar--hover'

    # see GlobalDrag
    Timeout.clear @overlayLeaveTimeout
    @overlayLeaveTimeout = Timeout.set 100, @overlayLeave


  overlayLeave: =>
    @dragging = null
    @main[0].classList.remove 'js-account-edit-avatar--hover'


  overlayStart: =>
    return if !@isAvailable

    @main[0].classList.add 'js-account-edit-avatar--start'


  rollback: =>
    return if !@isAvailable

    @isAvailable = false
    @$button().fileupload 'destroy'
