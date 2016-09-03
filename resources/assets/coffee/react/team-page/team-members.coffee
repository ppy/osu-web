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

class TeamPage.TeamMembers extends React.Component
  componentDidMount: ->
    if @props.withEdit
      $('#admins, #members').sortable(
        connectWith: '.team-members__list',
        cancel: ".ui-state-disabled"
        items: "div:not(.team-members__add)"
        tolerance: 'pointer' # make it easier to drop
        over: (event,ui) ->
          ui.placeholder.insertBefore $(@).children 'div.team-members__add:first'
        receive: @updateRights
        stop: @updateCancel
        ).disableSelection()

  updateCancel: (event, ui) ->
    $(event.target).sortable('cancel')

  updateRights: (event, ui) =>
    userid = $(ui.item).attr 'id'
    LoadingOverlay.show()
    
    if @props.team.members.data.some((e) -> e.id == parseInt userid)
      newRights = 1
    else
      newRights = 0
    $.ajax laroute.route('team.addmember', user: userid, id: @props.team.id, admin: newRights),
        method: 'GET'
      .done (data) =>
        @props.refresh()
      .fail (xhr) ->
        osu.ajaxError xhr
  
  removeUser: (id) =>
    console.log 'removing user'
    LoadingOverlay.show()

    if id?
      $.ajax laroute.route('team.removemember', user: id, id: @props.team.id),
        method: 'get'
      .done (data) =>
        @props.refresh()
  render: =>
    el 'div', className: 'team-members',
      el 'p', className: 'team-members__title', Lang.get "teams.show.admins"
      el 'div', className: 'team-members__list', id: 'admins',
        @props.team.admins.data.map (m) ->
          el TeamMemberAvatar,
            user: m
            key: m.id
            modifiers: ['members']
            locked: m.id == window.currentUser.id
        if @props.withEdit
          el TeamPage.AddUserButton, team: @props.team, admin: true, refresh: @props.refresh
      el 'p', className: 'team-members__title', Lang.get "teams.show.members"
      el 'div', className: 'team-members__list', id: 'members',
        @props.team.members.data.map (m) =>
          el TeamMemberAvatar,
            user: m
            key: m.id
            modifiers: ['members']
            canRemove: true
            callback: => @removeUser m.id
        if @props.withEdit
          el TeamPage.AddUserButton, team: @props.team, admin: false, refresh: @props.refresh


