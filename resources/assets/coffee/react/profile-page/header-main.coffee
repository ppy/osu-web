###
#    Copyright 2015-2017 ppy Pty. Ltd.
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

{button, div, span} = ReactDOMFactories
el = React.createElement

class ProfilePage.HeaderMain extends React.Component
  constructor: (props) ->
    super props

    @state =
      editing: false
      coverUrl: props.user.cover_url
      isCoverUpdating: false
      settingDefaultMode: false

    @debouncedCoverSet = _.debounce @coverSet, 300


  componentDidMount: =>
    $.subscribe 'user:cover:reset.profilePageHeaderMain', @coverReset
    $.subscribe 'user:cover:set.profilePageHeaderMain', @debouncedCoverSet
    $.subscribe 'user:cover:upload:state.profilePageHeaderMain', @coverUploadState

    $.subscribe 'key:esc.profilePageHeaderMain', @closeEdit
    $(document).on 'click.profilePageHeaderMain', @closeEdit


  componentWillReceiveProps: (newProps) =>
    @debouncedCoverSet null, newProps.user.cover.url


  componentWillUnmount: =>
    $.unsubscribe '.profilePageHeaderMain'
    $(document).off '.profilePageHeaderMain'

    @closeEdit()
    @debouncedCoverSet.cancel()
    @xhr?.abort()


  render: =>
    mainClasses = 'profile-header'
    mainClasses += ' profile-header--editing u-blackout-visible' if @state.editing

    div
      className: mainClasses
      style:
        backgroundImage: "url('#{@state.coverUrl}')"

      div
        className: 'profile-header__spinner'
        'data-visibility': 'hidden' if !@state.isCoverUpdating

        div className: 'spinner',
          div className: 'spinner__cube'
          div className: 'spinner__cube spinner__cube--2'

      # to allow space-between to work properly in firefox
      # reference: https://github.com/philipwalton/flexbugs/issues/111
      div
        className: 'profile-header__container'
        div
          className: 'profile-header__column'
          el ProfilePage.HeaderInfo, user: @props.user, currentMode: @props.currentMode

        if !@props.user.is_bot
          div
            className: 'profile-header__column'
            el ProfilePage.Stats, stats: @props.stats

      if @props.withEdit && @props.user.playmode != @props.currentMode
        button
          className: "profile-header__default-mode #{'profile-header__default-mode--disabled' if @state.settingDefaultMode}"
          type: 'button'
          onClick: @setDefaultMode
          dangerouslySetInnerHTML:
            __html:
              osu.trans 'users.show.edit.default_playmode.set', mode: "<strong>#{osu.trans "beatmaps.mode.#{@props.currentMode}"}</strong>"

      div
        className: 'profile-header__actions',
        if @props.withEdit
          div
            ref: (el) =>
              @coverSelector = el
            button
              type: 'button'
              className: 'btn-circle'
              onClick: @toggleEdit
              span className: 'btn-circle__content',
                el Icon, name: 'pencil'
            if @state.editing
              el ProfilePage.CoverSelector,
                canUpload: @props.user.is_supporter
                cover: @props.user.cover


  closeEdit: (e) =>
    return unless @state.editing

    if e?
      return if $(e.target).closest(@coverSelector).length

    return if $('#overlay').is(':visible')
    return if document.body.classList.contains('modal-open')

    Blackout.hide()
    @setState editing: false, =>
      @coverReset()


  coverReset: =>
    @debouncedCoverSet null, @props.user.cover.url


  coverSet: (_e, url) =>
    return if @state.isCoverUpdating

    @setState coverUrl: url


  coverUploadState: (_e, state) =>
    @setState isCoverUpdating: state


  openEdit: =>
    Blackout.show()
    @setState editing: true


  toggleEdit: =>
    if @state.editing
      @closeEdit()
    else
      @openEdit()


  setDefaultMode: =>
    @setState settingDefaultMode: true

    @xhr = $.ajax laroute.route('account.update'),
      method: 'PUT'
      data:
        user:
          playmode: @props.currentMode
    .done (data) ->
      $.publish 'user:update', data
    .fail (xhr, status) ->
      return if status == 'abort'

      osu.emitAjaxError() xhr
    .always =>
      @setState settingDefaultMode: false
