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

class @NavSearch
  constructor: ->
    @debouncedRun = _.debounce @run, 250

    # weird metric otherwise
    $(document).on 'turbolinks:load', =>
      Timeout.set 0, @padResult

    $(document).on 'input', '.js-nav-search--input', @debouncedRun
    $(document).on 'click', '.js-nav-search--run-link', @runLink
    $.subscribe 'nav:mode:set', @modeSwitch
    $(document).on 'turbolinks:before-cache', @abort


  abort: =>
    @xhr?.abort()


  modeSwitch: (_e, {mode}) =>
    if mode == 'search'
      $('.js-nav-search--input').focus()

      if $('.js-nav-search--result').html().trim().length > 0
        @setMode 'result'
    else
      @setMode 'initial'


  padResult: =>
    inputContainer = document.querySelector('.js-nav-search--input-container')

    return unless inputContainer?

    $container = $('.js-nav-search--right-padded')
    reference = document.querySelector('.js-nav-search--popup-width-reference')

    inputRight = inputContainer.getBoundingClientRect().right
    containerRight = reference.getBoundingClientRect().right

    $container
      .css 'padding-right', containerRight - inputRight


  run: =>
    input = document.getElementsByClassName('js-nav-search--input')[0]
    query = input.value.trim()

    if query.length < parseInt(input.dataset.minLength)
      $('.js-nav-search--result').text('')
      return @setMode 'initial'

    @setMode 'loading'

    @abort()
    @xhr = $.get laroute.route('quick-search'), query: query
      .done @showResult
      .fail (_xhr, status) =>
        return if status == 'abort'
        @setMode 'fail'


  setMode: (newMode) =>
    for mode in ['initial', 'loading', 'result', 'fail']
      element = document.querySelector(".js-nav-search--#{mode}")

      if mode == newMode
        element.classList.remove 'hidden'
      else
        element.classList.add 'hidden'


  runLink: (e) =>
    e.preventDefault()
    @run()


  showResult: (data) =>
    @setMode 'result'
    $('.js-nav-search--result').html(data)
