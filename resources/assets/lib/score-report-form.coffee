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

import { createElement as el, PureComponent } from 'react'

export class ScoreReportForm extends PureComponent
  constructor: ->
    @state =
      mode: null
      score: null


  componentDidMount: =>
    $.subscribe 'score:report', @setScore
    $.subscribe 'report:close', @closeReport


  componentWillUnmount: ->
    $.unsubscribe 'score:report'
    $.unsubscribe 'report:close'


  render: =>
    el _exported.ReportForm,
      afterReport: =>
        $.publish 'score:report-presence:set', @state.score?.id
      reportUrl: laroute.route 'scores.report',
        mode: @state.mode
        score: @state.score?.id
      showingModal: @state.mode? && @state.score?
      title: osu.trans 'users.report.scores.title', username: "<strong>#{@state.score?.user.username}</strong>"


  closeReport: =>
    @setState
      mode: null
      score: null


  setScore: (_e, {mode, score}) =>
    @setState
      mode: mode
      score: score
