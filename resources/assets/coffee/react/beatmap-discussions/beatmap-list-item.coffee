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

{div} = ReactDOMFactories
el = React.createElement

bn = 'beatmap-list-item'

BeatmapDiscussions.BeatmapListItem = (props) ->
  topClasses = bn
  topClasses += " #{bn}--large" if props.large

  version = props.beatmap.version

  if props.beatmap.deleted_at?
    topClasses += " #{bn}--deleted"
    version += " [#{osu.trans 'beatmap_discussions.index.deleted_beatmap'}]"

  div
    className: topClasses

    div className: "#{bn}__col",
      el BeatmapIcon,
        beatmap: props.beatmap
        modifier: "#{'large' if props.large}"

    div className: "#{bn}__col #{bn}__col--main",
      div className: 'u-ellipsis-overflow',
        version

    if props.withButton?
      div className: "#{bn}__col",
        el Icon, name: "chevron-#{props.withButton}"

    if props.count?
      div className: "#{bn}__col",
        div className: "#{bn}__counter", props.count
