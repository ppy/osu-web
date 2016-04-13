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
{div, h1, h2, span} = React.DOM
el = React.createElement

class BeatmapSetPage.Header extends React.Component
  render: ->
    div className: 'osu-layout__row osu-layout__row--page-compact',
      div
        className: 'beatmapset-header',
        style:
          backgroundImage: "url(#{@props.cover})",
        div className: 'beatmapset-header__title-box beatmapset-header__title-box--left',
          h1 className: 'beatmapset-header__title beatmapset-header__title', @props.title
          h2 className: 'beatmapset-header__title beatmapset-header__title--small', @props.artist
        div className: 'beatmapset-header__title-box beatmapset-header__title-box--right',
          div className: 'beatmapset-header__title beatmapset-header__title--stat',
            span className: 'beatmapset-header__stat-number', @props.playcount.toLocaleString()
            el Icon, name: 'play-circle', className: 'beatmapset-header__icon beatmapset-header__icon--playcount'
          div className: 'beatmapset-header__title beatmapset-header__title--stat',
            span className: 'beatmapset-header__stat-number', @props.favcount.toLocaleString()
            el Icon, name: 'heart', className: 'beatmapset-header__icon beatmapset-header__icon--playcount'
