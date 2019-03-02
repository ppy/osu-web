###
#    Copyright 2015-2018 ppy Pty. Ltd.
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
{div, span} = ReactDOMFactories

class @WikiSearch.Suggestion extends React.Component
  onMouseEnter: (e) =>
    $.publish 'suggestion:mouseenter', parseInt e.target.getAttribute 'position'

  onMouseLeave: =>
    $.publish 'suggestion:mouseleave'

  onClick: (e) =>
    $.publish 'suggestion:select', parseInt e.target.getAttribute 'position'

  render: ->
    queryString = $('.js-wiki-search-input').val()
    titleSplit = @props.suggestion.title.split RegExp "(?=#{queryString})", 'i'

    pathCleaned = @cleanPath @props.suggestion.path, @props.suggestion.title

    div
      className: osu.classWithModifiers 'wiki-search-suggestions__suggestion', ['highlighted' if @props.highlighted]
      position: @props.position
      onMouseEnter: @onMouseEnter
      onMouseLeave: @onMouseLeave
      onClick: @onClick
      @formatTitle titleSplit, queryString
      span
        className: osu.classWithModifiers 'wiki-search-suggestions__suggestion-text', ['path']
        "#{Lang.get 'wiki.search.path'} #{@cleanPath @props.suggestion.path, @props.suggestion.title}" if pathCleaned != ''

  formatTitle: (titleSplit, delimiter) ->
    result = []
    key = 0

    for el in titleSplit
      match = el.match RegExp delimiter, 'i'

      if match
        result.push @formatMatch match[0], key++, true
        result.push @formatMatch el.split(delimiter)[1], key++, false
      else
        result.push @formatMatch el, key++, false

    result

  formatMatch: (string, key, matching) ->
    span
      className: osu.classWithModifiers 'wiki-search-suggestions__suggestion-text', ['matching' if matching]
      key: key
      string

  cleanPath: (path, title) ->
    path.replace(RegExp("\/?#{title}", 'gi'), '').replace '_', ' '
