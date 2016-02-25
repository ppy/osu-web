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
    $.subscribe 'key:esc.profilePageHeader', @closeEdit


  componentWillReceiveProps: (newProps) =>
    @coverSet null, newProps.user.cover.url


  componentWillUnmount: =>
    @coverSet.cancel

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
    mainClasses = 'osu-layout__row osu-layout__row--page-compact profile-header'
    mainClasses += ' u-blackout-visible' if @state.editing

    el 'div', className: mainClasses,
      el 'div',
        className: 'profile-cover',
        style:
          backgroundImage: "url('#{@state.coverUrl}')"

      el 'div', className: 'profile-avatar-container',
        el 'div',
          className: 'avatar avatar--profile'
          style:
            backgroundImage: "url('#{@props.user.avatarUrl}')"

      el 'div',
        className: 'profile-cover-uploading-spinner'
        'data-state': 'enabled' if @props.isCoverUpdating

        el 'div', className: 'spinner',
          el 'div', className: 'spinner__cube'
          el 'div', className: 'spinner__cube spinner__cube--2'

      el 'div', className: 'user-bar-container',
        el 'div', className: 'user-profile-header__bar user-profile-header__bar--left',
          el ProfilePage.HeaderFlags, user: @props.user
          el ProfilePage.HeaderInfo, user: @props.user
        el 'div', className: 'user-profile-header__bar user-profile-header__bar--right',
          el ProfilePage.Rank,
            rank: @props.stats.rank
            countryName: @props.user.country.name
            currentMode: @props.currentMode

      if @props.withEdit
        el 'div', className: 'profile-change-cover-button', onClick: @toggleEdit,
          Lang.get 'users.show.edit.cover.button'

      if @state.editing
        el ProfilePage.CoverSelector, canUpload: @props.user.isSupporter, cover: @props.user.cover
