###
# Copyright 2016 ppy Pty. Ltd.
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
{a} = React.DOM
el = React.createElement

class BeatmapSetPage.ExtraTab extends React.Component
  pageSwitch: (e) =>
    e.preventDefault()

    $.publish 'beatmapset:page:jump', @props.page

  render: ->
    className = 'link link--white link--no-underline page-extra-tabs__item'
    className += ' page-extra-tabs__item--active' if @props.page is @props.currentPage

    a
      href: BeatmapSetPageHash.generate page: @props.page, mode: @props.currentMode
      className: className,
      onClick: @pageSwitch,
      'data-page-id': @props.page,
      Lang.get "beatmaps.beatmapset.show.extra.#{@props.page}.title"
