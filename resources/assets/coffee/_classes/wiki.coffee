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


class @Wiki
  constructor: ->
    @content = document.getElementsByClassName('js-wiki-content')
    @floatTocContainer = document.getElementsByClassName('js-wiki-toc-float-container')
    @floatToc = document.getElementsByClassName('js-wiki-toc-float')

    $(document).on 'turbolinks:load', @initialize

    $.subscribe 'stickyHeader', @stickyToc
    $(document).on 'turbolinks:load', @stickyToc


  initialize: =>
    return if !@content[0]?
    return if @content[0].dataset.initialized == '1'

    @content[0].dataset.initialized = '1'
    @$content = $(@content)

    @fixImageSrc()
    @addClasses()
    @setTitle()
    @parseToc()
    @updateLocaleLinks()


  addClasses: =>
    @$content.addClass 'wiki-content'
    @$content.find('a').addClass 'wiki-content__link'
    for i in [1..6]
      @$content.find("h#{i}").addClass "wiki-content__header wiki-content__header--#{i}"
    @$content.find('img').addClass 'wiki-content__image'
    @$content.find('ol, ul').addClass 'wiki-content__list'
    @$content.find('li').addClass 'wiki-content__list-item'
    @$content.find('ul > li').addClass 'wiki-content__list-item--bullet'
    for list1 in ['ul', 'ol']
      for list2 in ['ul', 'ol']
        @$content.find("#{list1} > li > #{list2} li").addClass 'wiki-content__list-item--deep'
    @$content.find('table').addClass 'wiki-content__table'
    @$content.find('td, th').addClass 'wiki-content__table-data'
    @$content.find('th').addClass 'wiki-content__table-data--header'


  # Turbolinks and relative image url don't quite work properly together.
  # https://github.com/turbolinks/turbolinks/issues/82
  fixImageSrc: =>
    @$content.find('img').each (_i, el) =>
      src = el.getAttribute 'src'
      return if src.match(/^https?:\/\//)? || src[0] == '/'

      el.setAttribute 'src', el.src


  parseToc: =>
    $mainToc = $toc = $('<ol>', class: 'wiki-toc-list wiki-toc-list--top')
    lastLevel = null

    titleIds = {}

    for header in @$content.find('h2, h3, h4, h5, h6')
      currentLevel = parseInt header.tagName.match(/\d+/)[0], 10
      title = header.textContent.trim()
      titleId = _.kebabCase title

      # ensure no duplicate ids
      titleIds[titleId] ?= 1
      if titleIds[titleId] > 0
        titleIds[titleId] += 1
        titleId = "#{titleId}.#{titleIds[titleId]}"

      $link = $('<a>', class: 'wiki-toc-list__link js-wiki-spy-link', href: "##{titleId}").text(title)
      if currentLevel > 2
        $link.addClass 'wiki-toc-list__link--small'
      $item = $('<li>', class: 'wiki-toc-list__item').append $link

      if lastLevel?
        if currentLevel > lastLevel
          $newToc = $('<ol>', class: 'wiki-toc-list')
          $lastItem.append $newToc
          $toc = $newToc
        else if currentLevel < lastLevel
          $newToc = $toc.parents('ol').first()
          if $newToc.length > 0
            $toc = $newToc

      lastLevel = currentLevel
      $lastItem = $item
      $toc.append $item
      header.id = titleId
      header.classList.add 'js-wiki-spy-target'

    $('.js-wiki-toc').append $mainToc


  setTitle: =>
    $title = @$content.find('h1').first()

    return if $title.length == 0

    $('.js-wiki-title').text $title.text()
    @$content.find('h1').remove()


  updateLocaleLink: (_, el) =>
    parsed = el.href?.match /^(\w{2}(?:-\w{2})?):(.+)$/

    return if !parsed?

    locale = parsed[1]
    path = parsed[2]

    el.href = "#{path}?locale=#{locale}"


  stickyToc: (_e, target) =>
    return if !@floatToc[0]?

    # not floating
    if target != 'wiki-toc'
      @floatToc[0].style.position = 'absolute'
      @floatToc[0].style.top = 0
      @floatToc[0].style.bottom = 'auto'
      @floatToc[0].style.left = 0
      @floatToc[0].style.width = 'auto'
      return

    containerRect = @floatTocContainer[0].getBoundingClientRect()
    rect = @floatToc[0].getBoundingClientRect()

    # reached bottom
    if containerRect.bottom < rect.height
      @floatToc[0].style.position = 'absolute'
      @floatToc[0].style.top = 'auto'
      @floatToc[0].style.bottom = 0
      @floatToc[0].style.left = 0
      @floatToc[0].style.width = 'auto'
      return

    # floating
    @floatToc[0].style.position = 'fixed'
    @floatToc[0].style.top = 0
    @floatToc[0].style.bottom = 'auto'
    @floatToc[0].style.left = "#{containerRect.left}px"
    @floatToc[0].style.width = "#{containerRect.width}px"


  updateLocaleLinks: =>
    @$content.find('a').each @updateLocaleLink
