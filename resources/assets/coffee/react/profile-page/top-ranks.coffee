# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import PlayDetailList from 'play-detail-list'
import ExtraHeader from 'profile-page/extra-header'
import * as React from 'react'
import { div, h2, h3, ul, li, a, p, pre, span } from 'react-dom-factories'
import ShowMoreLink from 'show-more-link'
el = React.createElement

export class TopRanks extends React.PureComponent
  render: =>
    div
      className: 'page-extra'
      el ExtraHeader, name: @props.name, withEdit: @props.withEdit

      if @props.scoresNotice?
        div
          className: 'wiki-notice'
          span className: 'fas fa-exclamation-circle'
          ' '
          div
            className: 'wiki-notice__markdown-inline-content'
            dangerouslySetInnerHTML:
              __html: @props.scoresNotice

      div null,
        h3
          className: 'title title--page-extra-small'
          osu.trans('users.show.extra.top_ranks.best.title')
          span className: 'title__count',
            osu.formatNumber(@props.user.scores_best_count)

        @renderScores 'scoresBest', 'best'

      div null,
        h3
          className: 'title title--page-extra-small'
          osu.trans('users.show.extra.top_ranks.first.title')
          span className: 'title__count',
            osu.formatNumber(@props.user.scores_first_count)

        @renderScores 'scoresFirsts', 'firsts'


  renderScores: (key, type) =>
    pagination = @props.pagination[key]
    scores = @props[key]

    if scores?.error
      p null, scores.error

    else if scores?.length
      div className: 'profile-extra-entries',
        el PlayDetailList, scores: scores

        div className: 'profile-extra-entries__item',
          el ShowMoreLink,
            modifiers: 'profile-page'
            event: 'profile:showMore'
            hasMore: pagination.hasMore
            loading: pagination.loading
            data:
              name: key
              url: laroute.route 'users.scores',
                user: @props.user.id
                type: type
                mode: @props.currentMode
