# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class @ForumCover
  constructor: ->
    @header = document.getElementsByClassName('js-forum-cover--header')
    @uploadButton = document.getElementsByClassName('js-forum-cover--upload-button')
    @removeButton = document.getElementsByClassName('js-forum-cover--remove-button')
    @overlay = document.getElementsByClassName('js-forum-cover--overlay')
    @loading = document.getElementsByClassName('js-forum-cover--loading')
    @modal = document.getElementsByClassName('js-forum-cover--modal')

    $.subscribe 'click-menu:current', @checkModal
    $(document).on 'click', '.js-forum-cover--remove-button', @remove

    $.subscribe 'dragenterGlobal', => @setOverlay('active')
    $.subscribe 'dragendGlobal', => @setOverlay('hidden')
    $(document).on 'dragenter', '.js-forum-cover--overlay', => @setOverlay('hover')
    $(document).on 'dragleave', '.js-forum-cover--overlay', => @setOverlay('active')

    $(document).on 'turbolinks:load', @refresh


  $uploadButton: => $(@uploadButton[0])


  checkModal: (e, {target}) =>
    return if target != 'forum-cover-edit'

    @initFileupload()


  hasCover: =>
    @uploadButton[0].dataset.customMethod != 'post'


  hasCoverEditor: =>
    @uploadButton.length > 0


  isModalOpen: (isModalOpen) =>
    return false if !@hasCoverEditor()

    @modal[0]?.dataset.visibility != 'hidden'


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
        @uploadButton[0].dataset.state = 'loading'

      done: (_e, data) =>
        @update(data.result)

      fail: _exported.fileuploadFailCallback

      complete: (_e, data) =>
        @uploadButton[0].dataset.state = ''

    @updateOptions()


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

    @removeButton[0].dataset.state = 'loading'

    $.ajax
      url: @uploadButton[0].dataset.url
      method: 'delete'
    .done (data) =>
      @update data
    .always =>
      @removeButton[0].dataset.state = ''


  refresh: =>
    return unless @hasCoverEditor()

    backgroundImageUrl = @uploadButton[0].dataset.fileUrl || @uploadButton[0].dataset.defaultFileUrl

    $(@header).css(backgroundImage: osu.urlPresence(backgroundImageUrl) ? '')

    @removeButton[0].disabled = !@hasCover()

    @initFileupload()
