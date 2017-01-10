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
    @floatTocContainer = document.getElementsByClassName('js-wiki-toc-float-container')
    @floatToc = document.getElementsByClassName('js-wiki-toc-float')

    $(document).on 'turbolinks:load', @initialize
    $.subscribe 'stickyHeader', @stickyToc


  initialize: =>
    return if !@content[0]?
    return if @content[0].dataset.initialized == '1'

    @content[0].dataset.initialized = '1'
    @$content = $(@content)

    @addClasses()
    @setTitle()
    @parseToc()
    @updateLocaleLinks()
    @updateTables()


  addClasses: =>
    @$content.addClass 'wiki-content'
    @$content.find('a').addClass 'wiki-content__link'
    for i in [1..6]
      @$content.find("h#{i}").addClass "wiki-content__header wiki-content__header--#{i}"
    @$content.find('img').addClass 'wiki-content__image'


  parseToc: =>

    $mainToc = $toc = $('<ol>', class: 'wiki-toc-list wiki-toc-list--top')
    lastLevel = null

    @content[0].dataset.tocParsed = '1'
    for header in @$content.find('h2, h3, h4, h5, h6')
      currentLevel = parseInt header.tagName.match(/\d+/)[0], 10
      title = header.textContent.trim()
      titleId = _.kebabCase title
      $link = $('<a>', class: 'wiki-toc-list__link', href: "##{titleId}").text(title)
      $item = $('<li>', class: 'wiki-toc-list__item').append $link

      if lastLevel?
        if currentLevel > lastLevel
          $newToc = $('<ol>', class: 'wiki-toc-list')
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


  stickyToc: (_e, target) =>
    return if !@floatToc[0]?

    if target != 'wiki-toc'
      @floatToc[0].style.transform = ''
      return

    containerRect = @floatTocContainer[0].getBoundingClientRect()
    rect = @floatToc[0].getBoundingClientRect()
    delta = -containerRect.top
    if containerRect.bottom - rect.height < 0
      delta += containerRect.bottom - rect.height

    @floatToc[0].style.transform = "translateY(#{delta}px)"


  updateLocaleLinks: =>
    @$content.find('a').each @updateLocaleLink


  updateTables: =>
    @$content.find('table').addClass 'table'
