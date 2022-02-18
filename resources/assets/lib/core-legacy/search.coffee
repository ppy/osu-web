# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

export default class Search
  constructor: ->
    @debouncedSubmitInput = _.debounce @submitInput, 500

    $(document).on 'click', '.js-search--forum-options-reset', @forumPostReset
    $(document).on 'input', '.js-search--input', @debouncedSubmitInput
    $(document).on 'keydown', '.js-search--input', @maybeSubmitInput
    $(document).on 'submit', '.js-search', @submitForm
    addEventListener 'turbolinks:load', @restoreFocus


  forumPostReset: =>
    $form = $('.js-search')

    $form.find('[name=username], [name=forum_id]').val ''
    $form.find('[name=forum_children]').prop 'checked', false


  maybeSubmitInput: (e) =>
    return if e.keyCode != 13

    e.preventDefault()
    @submitInput(e)


  submitInput: (e) =>
    input = e.currentTarget
    value = input.value.trim()

    return if value in ['', input.dataset.searchCurrent?.trim()]

    input.dataset.searchCurrent = value
    @submit()


  submitForm: (e) =>
    e.preventDefault()
    @submit()


  submit: =>
    @searchingToggle(true)
    params = $('.js-search').serialize()

    $(document).one 'turbolinks:before-cache', =>
      @activeElement = document.activeElement
      @searchingToggle(false)

    Turbolinks.visit("?#{params}")


  searchingToggle: (state) =>
    $('.js-search--header').toggleClass('js-search--searching', state)


  restoreFocus: =>
    @activeElement?.focus()
    @activeElement = null
