###
# Copyright 2015 ppy Pty. Ltd.
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
class @Wiki
  constructor: ->
    @content = document.getElementsByClassName('js-wiki-content')

    $(document).on 'turbolinks:load', @initialize


  initialize: =>
    return if !@content[0]?

    @updateLinks()
    @updateTables()


  updateLink: (_, el) =>
    parsed = el.href?.match /^(\w{2}(?:-\w{2})?):(.+)$/

    return if !parsed?

    locale = parsed[1]
    path = parsed[2]

    el.href = "#{path}?locale=#{locale}"


  updateLinks: =>
    $(@content).find('a').each @updateLink


  updateTables: =>
    $(@content).find('table').addClass 'table'
