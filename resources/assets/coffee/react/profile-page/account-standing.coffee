###
#    Copyright 2015-2018 ppy Pty. Ltd.
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
{div, span, h3, table, thead, tbody, tr, th, td, time} = ReactDOMFactories
el = React.createElement

bn = 'profile-extra-account-standing'

class ProfilePage.AccountStanding extends React.PureComponent
  columns = ['date', 'action', 'length', 'description']

  render: ->
    latest = _.first @props.user.recent_ban_history
    bans = _.partition @props.user.recent_ban_history, (d) -> d.type != 'note'

    div
      className: 'page-extra'
      el ProfilePage.ExtraHeader, name: @props.name, withEdit: false

      div
        className: "#{bn}"

        if latest?
          div
            className: "#{bn}__alert #{bn}__alert--warning"
            span
              dangerouslySetInnerHTML:
                __html: osu.trans 'users.show.extra.account_standing.bad_standing',
                  username: @props.user.username

        if latest? && moment(latest.end_time).isAfter(moment.now())
          div
            className: "#{bn}__alert #{bn}__alert--info"
            span
              dangerouslySetInnerHTML:
                __html: osu.trans 'users.show.extra.account_standing.remaining_silence',
                  username: @props.user.username
                  duration: @remaining latest

      div {},
        h3
          className: 'page-extra__title page-extra__title--small'
          osu.trans 'users.show.extra.account_standing.recent_infringements.title'

        div className: "#{bn}__table-scroll-container",
          table
            className: "#{bn}__table"
            thead {},
              tr {},
                for column in columns
                  th
                    key: column
                    className: "#{bn}__table-header #{bn}__table-header--#{column}"
                    osu.trans "users.show.extra.account_standing.recent_infringements.#{column}"

            tbody
              className: "#{bn}__table-body"
              @table bans[0]

            tbody
              className: "#{bn}__table-body #{bn}__table-body--notes"
              @table bans[1]

  table: (events) ->
    for event, i in events
      tr
        key: i

        td
          className: "#{bn}__table-cell #{bn}__table-cell--date"
          time className: "timeago", dateTime: event.timestamp

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
            moment(event.timestamp).add(event.length, 'seconds').from(event.timestamp, true)

        td
          className: "#{bn}__table-cell #{bn}__table-cell--description"
          span
            className: "#{bn}__description"
            event.description
            if currentUser.is_admin && event.banner?
              span
                className: "#{bn}__banner"
                dangerouslySetInnerHTML:
                  __html: osu.trans 'users.show.extra.account_standing.recent_infringements.banner',
                    username: osu.link laroute.route('users.show', user: event.banner.id), event.banner.username


  remaining: (event) ->
    Math.round moment(event.timestamp).add(event.length, 'seconds').subtract(moment.now()).unix() / 3600




