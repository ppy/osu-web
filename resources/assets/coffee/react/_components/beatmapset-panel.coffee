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
    beatmap = @props.beatmap
    difficulties = []

    # arbitrary number
    maxDisplayedDifficulty = 10

    for difficulty, index in beatmap.difficulties.data.slice(0, maxDisplayedDifficulty)
      difficulties.push el(BeatmapDifficultyIcon, difficulty: difficulty, key: index)

    if beatmap.difficulties.data.length > maxDisplayedDifficulty
      difficulties.push span key: 'over', "+#{(beatmap.difficulties.data.length - maxDisplayedDifficulty)}"

    div className: 'beatmap object_link shadow-hover', objectid: beatmap.beatmapset_id,
      div className: 'beatmap-panel',
        a href: "https://osu.ppy.sh/s/#{beatmap.beatmapset_id}", target: '_blank', className: 'thumb', style: {backgroundImage: "url(#{beatmap.covers.card})"},
          div className: 'bottom_left',
            div className: 'title',
              span {}, beatmap.title
            div className: 'artist',
              span {}, beatmap.artist

          div className: 'top_right',
            div className: 'stats',
              div className: 'plays',
                span {},
                  beatmap.play_count
                i className: 'fa fa-play-circle'

              div className: 'favourites',
                span {},
                  beatmap.favourite_count
                i className: 'fa fa-heart'

      div className: 'bottom_left',
        span className: 'hidden', ref: beatmap.beatmapset_id, beatmap.beatmapset_id
        div className: 'creator', dangerouslySetInnerHTML: { __html: Lang.get('beatmaps.listing.mapped-by', mapper: osu.link(Url.user(beatmap.user_id), beatmap.creator)) }
        div className: 'source', beatmap.source

      div className: 'bottom_right show_on_hover',
        a href: "https://osu.ppy.sh/d/#{beatmap.beatmapset_id}", className: 'object_link',
          i className: 'fa fa-download'
        a href: '#', className:'object_link',
          i className:'fa fa-heart'

      div className: 'difficulties', difficulties

      el('paper-shadow', z: '1', animated: 'true')
