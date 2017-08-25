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

class ProfilePage.ShowMoreLink extends React.Component
  render: =>
    if @props.pagination[@props.propertyName]?.loading && @props.pagination[@props.propertyName].loading
      el Icon, key: 'more-loader', name: 'refresh', modifiers: ['spin']

    else
      hasMore = !@props.pagination[@props.propertyName]? || !@props.pagination[@props.propertyName]?.hasMore? || @props.pagination[@props.propertyName].hasMore

      if hasMore
        a
          href: '#'
          'data-show-more': @props.propertyName
          'data-show-more-url': @props.route
          onClick: @showMore
          osu.trans('common.buttons.show_more')

      else
        null


  showMore: (e) ->
    e.preventDefault()
    $.publish 'showMore', showMoreLink: e.currentTarget