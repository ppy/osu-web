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
      className: "#{bn} #{"#{bn}--selecting" if @state.showingSelector}"
      button
        className: "#{bn}__item #{bn}__item--selected #{bn}__item--large"
        onClick: @toggleSelector
        ref: 'noGlobalHide-top'
        el BeatmapDiscussions.BeatmapListItem, beatmap: @props.currentBeatmap, large: true, withButton: 'down', mode: 'complete'

      div
        className: "#{bn}__selector"
        _.chain(@props.beatmapset.beatmaps)
        .groupBy 'mode'
        .map (beatmaps) =>
          menuId = "beatmap-list-#{beatmaps[0].mode}"
          menuLinkClasses = "js-menu #{bn}__item #{bn}__item--large"
          menuLinkClasses += " #{bn}__item--current" if beatmaps[0].mode == @props.currentBeatmap.mode

          beatmaps =
            if beatmaps[0].mode == 'mania'
              _.sortBy beatmaps, ['difficulty_size', 'difficulty_rating']
            else
              _.sortBy beatmaps, ['difficulty_rating']

          div key: beatmaps[0].mode,
            div
              className: menuLinkClasses
              'data-menu-target': menuId
              ref: "noGlobalHide-#{menuId}"
              el BeatmapDiscussions.BeatmapListItem, beatmap: beatmaps[0], large: true, mode: 'mode', withButton: 'right'

            div
              className: "js-menu #{bn}__selector #{bn}__selector--submenu"
              'data-menu-id': menuId
              'data-visibility': 'hidden'
              beatmaps.map (beatmap) =>
                menuItemClasses = "#{bn}__item"
                menuItemClasses += " #{bn}__item--current" if beatmap.id == @props.currentBeatmap.id

                button
                  className: menuItemClasses
                  key: beatmap.id
                  onClick: => @selectBeatmap id: beatmap.id
                  el BeatmapDiscussions.BeatmapListItem, beatmap: beatmap, mode: 'version'
        .value()


  hideSelector: (e) ->
    for own refName, ref of @refs
      continue if !refName.startsWith('noGlobalHide-') || !ref.contains(e.target)

      e.stopPropagation()
      return

    @setSelector false


  toggleSelector: ->
    @setSelector !@state.showingSelector


  setSelector: (state) ->
    return if @state.showingSelector == state

    Blackout.toggle(state)

    @setState showingSelector: state


  selectBeatmap: ({id}) ->
    $.publish 'beatmap:select', id: id
