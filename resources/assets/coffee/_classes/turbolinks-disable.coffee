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

internal = [
  'admin'
  'api/v2'
  'beatmaps'
  'beatmapsets'
  'community'
  'help'
  'home'
  'legal'
  'oauth'
  'rankings'
  'session'
  'store'
  'users'
].join('|')


class @TurbolinksDisable
  constructor: ->
    addEventListener 'turbolinks:click', @cancelIfExternal


  cancelIfExternal: (event) ->
    prefix = "#{document.location.protocol}//#{document.location.host}/"

    unless RegExp("^(?:#{internal})(?:$|/)").test event.data.url.substr(prefix.length)
      event.preventDefault()
