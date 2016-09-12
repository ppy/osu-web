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
  $uploadButton: => $(@uploadButton[0])
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

    $(document).on 'ready turbolinks:load', @refresh
    @refresh()


  closeModal: (e) =>
    return unless @hasCoverEditor() && @isModalOpen()

    if e
      return if $(e.target).closest('.js-forum-cover--open-modal').length
      return if $(e.target).closest('.js-forum-cover--modal').length

    return if $('#overlay').is(':visible')

    Fade.out $('.blackout')[0]
    @header[0].classList.remove 'forum-category-header--cover-modal'

    @isModalOpen(false)


  hasCover: =>
    @uploadButton[0].dataset.customMethod != 'post'


  hasCoverEditor: =>
    @uploadButton.length > 0


  isModalOpen: (isModalOpen) =>
    return false if !@hasCoverEditor()

    if isModalOpen?
      @header[0].dataset.isModalOpen = if isModalOpen then '1' else ''

    @header[0].dataset.isModalOpen == '1'


  initFileupload: =>
    return unless @isModalOpen()
    return if @uploadButton[0]._initialized

    @uploadButton[0]._initialized = true

    $dropZone = $('.js-forum-cover--modal')

    @$uploadButton().fileupload
      method: 'POST'
      paramName: 'cover_file'
      dataType: 'json'
      dropZone: $dropZone

      submit: =>
        @loading[0].dataset.state = 'enabled'

      done: (_e, data) =>
        @update(data.result.data)

      fail: osu.fileuploadFailCallback(@$uploadButton())

      complete: (_e, data) =>
        @loading[0].dataset.state = ''

    @updateOptions()


  toggleModal: (e) =>
    e.preventDefault()

    if @isModalOpen()
      @closeModal()
    else
      @openModal()


  openModal: =>
    Fade.in $('.blackout')[0]
    @isModalOpen(true)
    @header[0].classList.add 'forum-category-header--cover-modal'

    @initFileupload()


  setOverlay: (targetState) =>
    return unless @hasCoverEditor()

    return if targetState == @overlay[0].getAttribute('data-state')

    @overlay[0].setAttribute('data-state', targetState)


  update: (cover) =>
    $('.js-forum-cover--input').val(cover.id)

    @uploadButton[0].dataset.url = cover.url
    @uploadButton[0].dataset.customMethod = cover.method
    @uploadButton[0].dataset.fileUrl = cover.fileUrl || ''

    @updateOptions()
    @refresh()


  updateOptions: =>
    return unless @uploadButton[0]._initialized

    @$uploadButton().fileupload 'option',
      url: @uploadButton[0].dataset.url
      formData:
        _method: @uploadButton[0].dataset.customMethod


  remove: (e) =>
    e.preventDefault()

    return if !@hasCover()

    return if !confirm(e.currentTarget.dataset.destroyConfirm)

    @loading[0].dataset.state = 'enabled'

    $.ajax
      url: @uploadButton[0].dataset.url
      method: 'delete'
    .done (data) =>
      @update data.data
    .always =>
      @loading[0].dataset.state = ''


  refresh: =>
    return unless @hasCoverEditor()

    backgroundImageUrl = @uploadButton[0].dataset.fileUrl || @uploadButton[0].dataset.defaultFileUrl || null

    backgroundImage = if backgroundImageUrl? then "url('#{backgroundImageUrl}')" else ''
    @header[0].style.backgroundImage = backgroundImage

    $('.js-forum-cover--remove').toggleClass('forum-post-actions__action--disabled', !@hasCover())

    @initFileupload()
