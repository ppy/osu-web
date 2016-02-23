###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License version 3
# as published by the Free Software Foundation.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
class @ForumCover
  header: document.getElementsByClassName('js-forum-cover--header')
  $uploadButton: -> $('.js-forum-cover--upload-button')
  uploadButton: document.getElementsByClassName('js-forum-cover--upload-button')
  overlay: document.getElementsByClassName('js-forum-cover--overlay')
  loading: document.getElementsByClassName('js-forum-cover--loading')


  constructor: ->
    $(document).on 'click', '.js-forum-cover--open-modal', @toggleModal
    $(document).on 'click', '.js-forum-cover--remove', @remove
    $(document).on 'click', @closeModal

    $.subscribe 'dragenterGlobal', => @setOverlay('active')
    $.subscribe 'dragendGlobal', => @setOverlay('hidden')
    $(document).on 'dragenter', '.js-forum-cover--overlay', => @setOverlay('hover')
    $(document).on 'dragleave', '.js-forum-cover--overlay', => @setOverlay('active')

    $.subscribe 'key:esc', @closeModal

    $(document).on 'ready page:load', @refresh
    @refresh()


  closeModal: (e) =>
    return unless @hasCoverEditor() && @header[0]._open

    if e
      return if $(e.target).closest('.js-forum-cover--open-modal').length
      return if $(e.target).closest('.js-forum-cover--modal').length

    return if $('#overlay').is(':visible')

    Fade.out $('.blackout')[0]
    @header[0].classList.remove 'forum-category-header--cover-modal'

    @header[0]._open = false


  hasCover: =>
    return @uploadButton[0].getAttribute('data-method') != 'post'


  hasCoverEditor: =>
    return @uploadButton.length > 0


  toggleModal: (e) =>
    e.preventDefault()

    if @header[0]._open
      @closeModal()
    else
      @openModal()


  openModal: =>
    Fade.in $('.blackout')[0]
    @header[0]._open = true
    @header[0].classList.add 'forum-category-header--cover-modal'

    $dropZone = $('.js-forum-cover--modal')

    $button = @$uploadButton()

    return if $button[0]._initialised

    $button.fileupload
      url: $button.attr('data-url')
      dataType: 'json'
      paramName: 'cover_file'
      dropZone: $dropZone
      submit: =>
        @loading[0].setAttribute('data-state', 'enabled')
      done: (_e, data) =>
        @update(data.result.data)
      fail: (_e, data) ->
        osu.ajaxError data.jqXHR
      complete: (_e, data) =>
        @loading[0].setAttribute('data-state', '')

    $button[0]._initialised = true


  setOverlay: (targetState) =>
    return unless @header.length

    return if targetState == @overlay[0].getAttribute('data-state')

    @overlay[0].setAttribute('data-state', targetState)


  update: (cover) =>
    $('.js-forum-cover--input').val(cover.id)

    $button = @$uploadButton()

    if $button[0]._initialised
      $button.fileupload 'option',
        url: cover.url
        method: cover.method

    $button.attr('data-url', cover.url)
    $button.attr('data-method', cover.method)
    $button.attr('data-file-url', cover.fileUrl)

    @refresh()


  remove: (e) =>
    e.preventDefault()

    $button = @$uploadButton()

    return unless @hasCover()

    return unless confirm e.currentTarget.getAttribute('data-destroy-confirm')

    @loading[0].setAttribute('data-state', 'enabled')
    $.ajax
      url: $button.attr('data-url')
      method: 'delete'
    .done (data) =>
      @update data.data
    .always =>
      @loading[0].setAttribute('data-state', '')


  refresh: =>
    return unless @hasCoverEditor()

    backgroundImage = if @hasCover() then "url('#{@uploadButton[0].getAttribute('data-file-url')}')" else ''
    @header[0].style.backgroundImage = backgroundImage

    $('.js-forum-cover--remove').toggleClass("forum-post-actions__action--disabled", !@hasCover())
