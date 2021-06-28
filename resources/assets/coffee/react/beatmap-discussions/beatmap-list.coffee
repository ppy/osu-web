# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { BeatmapListItem } from './beatmap-list-item'
import * as React from 'react'
import { a, div } from 'react-dom-factories'
import { nextVal } from 'utils/seq'
el = React.createElement

bn = 'beatmap-list'

export class BeatmapList extends React.PureComponent
  constructor: (props) ->
    super props

    @eventId = "beatmapset-discussions-show-beatmap-list-#{nextVal()}"
    @state =
      showingSelector: false


  componentDidMount: =>
    $(document).on "click.#{@eventId}", @onDocumentClick
    $(document).on "turbolinks:before-cache.#{@eventId}", @hideSelector
    @syncBlackout()


  componentWillUnmount: =>
    $(document).off ".#{@eventId}"


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


  hideSelector: =>
    return unless @state.showingSelector

    @setSelector false


  onDocumentClick: (e) =>
    return if e.button != 0
    return if $(e.target).closest('.js-beatmap-list-selector').length

    @hideSelector()


  setSelector: (state) =>
    return if @state.showingSelector == state

    @setState showingSelector: state, @syncBlackout


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
