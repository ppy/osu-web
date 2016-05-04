###*
*    Copyright 2015 ppy Pty. Ltd.
*
*    This file is part of osu!web. osu!web is distributed with the hope of
*    attracting more community contributions to the core ecosystem of osu!.
*
*    osu!web is free software: you can redistribute it and/or modify
*    it under the terms of the Affero GNU General Public License version 3
*    as published by the Free Software Foundation.
*
*    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
*    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*    See the GNU Affero General Public License for more details.
*
*    You should have received a copy of the GNU Affero General Public License
*    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
*
###

{div,a,i,span} = React.DOM
el = React.createElement

class @BeatmapsetPanel extends React.Component
  render: ->
    # this is actually "beatmapset"
    beatmap = @props.beatmap

    # arbitrary number
    maxDisplayedDifficulty = 10

    difficulties = beatmap.beatmaps.data.slice(0, maxDisplayedDifficulty).map (b) =>
      div
        className: 'beatmapset-panel__difficulty-icon'
        key: b.version
        el BeatmapIcon, beatmap: b

    if beatmap.beatmaps.data.length > maxDisplayedDifficulty
      difficulties.push span key: 'over', "+#{(beatmap.beatmaps.data.length - maxDisplayedDifficulty)}"

    div className: 'beatmapset-panel shadow-hover', objectid: beatmap.beatmapset_id,
      div className: 'beatmapset-panel__header',
        a
          href: Url.beatmapset beatmap.beatmapset_id
          target: '_blank', className: 'beatmapset-panel__thumb'
          style: {backgroundImage: "url(#{beatmap.covers.card})"}
          div className: 'beatmapset-panel__title-artist-box',
            div className: 'beatmapset-panel__header-text beatmapset-panel__header-text--title',
              beatmap.title
            div className: 'beatmapset-panel__header-text',
              beatmap.artist

          div className: 'beatmapset-panel__counts-box',
            div className: 'beatmapset-panel__count',
              span className: 'beatmapset-panel__count-number', beatmap.play_count
              i className: 'fa fa-play-circle'

            div className: 'beatmapset-panel__count',
              span className: 'beatmapset-panel__count-number', beatmap.favourite_count
              i className: 'fa fa-heart'

      div className: 'beatmapset-panel__mapper-source-box',
        span className: 'hidden', ref: beatmap.beatmapset_id, beatmap.beatmapset_id
        div className: 'creator', dangerouslySetInnerHTML: { __html: Lang.get('beatmaps.listing.mapped-by', mapper: laroute.link_to_route('users.show', beatmap.creator, users: beatmap.user_id)) }
        div className: 'source', beatmap.source

      div className: 'beatmapset-panel__icons-box',
        a href: Url.beatmapDownload(beatmap.beatmapset_id), className: 'beatmapset-panel__icon',
          i className: 'fa fa-download'
        a href: '#', className: 'beatmapset-panel__icon',
          i className:'fa fa-heart'

      div className: 'beatmapset-panel__difficulties', difficulties
