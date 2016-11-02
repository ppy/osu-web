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
        className: "#{bn}__item #{bn}__item--selected #{bn}__item--large js-beatmap-list-selector"
        onClick: @toggleSelector
        el BeatmapDiscussions.BeatmapListItem, beatmap: @props.currentBeatmap, large: true, withButton: 'down', mode: 'complete'

      div
        className: "#{bn}__selector"
        @props.beatmaps.map @beatmapListItem


  beatmapListItem: (beatmap) ->
    menuItemClasses = "#{bn}__item"
    menuItemClasses += " #{bn}__item--current" if beatmap.id == @props.currentBeatmap.id

    button
      className: menuItemClasses
      key: beatmap.id
      onClick: => @selectBeatmap id: beatmap.id
      el BeatmapDiscussions.BeatmapListItem, beatmap: beatmap, mode: 'version'


  hideSelector: (e) ->
    return unless @state.showingSelector
    return if $(e.target).closest('.js-beatmap-list-selector').length

    @setSelector false


  setSelector: (state) ->
    return if @state.showingSelector == state

    Blackout.toggle(state)

    @setState showingSelector: state


  selectBeatmap: ({id}) ->
    $.publish 'beatmap:select', id: id


  toggleSelector: ->
    @setSelector !@state.showingSelector
