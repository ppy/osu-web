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
    most_recent = _.first @props.user.recent_infringements

    div
      className: 'page-extra'
      el ProfilePage.ExtraHeader, name: @props.name, withEdit: false

      div
        className: "#{bn}"

        if most_recent?
          div
            className: "#{bn}__box #{bn}__box--large #{bn}__box--warning"
            span
              dangerouslySetInnerHTML:
                __html: osu.trans 'users.show.extra.account_standing.bad_standing',
                  username: @props.user.username

        if most_recent? && moment(most_recent.end_time).isAfter(moment.now())
          div
            className: "#{bn}__box #{bn}__box--large #{bn}__box--info"
            span
              dangerouslySetInnerHTML:
                __html: osu.trans 'users.show.extra.account_standing.remaining_silence',
                  username: @props.user.username
                  duration: @remaining most_recent

      div {},
        h3
          className: 'page-extra__title page-extra__title--small'
          osu.trans 'users.show.extra.account_standing.recent_infringements.title'

        div className: "#{bn}__table-box",
          table
            className: "#{bn}__table"
            thead {},
              tr {},
                for el in columns
                  th
                    key: el
                    className: "#{bn}__table-cell #{bn}__table-cell--#{el}"
                    div
                      className: "#{bn}__table-header #{bn}__table-header--#{el}"
                      osu.trans "users.show.extra.account_standing.recent_infringements.#{el}"

            @table _.filter @props.user.recent_infringements, (d) -> d.type != 'note'

          table
            className: "#{bn}__table #{bn}__table--notes"
            @table _.filter @props.user.recent_infringements, (d) -> d.type == 'note'

  cell: (column, event) ->
    modifier = switch column
      when 'action' then event.type
      when 'length'
        if event.type == 'restriction'
          'restriction'

    content = switch column
      when 'date' then time className: 'timeago', dateTime: event.timestamp
      when 'action' then osu.trans "users.show.extra.account_standing.recent_infringements.actions.#{event.type}"
      when 'length'
        if event.type == 'note'
         ''
        else if event.type == 'restriction'
          osu.trans 'users.show.extra.account_standing.recent_infringements.length_permament'
        else
          moment(event.timestamp).add(event.length, 'seconds').from(event.timestamp, true)
      else event[column]

    div
      className: "#{bn}__box #{bn}__box--small #{bn}__box--#{modifier} #{bn}__box--#{column}"
      content

  table: (events) ->
    tbody {},
      for event, i in events
        tr key: i,
          for el in columns
            td
              key: el
              className: "#{bn}__table-cell #{bn}__table-cell--#{el}"
              @cell el, event


  remaining: (event) ->
    Math.round moment(event.timestamp).add(event.length, 'seconds').subtract(moment.now()).unix() / 3600




