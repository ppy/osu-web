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

class @AccountEditPrivacy
  checkboxField: document.getElementsByClassName('js-account-edit-privacy')

  constructor: ->
    @debouncedUpdate = _.debounce @update, 500
    $(document).on 'change', '.js-account-edit-privacy', @change


  change: (e) =>
    target = e.currentTarget
    target.dataset.updating = '1'

    @setState 'saving'
    @debouncedUpdate()


  clearState: =>
    # internet explorer doesn't redraw when using .dataset
    @checkboxField[0].setAttribute 'data-account-edit-state', ''


  saved: =>
    @setState 'saved'
    @setStateTimeout = Timeout.set 3000, @clearState


  setState: (state) =>
    Timeout.clear @setStateTimeout

    # internet explorer doesn't redraw when using .dataset
    @checkboxField[0].setAttribute 'data-account-edit-state',
        if @checkboxField[0].dataset.updating == '1'
            state
        else
            ''


  update: =>
    checkbox = @checkboxField[0].getElementsByTagName('input')[0]

    @xhr?.abort()
    @xhr = $.ajax laroute.route('account.update'),
      method: 'PUT'
      data:
        user: pm_friends_only: checkbox.checked
    .done =>
      @saved()
    .fail (xhr, status) =>
      return if status == 'abort'

      osu.ajaxError xhr
      @clearState()

    .always (_xhr, status) =>
      if status != 'abort'
        @checkboxField[0].dataset.updating = '0'
