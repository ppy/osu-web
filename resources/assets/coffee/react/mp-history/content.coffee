###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

import { Event } from './event'
import { Game } from './game'
import * as React from 'react'
import { button, div } from 'react-dom-factories'
import { Spinner } from 'spinner'
el = React.createElement

export class Content extends React.PureComponent
  constructor: (props) ->
    super props

    @eventsRef = React.createRef()


  getSnapshotBeforeUpdate: (prevProps, prevState) =>
    snapshot = {}

    if prevProps.events?.length > 0 && @props.events?.length > 0
      # events are prepended, use previous first entry as reference
      if prevProps.events[0].id > @props.events[0].id
        snapshot.reference =
          # firstChild to avoid calculating based on ever-changing padding
          @eventsRef.current.children[0].firstChild
      # events are appended, use previous last entry as reference
      else if _.last(prevProps.events).id < _.last(@props.events).id
        snapshot.reference =
          _.last(@eventsRef.current.children).firstChild

    if snapshot.reference?
      snapshot.referenceTop = snapshot.reference.getBoundingClientRect().top

    if osu.bottomPageDistance() < 10 && prevProps.isAutoloading && @props.isAutoloading
      snapshot.scrollToLastEvent = true

    snapshot


  componentDidUpdate: (prevProps, prevState, snapshot) =>
    if snapshot.scrollToLastEvent
      $(window).stop().scrollTo @eventsRef.current.scrollHeight, 500
    else if snapshot.reference?
      currentScrollReferenceTop = snapshot.reference.getBoundingClientRect().top
      currentDocumentScrollTop = window.pageYOffset
      targetDocumentScrollTop = currentDocumentScrollTop + currentScrollReferenceTop - snapshot.referenceTop
      window.scrollTo window.pageXOffset, targetDocumentScrollTop


  render: =>
    div className: 'osu-layout__row osu-layout__row--page-mp-history',
      if @props.hasPrevious
        div className: 'mp-history-content',
          if @props.loadingPrevious
            el Spinner
          else
            button
              className: 'mp-history-content__show-more'
              type: 'button'
              onClick: @props.loadPrevious
              osu.trans 'common.buttons.show_more'

      div
        className: 'mp-history-events'
        ref: @eventsRef
        for event, i in @props.events
          if event.detail.type == 'other'
            continue if !event.game? || (!event.game.end_time? && event.game.id != @props.currentGameId)

            div
              className: 'mp-history-events__game'
              key: event.id
              el Game,
                event: event
                teamScores: @teamScores i
                users: @props.users
          else
            div
              className: 'mp-history-events__event'
              key: event.id
              el Event,
                event: event
                users: @props.users
                key: event.id

      if @props.hasNext
        div className: 'mp-history-content',
          if @props.isAutoloading
            div className: 'mp-history-content__spinner',
              div
                className: 'mp-history-content__spinner-label'
                osu.trans 'multiplayer.match.in_progress_spinner_label'
              el Spinner
          else if @props.loadingNext
            el Spinner
          else
            button
              className: 'mp-history-content__show-more'
              type: 'button'
              onClick: @props.loadNext
              osu.trans 'common.buttons.show_more'


  teamScores: (eventIndex) =>
    game = @props.events[eventIndex].game

    return if !game?

    @scoresCache ?= {}

    if !@scoresCache[eventIndex]?
      scores =
        blue: 0
        red: 0

      return scores if !game.end_time?

      for score in game.scores
        continue if !score.multiplayer.pass
        scores[score.multiplayer.team] += score.score

      @scoresCache[eventIndex] = scores

    @scoresCache[eventIndex]
