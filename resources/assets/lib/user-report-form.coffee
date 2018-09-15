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
import { div } from 'react-dom-factories'
import { SelectOptions } from 'select-options'

bn = 'report-form'
options = [
  { id: 'Cheating', text: osu.trans 'users.report.options.cheating' },
  { id: 'Insults', text: osu.trans 'users.report.options.insults' },
  { id: 'Spam', text: osu.trans 'users.report.options.spam' },
  { id: 'UnwantedContent', text: osu.trans 'users.report.options.unwanted_content' },
  { id: 'Nonsense', text: osu.trans 'users.report.options.nonsense' },
  { id: 'Other', text: osu.trans 'users.report.options.other' },
]

export class UserReportForm extends PureComponent
  constructor: ->
    @state =
      selectedReason: options[0]
      user: null

  componentDidMount: =>
    $.subscribe 'user:report', @setUser
    $.subscribe 'report:close', @closeReport


  componentWillUnmount: ->
    $.unsubscribe 'user:report'
    $.unsubscribe 'report:close'


  onItemSelected: (item) =>
    @setState selectedReason: item


  render: =>
    el _exported.ReportForm,
      reportData: reason: @state.selectedReason.id
      reportUrl: laroute.route 'users.report', user: @state.user?.id
      showingModal: @state.user?
      title: osu.trans 'users.report.title', username: "<strong>#{@state.user?.username}</strong>"

      div
        className: "#{bn}__row"
        osu.trans 'users.report.reason'

      div
        className: "#{bn}__row"
        el SelectOptions,
          blackout: false
          bn: "#{bn}-select-options"
          onItemSelected: @onItemSelected
          options: options
          selected: @state.selectedReason


  closeReport: =>
    @setState
      selectedReason: options[0]
      user: null


  setUser: (_e, user) =>
    @setState
      user: user

