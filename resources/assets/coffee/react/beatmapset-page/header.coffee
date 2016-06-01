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
{div, span, a} = React.DOM
el = React.createElement

class BeatmapsetPage.Header extends React.Component
  onClick: (e) =>
    $.publish 'beatmapset:preview:toggle', !@props.isPreviewPlaying

  preventPropagation: (e) =>
    # stops the audio from playing before we navigate away
    e.stopPropagation()
    return true

  render: ->
    div className: 'osu-layout__row osu-layout__row--page-compact',
      div
        className: 'beatmapset-header',
        onClick: @onClick,
        style:
          backgroundImage: "url(#{@props.cover})",
        div
          className: 'beatmapset-header__preview-button'
          el Icon, name: if @props.isPreviewPlaying then 'pause' else 'play'
        div className: 'beatmapset-header__title-box beatmapset-header__title-box--left',
          div className: 'beatmapset-header__title',
            a
              href: laroute.route 'beatmapsets.index', q: @props.title
              onClick: @preventPropagation
              @props.title

          div className: 'beatmapset-header__title beatmapset-header__title--small',
            a
              href: laroute.route 'beatmapsets.index', q: @props.artist
              onClick: @preventPropagation
              @props.artist

        div className: 'beatmapset-header__title-box beatmapset-header__title-box--right',
          div className: 'beatmapset-header__title beatmapset-header__title--stat',
            span className: 'beatmapset-header__stat-number', @props.playcount.toLocaleString()
            span className: 'beatmapset-header__icon beatmapset-header__icon--playcount',
              el Icon, name: 'play-circle'
          div className: 'beatmapset-header__title beatmapset-header__title--stat',
            span className: 'beatmapset-header__stat-number', @props.favcount.toLocaleString()
            span className: 'beatmapset-header__icon beatmapset-header__icon--favcount',
              el Icon, name: 'heart'
