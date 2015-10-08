###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
el = React.createElement

class ProfilePage.Header extends React.Component
  constructor: (props) ->
    super props
    @state =
      editing: false
      coverUrl: props.user.cover.url

    @coverSet = _.debounce @coverSet, 300


  componentDidMount: =>
    @_removeListeners()
    $.subscribe 'user:cover:set.profilePageHeader', @coverSet
    $.subscribe 'user:cover:reset.profilePageHeader', @coverReset


  componentWillReceiveProps: (newProps) =>
    @setState coverUrl: newProps.user.cover.url


  componentWillUnmount: =>
    @_removeListeners()


  _removeListeners: =>
    $.unsubscribe '.profilePageHeader'


  toggleEdit: =>
    if @state.editing
      $('.blackout').css display: 'none'
      $('.profile-header').css zIndex: ''
      $(document).off 'click.profilePageHeader:toggleHeaderEdit'
    else
      $('.blackout').css display: 'block'
      $('.profile-header').css zIndex: 8001

      $(document).on 'click.profilePageHeader:toggleHeaderEdit', (e) =>
        return if $(e.target).closest('.profile-change-cover-popup').length
        return if $(e.target).closest('.profile-change-cover-button').length
        return if $('#overlay').is(':visible')
        @toggleEdit()

    @setState editing: !@state.editing


  coverReset: =>
    @coverSet null, @props.user.cover.url


  coverSet: (_e, url) =>
    return if @props.isCoverUpdating
    @setState coverUrl: url


  render: =>
    el 'div', className: 'row-page profile-header',
      el 'div',
        className: 'profile-cover',
        style:
          backgroundImage: "url('#{@state.coverUrl}')"

      el 'div', className: 'profile-avatar-container',
        el 'div',
          className: 'avatar avatar--profile'
          style:
            backgroundImage: "url('#{@props.user.avatarUrl}')"
          title: Lang.get('users.show.avatar', username: @props.user.username)

      if @props.withEdit
        el 'div', className: 'profile-change-cover-button', onClick: @toggleEdit,
          Lang.get 'users.show.edit.cover.button'

      if @state.editing
        el ProfilePage.CoverSelector, canUpload: @props.user.isSupporter, cover: @props.user.cover

      el 'div', className: 'user-bar-container',
        el ProfilePage.HeaderInfo, user: @props.user
        el ProfilePage.Rank,
          rank: @props.stats.rank
          countryName: @props.user.country.name
          mode: @props.mode
