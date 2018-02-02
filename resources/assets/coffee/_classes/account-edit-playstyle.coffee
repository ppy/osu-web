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

class @AccountEditPlaystyle
  checkboxFields: document.getElementsByClassName('js-account-edit-playstyle')

  constructor: ->
    @debouncedUpdate = _.debounce @update, 500
    $(document).on 'change', '.js-account-edit-playstyle', @change


  change: (e) =>
    target = e.currentTarget
    target.dataset.playstyleUpdating = '1'

    @setState 'saving'
    @debouncedUpdate()


  clearState: =>
    for field in @checkboxFields
      # internet explorer doesn't redraw when using .dataset
      field.setAttribute 'data-account-edit-state', ''


  saved: =>
    @setState 'saved'
    @setStateTimeout = Timeout.set 3000, @clearState


  setState: (state) =>
    Timeout.clear @setStateTimeout

    for field in @checkboxFields
      # internet explorer doesn't redraw when using .dataset
      field.setAttribute 'data-account-edit-state',
        if field.dataset.playstyleUpdating == '1'
          state
        else
          ''


  update: =>
    arr = [""]
    for field in @checkboxFields
      checkbox = field.getElementsByTagName('input')[0]
      arr.push field.dataset.playstyle if checkbox.checked

    @xhr?.abort()
    @xhr = $.ajax laroute.route('account.update'),
      method: 'PUT'
      data:
        user: osu_playstyle: arr
    .done =>
      @saved()
    .fail (xhr, status) =>
      return if status == 'abort'

      osu.ajaxError xhr
      @clearState()

    .always (_xhr, status) =>
      if status != 'abort'
        for field in @checkboxFields
          field.dataset.playstyleUpdating = '0'
