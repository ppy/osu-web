# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Event } from './event'
import { Game } from './game'
import * as React from 'react'
import { button, div, h3 } from 'react-dom-factories'
import ShowMoreLink from 'show-more-link'
import { classWithModifiers } from 'utils/css'
import { bottomPageDistance } from 'utils/html'

el = React.createElement

export class Content extends React.PureComponent
  getSnapshotBeforeUpdate: (prevProps, prevState) =>
    snapshot =
      scrollToLastEvent: prevProps.isAutoloading && @props.isAutoloading && bottomPageDistance() < 10

    if !snapshot.scrollToLastEvent
      if prevProps.events?.length > 0 && @props.events?.length > 0
        # This is to allow events to be added without moving currently
        # visible events on viewport.
        if prevProps.events[0].id > @props.events[0].id
          snapshot.referenceFunc = -> document.body.scrollHeight
        else
          snapshot.referenceFunc = -> 0

        snapshot.referencePrev = snapshot.referenceFunc()
    snapshot


  componentDidUpdate: (prevProps, prevState, snapshot) =>
    if snapshot.scrollToLastEvent
      $(window).stop().scrollTo document.body.scrollHeight, 500
    else if snapshot.referenceFunc?
      referenceCurrent = snapshot.referenceFunc()
      documentScrollTopCurrent = window.pageYOffset
      documentScrollTopTarget = documentScrollTopCurrent + referenceCurrent - snapshot.referencePrev
      window.scrollTo window.pageXOffset, documentScrollTopTarget


  render: =>
    inEvent = false
    eventsGroupOpen = div className: classWithModifiers('mp-history-content__item', ['event', 'event-open'])
    eventsGroupClose = div className: classWithModifiers('mp-history-content__item', ['event', 'event-close'])

    div className: 'mp-history-content',
      h3 className: 'mp-history-content__item', @props.match.name

      if @props.hasPrevious
        div className: 'mp-history-content__item mp-history-content__item--more',
          el ShowMoreLink,
            callback: @props.loadPrevious
            direction: 'up'
            hasMore: true
            loading: @props.loadingPrevious

      for event in @props.events
        if event.detail.type == 'other'
          continue if !event.game? || (!event.game.end_time? && event.game.id != @props.currentGameId)

          el React.Fragment, key: event.id,
            if inEvent
              inEvent = false
              eventsGroupClose

            div className: 'mp-history-content__item',
              el Game,
                event: event
                teamScores: @teamScores event.game
                users: @props.users
        else
          el React.Fragment, key: event.id,
            if !inEvent
              inEvent = true
              eventsGroupOpen

            div className: 'mp-history-content__item mp-history-content__item--event',
              el Event,
                event: event
                users: @props.users
                key: event.id

      eventsGroupClose if inEvent

      if @props.hasNext
        div className: 'mp-history-content__item mp-history-content__item--more',
          if @props.isAutoloading
            div
              className: 'mp-history-content__autoload-label'
              osu.trans 'matches.match.in_progress_spinner_label'
          el ShowMoreLink,
            callback: @props.loadNext
            hasMore: true
            loading: @props.isAutoloading || @props.loadingNext


  teamScores: (game) =>
    return if !game?

    # this only caches ended games which scores shouldn't change ever.
    @scoresCache ?= {}

    if !@scoresCache[game.id]?
      scores =
        blue: 0
        red: 0

      return scores if !game.end_time?

      for score in game.scores
        continue if !score.match.pass
        scores[score.match.team] += score.score

      @scoresCache[game.id] = scores

    @scoresCache[game.id]
