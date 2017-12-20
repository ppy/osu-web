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
{a} = ReactDOMFactories
el = React.createElement

class ProfilePage.ShowMoreLink extends React.PureComponent
  render: =>
    if @props.pagination?.loading
      el Icon, name: 'refresh', modifiers: ['spin']

    else
      firstLoad = !@props.pagination?
      firstPage = 5
      perPage = @props.perPage ? 20
      maxResults = @props.maxResults ? 100
      hasMore = (firstLoad && (!@props.collection? || @props.collection.length == firstPage)) || @props.pagination?.hasMore

      return null unless hasMore

      a
        href: '#'
        'data-show-more': @props.propertyName
        'data-show-more-max-results': maxResults
        'data-show-more-per-page': perPage
        'data-show-more-url': @props.route
        onClick: @showMore
        osu.trans('common.buttons.show_more')


  showMore: (e) ->
    e.preventDefault()
    $.publish 'profile:showMore', showMoreLink: e.currentTarget
