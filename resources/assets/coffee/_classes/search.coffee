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

class @Search
  constructor: ->
    @debouncedSubmit = _.debounce @submit, 500

    $(document).on 'click', '.js-search--forum-options-reset', @forumPostReset
    $(document).on 'input', '.js-search--input', @debouncedSubmit
    $(document).on 'keydown', '.js-search--input', @maybeSubmit


  forumPostReset: (e) =>
    $form = $(e.currentTarget).closest('form')

    $form.find('[name=username], [name=forum_id]').val ''
    $form.find('[name=forum_children]').prop 'checked', false


  maybeSubmit: (e) =>
    return if e.keyCode != 13

    e.preventDefault()
    @submit()


  submit: (e) =>
    input = e.currentTarget
    value = input.value.trim()

    return if value in ['', input.dataset.searchCurrent?.trim()]

    @searchingStart()
    $(document).one 'turbolinks:before-cache', @searchingEnd
    params = $(e.currentTarget).closest('form').serialize()
    input.dataset.searchCurrent = value

    Turbolinks.visit("?#{params}")


  searchingStart: =>
    @searchingToggle(true)


  searchingEnd: =>
    @searchingToggle(false)


  searchingToggle: (state) =>
    $('.js-search--header').toggleClass('js-search--searching', state)
