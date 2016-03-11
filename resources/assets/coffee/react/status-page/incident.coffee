###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License version 3
# as published by the Free Software Foundation.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
{div, span} = React.DOM
el = React.createElement

class Status.Incident extends React.Component
  propTypes = 
    description: React.PropTypes.string.isRequired
    active : React.PropTypes.bool.isRequired
    status: React.PropTypes.string.isRequired
    date: React.PropTypes.string.isRequired
    by: React.PropTypes.string.isRequired

  constructor: (props) ->
    super props

  render: =>
    fromNow = moment(@props.date, 'DD-MM-YYYY HH:mm:ss').fromNow()

    div 
      className: 'status-incident'
      div 
        className: "status-incident__state status-incident__state--#{@props.status}"
      div 
        className: 'status-incident__content'
        div 
          className: 'status-incident__info'
          span className: 'status-incident__info-date',
            "#{fromNow}, " 
          span className: 'status-incident__info-by',
            if _.isEmpty(@props.by) then Lang.get('status_page.incidents.automated') else "by #{@props.by}"
        div 
          className: 'status-incident__desc'
          span 
            className: 'status-incident__desc--resolved' unless !@props.active
            @props.description
          span
            " #{Lang.get('status_page.recent.incidents.state.' + @props.status)}!"
