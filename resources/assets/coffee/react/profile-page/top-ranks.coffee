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

import { ExtraHeader } from './extra-header'
import { PlayDetailList } from 'play-detail-list'
import * as React from 'react'
import { div, h2, h3, ul, li, a, p, pre, span } from 'react-dom-factories'
import { ShowMoreLink } from 'show-more-link'
el = React.createElement

export class TopRanks extends React.PureComponent
  render: =>
    div
      className: 'page-extra'
      el ExtraHeader, name: @props.name, withEdit: @props.withEdit

      div null,
        h3 className: 'title title--page-extra-small', osu.trans('users.show.extra.top_ranks.best.title')
        @renderScores 'scoresBest', 'best'

      div null,
        h3
          className: 'title title--page-extra-small'
          osu.trans('users.show.extra.top_ranks.first.title')
          ' '
          if @props.user.scores_first_count > 0
            span className: 'title__count',
              osu.formatNumber(@props.user.scores_first_count)

        @renderScores 'scoresFirsts', 'firsts'


  renderScores: (key, type) =>
    pagination = @props.pagination[key]
    scores = @props[key]

    if scores?.error
      p className: 'profile-extra-entries', scores.error

    else if scores?.length
      div className: 'profile-extra-entries',
        el PlayDetailList, scores: scores

        div className: 'profile-extra-entries__item',
          el ShowMoreLink,
            modifiers: ['profile-page', 't-greyseafoam-dark']
            event: 'profile:showMore'
            hasMore: pagination.hasMore
            loading: pagination.loading
            data:
              name: key
              url: laroute.route 'users.scores',
                user: @props.user.id
                type: type
                mode: @props.currentMode
    else
      p className: 'profile-extra-entries', osu.trans('users.show.extra.top_ranks.empty')
