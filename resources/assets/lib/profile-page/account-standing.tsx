# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import ExtraHeader from 'profile-page/extra-header'
import TimeWithTooltip from 'time-with-tooltip'
import * as React from 'react'
import { a, div, span, h3, table, thead, tbody, tr, th, td } from 'react-dom-factories'
el = React.createElement

bn = 'profile-extra-recent-infringements'

export class AccountStanding extends React.PureComponent
  columns = ['date', 'action', 'length', 'description']

  render: ->
    latest = _.find @props.user.account_history, (d) -> d.type == 'silence'
    endTime = moment(latest.timestamp).add(latest.length, 'seconds') if latest?

    div
      className: 'page-extra'
      el ExtraHeader, name: @props.name, withEdit: false

      if latest?
        div
          className: "page-extra__alert page-extra__alert--warning"
          span
            dangerouslySetInnerHTML:
              __html: osu.trans 'users.show.extra.account_standing.bad_standing',
                username: @props.user.username

      if latest? && endTime.isAfter()
        div
          className: "page-extra__alert page-extra__alert--info"
          span
            dangerouslySetInnerHTML:
              __html: osu.trans 'users.show.extra.account_standing.remaining_silence',
                username: @props.user.username
                duration: osu.timeago endTime.format()

      h3
        className: 'title title--page-extra-small'
        osu.trans 'users.show.extra.account_standing.recent_infringements.title'

      div
        className: "#{bn}"
        table
          className: "#{bn}__table"
          thead {},
            tr {},
              for column in columns
                th
                  key: column
                  className: "#{bn}__table-cell #{bn}__table-cell--header #{bn}__table-cell--#{column}"
                  osu.trans "users.show.extra.account_standing.recent_infringements.#{column}"

          tbody {},
            @table @props.user.account_history

  table: (events) ->
    for event, i in events
      tr
        key: i

        td
          className: "#{bn}__table-cell #{bn}__table-cell--date"
          el TimeWithTooltip, dateTime: event.timestamp, relative: true

        td
          className: "#{bn}__table-cell #{bn}__table-cell--action"
          div
            className: "#{bn}__action #{bn}__action--#{event.type}"
            osu.trans "users.show.extra.account_standing.recent_infringements.actions.#{event.type}"

        td
          className: "#{bn}__table-cell #{bn}__table-cell--length"
          if event.type == 'restriction'
            div
              className: "#{bn}__action #{bn}__action--restriction"
              osu.trans 'users.show.extra.account_standing.recent_infringements.length_permanent'
          else if event.type == 'note'
            ''
          else
            moment.duration(event.length, 'seconds').humanize()

        td
          className: "#{bn}__table-cell #{bn}__table-cell--description"
          span
            className: "#{bn}__description"
            if currentUser.is_admin && event.supporting_url?
              a href: event.supporting_url, event.description
            else
              event.description

            if currentUser.is_admin && event.actor?
              span
                className: "#{bn}__actor"
                dangerouslySetInnerHTML:
                  __html: osu.trans 'users.show.extra.account_standing.recent_infringements.actor',
                    username: osu.link laroute.route('users.show', user: event.actor.id), event.actor.username
