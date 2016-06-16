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
Modal = ReactBootstrap.Modal
{div, p, input, i, button} = React.DOM

class TeamPage.AddUserButton extends React.Component
  constructor: ->
    @state =
      showmodal: false
      searchResults: []
      searching: false
      searchQuery: ''
      addingUser: false
      userToAdd: {}
    @debounceSearchRequest = _.debounce @searchRequest, 500
  open: =>
    @setState showmodal: true
  close: =>
    console.log 'closing'
    @setState
      showmodal: false
      searchResults: []
      searching: false
      searchQuery: ''
      addingUser: false
      userToAdd: {}
  search: (ev) =>
    @setState searching: true, searchQuery: ev.target.value, addingUser: false, userToAdd: {}
    @debounceSearchRequest()
  searchRequest: =>
    $.ajax laroute.route('users.search', query: @state.searchQuery),
        method: 'get'
      .done (data) =>
        @setState searchResults: data.data, searching: false
  addUserPrompt: (user) =>
    @setState addingUser: true, userToAdd: user

  addUser: =>
    console.log 'adding user'
    if @state.addingUser and @state.userToAdd
      $.ajax laroute.route('team.addmember', user: @state.userToAdd.id, admin: + @props.admin, id: @props.team.id),
        method: 'get'
      .done (data) =>
        @props.refresh()
        @setState addingUser: false, userToAdd: {}, showmodal: false


  render: =>
    div className: 'team-members__add', onClick: @open,
      i className: 'fa fa-plus team-members__icon'
      el Modal, show: @state.showmodal, onHide: @close,
        el Modal.Header, bsClass: 'team-add-user-dialog__header modal', closebutton: true,
          div className: 'form-group has-feedback',
              input 
                type: 'textbox'
                className: 'form-control team-add-user-dialog__search'
                placeholder: Lang.get("beatmaps.listing.search.prompt")
                value: @state.searchQuery
                onChange: @search
              i className:'fa fa-search form-control-feedback'
        el Modal.Body, bsClass: 'team-add-user-dialog__body modal',
          if not @state.addingUser then div {},
            p {}, 'Enter a search term' if @state.searchQuery is '' and @state.searchResults.length is 0
            p {}, 'Searching' if @state.searching
            p {}, 'No results found :(' if not @state.searching and @state.searchResults.length is 0 and @state.searchQuery isnt ''
            el ProfileCard, user: user, click: @addUserPrompt, key: user.username  for user in @state.searchResults unless @state.searching
          else div {},
            p {}, 'Add this player to your group?' 
            el ProfileCard, user: @state.userToAdd 
            div className: 'big-button', 
              button className: 'btn-osu team-add-user-dialog__confirm', onClick: @addUser,
                "Yes"

