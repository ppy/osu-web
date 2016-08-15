###
# Copyright 2015-2016 ppy Pty. Ltd.
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
class @UserPrefs
  updateDelay: 1000

  constructor: ->
    fields = $('.js-user-prefs--field')
    return if fields.length == 0

    timer = null

    fields.keyup (event) =>
      target = event.target

      clearTimeout timer

      update = =>
        if target.value != target.defaultValue
          @updateProfile target

      timer = setTimeout update, @updateDelay

    fields.focusout (event) =>
      target = event.target

      if target.value != target.defaultValue
        clearTimeout timer
        @updateProfile target

  updateProfile: (field) ->
    data = {}
    data[field.id] = field.value

    $.ajax (laroute.route 'account.update-profile'),
      method: 'POST'
      data: data

    .success =>
      # setting the default value of the field so that the checks won't fail
      $(field).attr 'value', field.value

      label = $("##{field.id}.js-user-prefs--saved")
      label.addClass 'user-prefs-section__saved--visible'

      fun = =>
        label.removeClass 'user-prefs-section__saved--visible'

      setTimeout fun, 2500

    .fail osu.ajaxError
