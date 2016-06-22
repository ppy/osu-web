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

class TeamPage.Header extends React.Component
  constructor: (props) ->
    super props
    @state =
      editing: false
      coverUrl: props.team.cover.url

    @coverSet = _.debounce @coverSet, 300


  componentDidMount: =>
    @_removeListeners()
    $.subscribe 'user:cover:set.profilePageHeader', @coverSet
    $.subscribe 'user:cover:reset.profilePageHeader', @coverReset
    $.subscribe 'key:esc.profilePageHeader', @closeEdit


  componentWillReceiveProps: (newProps) =>
    @coverSet null, newProps.team.cover.url


  componentWillUnmount: =>
    @coverSet.cancel()

    @_removeListeners()


  _removeListeners: =>
    $.unsubscribe '.profilePageHeader'
    $(document).off '.profilePageHeader'


  closeEdit: =>
    return unless @state.editing

    @toggleEdit()


  toggleEdit: =>
    if @state.editing
      @coverReset()
      Fade.out $('.blackout')[0]
      $(document).off 'click.profilePageHeader.toggleHeaderEdit'
    else
      Fade.in $('.blackout')[0]

      $(document).on 'click.profilePageHeader.toggleHeaderEdit', (e) =>
        return if $(e.target).closest('.profile-cover-change-popup').length
        return if $(e.target).closest('.js-profile-header__change-cover-button').length
        return if $('#overlay').is(':visible')
        @toggleEdit()

    @setState editing: !@state.editing


  coverReset: =>
    @coverSet null, @props.team.cover.url


  coverSet: (_e, url) =>
    return if @props.isCoverUpdating
    
    @setState coverUrl: url


  render: =>
    mainClasses = 'osu-layout__row osu-layout__row--page-compact profile-header'
    mainClasses += ' u-blackout-visible' if @state.editing

    el 'div', className: mainClasses,
      el 'div',
        className: 'profile-header__cover',
        style:
          backgroundImage: "url('#{@state.coverUrl}')"

      el 'div', className: 'profile-header__avatar-container',
        el TeamAvatar, team: @props.team, modifiers: ['profile']

      el 'div',
        className: 'profile-header__uploading-spinner-container'
        'data-state': 'enabled' if @props.isCoverUpdating

        el 'div', className: 'spinner',
          el 'div', className: 'spinner__cube'
          el 'div', className: 'spinner__cube spinner__cube--2'

      el 'div', className: 'profile-header__userbar-container',
        el 'div', className: 'user-profile-header user-profile-header--left',
          el TeamPage.HeaderFlags, team: @props.team
          el TeamPage.HeaderInfo, team: @props.team
        el 'div', className: 'user-profile-header user-profile-header--right',
          el TeamPage.Rank,
            rank: 1
      if @props.withEdit
        el 'div',
          className: 'profile-header__change-cover-button js-profile-header__change-cover-button',
          onClick: @toggleEdit,
          Lang.get 'users.show.edit.cover.button'

      if @state.editing
        el TeamPage.CoverSelector, canUpload: true, cover: @props.team.cover, team: @props.team
