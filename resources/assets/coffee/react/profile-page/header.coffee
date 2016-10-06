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
    $.subscribe 'user:cover:set.profilePageHeader', @coverSet
    $.subscribe 'user:cover:reset.profilePageHeader', @coverReset

    $.subscribe 'key:esc.profilePageHeader', @closeEdit
    $(document).on 'click.profilePageHeader', @closeEdit


  componentWillReceiveProps: (newProps) =>
    @coverSet null, newProps.user.cover.url


  componentWillUnmount: =>
    $.unsubscribe '.profilePageHeader'
    $(document).off '.profilePageHeader'

    @closeEdit()
    @coverSet.cancel()


  closeEdit: (e) =>
    return unless @state.editing

    if e?
      return if $(e.target).closest('.profile-cover-change-popup').length
      return if $(e.target).closest('.js-profile-header__change-cover-button').length

    return if $('#overlay').is(':visible')
    return if document.body.classList.contains('modal-open')

    Blackout.hide()
    @setState editing: false, =>
      @coverReset()


  openEdit: =>
    Blackout.show()
    @setState editing: true


  toggleEdit: (e) =>
    e.preventDefault()

    if @state.editing
      @closeEdit()
    else
      @openEdit()


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
        className: 'profile-header__cover',
        style:
          backgroundImage: "url('#{@state.coverUrl}')"

      el 'div', className: 'profile-header__avatar-container',
        el UserAvatar, user: @props.user, modifiers: ['profile']

      el 'div',
        className: 'profile-header__uploading-spinner-container spinner-container'
        'data-state': 'enabled' if @props.isCoverUpdating

        el 'div', className: 'spinner',
          el 'div', className: 'spinner__cube'
          el 'div', className: 'spinner__cube spinner__cube--2'

      el 'div', className: 'profile-header__userbar-container',
        el 'div', className: 'user-profile-header user-profile-header--left',
          el ProfilePage.HeaderFlags, user: @props.user
          el ProfilePage.HeaderInfo, user: @props.user
        el 'div', className: 'user-profile-header user-profile-header--right',
          el ProfilePage.Rank,
            rank: @props.stats.rank
            countryName: @props.user.country.name
            currentMode: @props.currentMode

      if @props.withEdit
        el 'div',
          className: 'profile-header__change-cover-button js-profile-header__change-cover-button',
          onClick: @toggleEdit,
          osu.trans 'users.show.edit.cover.button'

      if @state.editing
        el ProfilePage.CoverSelector, canUpload: @props.user.isSupporter, cover: @props.user.cover
