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

{a, div} = ReactDOMFactories
el = React.createElement

bn = 'beatmap-list'

class BeatmapDiscussions.BeatmapList extends React.PureComponent
  constructor: (props) ->
    super props

    @state =
      showingSelector: false


  componentDidMount: =>
    $(document).on 'click.beatmapList', @hideSelector


  componentWillUnmount: =>
    $(document).off '.beatmapList'


  render: =>
    div
      className: "#{bn} #{"#{bn}--selecting" if @state.showingSelector}"
      a
        href: BeatmapDiscussionHelper.url beatmap: @props.currentBeatmap
        className: "#{bn}__item #{bn}__item--selected #{bn}__item--large js-beatmap-list-selector"
        onClick: @toggleSelector
        el BeatmapDiscussions.BeatmapListItem, beatmap: @props.currentBeatmap, large: true, withButton: 'down'

      div
        className: "#{bn}__selector"
        @props.beatmaps.map @beatmapListItem


  beatmapListItem: (beatmap) =>
    menuItemClasses = "#{bn}__item"
    menuItemClasses += " #{bn}__item--current" if beatmap.id == @props.currentBeatmap.id

    count = if beatmap.deleted_at? then null else @props.currentDiscussions.countsByBeatmap[beatmap.id]

    a
      href: BeatmapDiscussionHelper.url beatmap: beatmap
      className: menuItemClasses
      key: beatmap.id
      'data-id': beatmap.id
      onClick: @selectBeatmap
      el BeatmapDiscussions.BeatmapListItem,
        beatmap: beatmap
        mode: 'version'
        count: count


  hideSelector: (e) =>
    return if e.button != 0
    return unless @state.showingSelector
    return if $(e.target).closest('.js-beatmap-list-selector').length

    @setSelector false


  setSelector: (state) =>
    return if @state.showingSelector == state

    Blackout.toggle(state, 0.5)

    @setState showingSelector: state


  selectBeatmap: (e) =>
    return if e.button != 0
    e.preventDefault()

    $.publish 'beatmapsetDiscussions:update', beatmapId: parseInt(e.currentTarget.dataset.id, 10)


  toggleSelector: (e) =>
    return if e.button != 0
    e.preventDefault()

    @setSelector !@state.showingSelector
