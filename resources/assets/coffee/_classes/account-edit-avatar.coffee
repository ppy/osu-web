# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute'
import { fileuploadFailCallback } from 'utils/ajax'

class window.AccountEditAvatar
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
      url: route('account.avatar')
      dataType: 'json'
      dropZone: @$main

      submit: =>
        @main[0].classList.add 'js-account-edit-avatar--saving'
        $.publish 'dragendGlobal'

      done: (_e, data) =>
        $.publish 'user:update', data.result

      fail: fileuploadFailCallback

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
