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
{button, div} = React.DOM
el = React.createElement

bn = 'beatmap-list'

BeatmapDiscussions.BeatmapList = React.createClass
  mixins: [React.addons.PureRenderMixin]


  getInitialState: ->
    showingSelector: false


  componentDidMount: ->
    $(document).on 'click.beatmapList', @hideSelector


  componentWillUnmount: ->
    $(document).off '.beatmapList'


  render: ->
    div
      className: bn
      button
        className: "#{bn}__current"
        onClick: @toggleSelector
        ref: 'openSelectorButton'
        div "#{bn}__display",
          el BeatmapIcon, beatmap: @props.currentBeatmap, modifier: 'large'
        div className: "#{bn}__display #{bn}__display--main",
          div className: "#{bn}__mode",
            Lang.get("beatmaps.mode.#{@props.currentBeatmap.mode}")
          div className: "#{bn}__version",
            @props.currentBeatmap.version
        div "#{bn}__display",
          div className: "#{bn}__switch-button",
            el Icon, name: 'chevron-down'

      div
        className: "#{bn}__selector #{'hidden' if !@state.showingSelector}"
        @props.beatmapset.beatmaps.data.map (beatmap) =>
          el BeatmapDiscussions.BeatmapSelection,
            key: beatmap.id
            beatmap: beatmap


  hideSelector: (e) ->
    if @refs.openSelectorButton.contains(e.target)
      e.stopPropagation()
      return

    @setSelector null, false


  toggleSelector: ->
    @setSelector !@state.showingSelector


  setSelector: (state) ->
    return if @state.showingSelector == state

    @setState showingSelector: state
