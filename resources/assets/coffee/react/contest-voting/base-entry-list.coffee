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

export class BaseEntryList extends React.Component
  constructor: (props) ->
    super props

    @state =
      waitingForResponse: false
      contest: @props.contest
      selected: @props.selected
      options:
        showPreview: @props.options.showPreview ? false
        showLink: @props.options.showLink ? false
        linkIcon: @props.options.linkIcon ? false

  handleVoteClick: (_e, {contest_id, entry_id, callback}) =>
    return unless contest_id == @state.contest.id

    selected = _.clone @state.selected

    if _.includes(selected, entry_id)
      _.pull selected, entry_id
    else
      selected.push entry_id

    @setState
      selected: selected
      waitingForResponse: true
      callback

  handleUpdate: (_e, {response, callback}) =>
    return unless response.contest.id == @state.contest.id

    @setState
      contest: response.contest
      selected: response.userVotes
      waitingForResponse: false
      callback

  componentDidMount: ->
    $.subscribe 'contest:vote:click.contest', @handleVoteClick
    $.subscribe 'contest:vote:done.contest', @handleUpdate

  componentWillUnmount: ->
    $.unsubscribe '.contest'
