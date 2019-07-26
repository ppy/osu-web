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

class @Search
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
