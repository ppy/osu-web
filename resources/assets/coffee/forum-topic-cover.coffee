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
class @ForumTopicCover
  header: document.getElementsByClassName('js-forum-topic-cover--header')
  $uploadButton: -> $('.js-forum-topic-cover--upload-button')
  uploadButton: document.getElementsByClassName('js-forum-topic-cover--upload-button')


  constructor: ->
    $(document).on 'click', '.js-forum-topic-cover--open-modal', @openModal
    $(document).on 'click', '.js-forum-topic-cover--remove', @remove
    $(document).on 'click', @closeModal

    $(document).on 'ready page:load', @refresh
    @refresh()


  closeModal: (e) =>
    return unless @header.length && @header[0]._open

    return if $(e.target).closest('.js-forum-topic-cover--modal').length
    return if $(e.target).closest('.js-forum-topic-cover--open-modal').length
    return if $('#overlay').is(':visible')

    $('.blackout').css display: 'none'
    @header[0].classList.remove 'forum-category-header--cover-modal'

    @header[0]._open = false
    @$uploadButton().fileupload 'destroy'


  hasCover: =>
    return @uploadButton[0].getAttribute('data-method') != 'post'


  openModal: (e) =>
    e.preventDefault()

    $('.blackout').css display: 'block'
    @header[0]._open = true
    @header[0].classList.add 'forum-category-header--cover-modal'

    $dropZone = $('.js-forum-topic-cover--modal')

    $button = @$uploadButton()

    $button.fileupload
      url: $button.attr('data-url')
      dataType: 'json'
      paramName: 'topic_cover_file'
      formData:
        topic_id: $button.attr('data-topic-id')
      dropZone: $dropZone
      submit: ->
        console.log 'uploading'
      done: (_e, data) =>
        @update(data.result.data)
      fail: (_e, data) ->
        osu.ajaxError data.jqXHR
      complete: (_e, data) ->
        console.log 'upload done'


  update: (cover) =>
    $('.js-forum-topic-cover--input').val(cover.id)

    $button = @$uploadButton()

    if @header[0]._open
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

    $.ajax
      url: $button.attr('data-url')
      method: 'delete'
    .success (data) =>
      @update data.data


  refresh: =>
    return unless @header.length

    backgroundImage = if @hasCover() then "url('#{@uploadButton[0].getAttribute('data-file-url')}')" else ''
    @header[0].style.backgroundImage = backgroundImage

    $('.js-forum-topic-cover--remove').toggleClass("forum-post-actions__action--disabled", !@hasCover())
