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
{a, div, h1, p} = React.DOM
el = React.createElement

BeatmapDiscussions.Overview = React.createClass
  mixins: [React.addons.PureRenderMixin]


  render: ->
    currentBeatmap = @props.beatmapset.beatmaps.data[@props.currentBeatmapIndex]
    user = @props.beatmapset.user.data

    div
      className: 'beatmap-discussions-overview'

      div
        className: 'beatmap-discussions-overview__beatmaps'
        div
          className: 'beatmap-list'
          div 'beatmap-list__display',
            el BeatmapIcon, beatmap: currentBeatmap, modifier: 'large'
          div className: 'beatmap-list__display beatmap-list__display--main',
            div className: 'beatmap-list__mode',
              Lang.get("beatmaps.mode.#{currentBeatmap.mode}")
            div className: 'beatmap-list__version',
              currentBeatmap.version
          div 'beatmap-list__display',
            div className: 'beatmap-list__switch-button',
              el Icon, name: 'chevron-down'
      div
        className: 'beatmap-discussions-overview__timeline'

      div
        className: 'beatmap-discussions-overview__info'

        div null,
          div
            className: 'beatmap-discussions-overview__meta-text beatmap-discussions-overview__meta-text--large'
            @props.beatmapset.title
          div
            className: 'beatmap-discussions-overview__meta-text'
            @props.beatmapset.artist
          div
            className: 'beatmap-discussions-overview__meta-text'
            dangerouslySetInnerHTML:
              __html: Lang.get 'beatmaps.listing.mapped-by',
                mapper: "<strong>#{osu.link Url.user(user.user_id), user.username}</strong>"

        div null,
          div
            className: 'beatmap-discussions-stats beatmap-discussions-stats--resolved'
            p className: 'beatmap-discussions-stats__text beatmap-discussions-stats__text--type', 'Resolved'
            p className: 'beatmap-discussions-stats__text beatmap-discussions-stats__text--count', '∞'
          div
            className: 'beatmap-discussions-stats beatmap-discussions-stats--pending'
            p className: 'beatmap-discussions-stats__text beatmap-discussions-stats__text--type', 'Pending'
            p className: 'beatmap-discussions-stats__text beatmap-discussions-stats__text--count', '-∞'
          div
            className: 'beatmap-discussions-stats beatmap-discussions-stats--total'
            p className: 'beatmap-discussions-stats__text beatmap-discussions-stats__text--type', 'Total'
              p className: 'beatmap-discussions-stats__text beatmap-discussions-stats__text--count', 'NaN'
