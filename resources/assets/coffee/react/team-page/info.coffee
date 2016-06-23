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
el = React.createElement

class TeamPage.Info extends React.Component

  componentDidMount: ->
    osu.pageChange()


  componentDidUpdate: ->
    osu.pageChange()

  update: (key, value) =>
    # Generic Update Function. define extensions for practical use.
    data = {}
    data[key] = value
    $.ajax laroute.route('team.updateprofile', id: @props.team.id),
      method: 'post'
      data: data
      dataType: 'json'
    .done (userData) ->
      @props.refresh
    .fail (_e, data) ->
      osu.ajaxError data.jqXHR

  render: =>

    el 'div', className: 'page-contents__content profile-info',
      
      if @props.team.info?
        el 'div', className: 'page-contents__row',
          el EditableText,
            text: @props.team.info
            tag: 'p'
            css: ''  #deny css styling
            callBack: (text) => @update 'info', text

      if @props.team.created_at?
        el 'dl', className: 'page-contents__row',
          el 'dt', className: 'profile-info__data-key', Lang.get('teams.show.joined_at', date: '')
          el 'dd', className: 'profile-info__data-value', @props.team.created_at

      if @props.team.website?
        el 'dl', className: 'page-contents__row',
          el 'dt', className: 'profile-info__data-key', 'Website'
          el EditableText,
            text: @props.team.website
            tag: 'a'
            href: @props.team.website
            callBack: (website) => @update 'website', website
