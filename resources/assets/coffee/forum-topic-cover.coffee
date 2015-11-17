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
  #modal: document.getElementsByClassName('js-forum-topic-cover--modal')
  #openModalButton: document.getElementsByClassName('js-forum-topic-cover--open-modal')
  $uploadButton: -> $('.js-forum-topic-cover--upload-button')


  constructor: ->
    $(document).on 'click', '.js-forum-topic-cover--open-modal', @openModal
    $(document).on 'click', @closeModal


  closeModal: (e) =>
    return unless @header.length && @header[0]._open

    return if $(e.target).closest('.js-forum-topic-cover--modal').length
    return if $(e.target).closest('.js-forum-topic-cover--open-modal').length
    return if $('#overlay').is(':visible')

    $('.blackout').css display: 'none'
    @header[0].classList.remove 'forum-category-header--cover-modal'

    @$uploadButton().fileupload 'destroy'


  openModal: =>
    $('.blackout').css display: 'block'
    @header[0]._open = true
    @header[0].classList.add 'forum-category-header--cover-modal'

    $button = @$uploadButton()

    $button.fileupload
      url: $button.attr('data-url')
      dataType: 'json'
      paramName: 'topic_cover_file'
      submit: ->
        console.log 'uploading'
      done: (_e, data) =>
        cover = data.result.data
        $('.js-forum-topic-cover--input').val(cover.id)
        @header[0].style.backgroundImage = "url('#{cover.fileUrl}')"
        $button.fileupload 'option',
          url: cover.url
          method: cover.method
      fail: (_e, data) ->
        osu.ajaxError data.jqXHR
      complete: (_e, data) ->
        console.log 'upload done'
