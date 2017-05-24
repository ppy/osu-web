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
  checkboxes: document.getElementsByClassName('js-account-edit-playstyle')

  constructor: ->
    $(document).on 'change', '.js-account-edit-playstyle', @update

  saved: (el) =>
    el.dataset.accountEditState = 'saved'

    Timeout.set 3000, =>
      @clearState el

  clearState: (el) =>
    el.dataset.accountEditState = ''

  saving: (el) =>
    el.dataset.accountEditState = 'saving'

  update: (e) =>
    input = e.currentTarget
    $main = $(input).closest('.js-account-edit')

    arr = [""]
    for checkbox in @checkboxes
      arr.push checkbox.value if checkbox.checked

    @saving $main[0]

    $.ajax laroute.route('account.update'),
      method: 'PUT'
      data:
        user: osu_playstyle: arr
    .done =>
      @saved $main[0]

    .fail (xhr) =>
      osu.ajaxError xhr
      @clearState $main[0]
