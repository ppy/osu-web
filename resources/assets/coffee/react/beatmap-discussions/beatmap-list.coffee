###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

import { BeatmapListItem } from './beatmap-list-item'
import * as React from 'react'
import { a, div } from 'react-dom-factories'
el = React.createElement

bn = 'beatmap-list'

export class BeatmapList extends React.PureComponent
  constructor: (props) ->
    super props

    @state =
      showingSelector: false


  componentDidMount: =>
    $(document).on 'click.beatmapList', @hideSelector
    @syncBlackout()


  componentDidUpdate: =>
    @syncBlackout()


  componentWillUnmount: =>
    $(document).off '.beatmapList'


  render: =>
    div
      className: "#{bn} #{"#{bn}--selecting" if @state.showingSelector}"
      div
        className: "#{bn}__body"
        a
          href: BeatmapDiscussionHelper.url beatmap: @props.currentBeatmap
          className: "#{bn}__item #{bn}__item--selected #{bn}__item--large js-beatmap-list-selector"
          onClick: @toggleSelector
          el BeatmapListItem, beatmap: @props.currentBeatmap, large: true, withButton: 'down'

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
      el BeatmapListItem,
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

    @setState showingSelector: state


  selectBeatmap: (e) =>
    return if e.button != 0
    e.preventDefault()

    $.publish 'beatmapsetDiscussions:update',
      beatmapId: parseInt(e.currentTarget.dataset.id, 10)
      mode: BeatmapDiscussionHelper.DEFAULT_MODE


  syncBlackout: =>
    Blackout.toggle(@state.showingSelector, 0.5)


  toggleSelector: (e) =>
    return if e.button != 0
    e.preventDefault()

    @setSelector !@state.showingSelector
