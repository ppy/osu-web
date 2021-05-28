# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { button, span } from 'react-dom-factories'

export class BaseEntryList extends React.Component
  constructor: (props) ->
    super props

    @state =
      waitingForResponse: false
      contest: @props.contest
      selected: @props.selected
      showVotedOnly: false
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


  renderToggleShowVotedOnly: =>
    button
      type: 'button'
      className: 'btn-osu-big btn-osu-big--contest-entries-toolbar'
      onClick: @onToggleShowVotedOnlyClick
      span className: 'btn-osu-big__icon-inline btn-osu-big__icon-inline--left',
        span className: if @state.showVotedOnly then 'fas fa-check-square' else 'far fa-square'
      osu.trans('contest.voting.show_voted_only')


  onToggleShowVotedOnlyClick: =>
    @setState showVotedOnly: !@state.showVotedOnly
