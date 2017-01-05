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

    @$content = $(@content)

    @addClasses()
    @setTitle()
    # @parseToc()
    @updateLocaleLinks()
    @updateTables()


  addClasses: =>
    @$content.addClass 'wiki-content'
    @$content.find('a').addClass 'wiki-content__link'
    for i in [1..6]
      @$content.find("h#{i}").addClass "wiki-content__header wiki-content__header--#{i}"
    @$content.find('img').addClass 'wiki-content__image'


  parseToc: =>
    return if @content[0].dataset.tocParsed == '1'

    $mainToc = $toc = $('<ol>')
    lastLevel = null

    @content[0].dataset.tocParsed = '1'
    for header in @$content.find('h2, h3, h4')
      currentLevel = parseInt header.tagName.match(/\d+/)[0], 10
      title = header.textContent.trim()
      titleId = _.kebabCase title
      $item = $('<li>').append $('<a>').attr('href', "##{titleId}").text(title)

      if lastLevel?
        if currentLevel > lastLevel
          $newToc = $('<ol>')
          $toc.append $newToc
          $toc = $newToc
        else if currentLevel < lastLevel
          $newToc = $toc.parents('ol').first()
          if $newToc.length > 0
            $toc = $newToc

      lastLevel = currentLevel
      $toc.append $item
      header.id = titleId

    $('.js-wiki-toc').append $mainToc


  setTitle: =>
    $title = @$content.find('h1').first()

    return if $title.length == 0

    $('.js-wiki-title').text $title.text()
    $title.remove()


  updateLocaleLink: (_, el) =>
    parsed = el.href?.match /^(\w{2}(?:-\w{2})?):(.+)$/

    return if !parsed?

    locale = parsed[1]
    path = parsed[2]

    el.href = "#{path}?locale=#{locale}"


  updateLocaleLinks: =>
    @$content.find('a').each @updateLocaleLink


  updateTables: =>
    @$content.find('table').addClass 'table'
