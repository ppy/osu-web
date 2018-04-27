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

{div, h1, span, a, i} = ReactDOMFactories
el = React.createElement

class ProfilePage.HeaderInfo extends React.PureComponent
  render: =>
    avatar = el UserAvatar, user: @props.user, modifiers: ['profile']

    div className: 'profile-info',
      if @props.user.id == currentUser.id
        a
          href: "#{laroute.route 'account.edit'}#avatar"
          title: osu.trans 'users.show.change_avatar'
          avatar
      else
        avatar
      div className: 'profile-info__details',
        if @props.user.is_supporter
          el SupporterIcon
        h1
          className: 'profile-info__name'
          @props.user.username
          div className: 'profile-info__previous-usernames', @previousUsernames()
        # hard space if no title
        span className: 'profile-info__title', @props.user.title ? '\u00A0'
        div className: 'profile-info__flags',
          a
            href: laroute.route 'rankings',
              mode: @props.currentMode,
              country: @props.user.country.code,
              type: 'performance'
            el FlagCountry, country: @props.user.country
      div
        className: 'profile-info__bar hidden-xs'
        style:
          backgroundColor: @props.user.profile_colour


  previousUsernames: =>
    return if @props.user.previous_usernames.length == 0

    previousUsernames = @props.user.previous_usernames.join(', ')

    div
      className: 'profile-previous-usernames'
      # FIXME: doesn't quite work reliably.
      a # link so title is shown in mobile (onClick is required)
        className: 'profile-previous-usernames__icon profile-previous-usernames__icon--with-title'
        title: "#{osu.trans('users.show.previous_usernames')}: #{previousUsernames}"
        onClick: @doNothing
        i className: 'fas fa-address-card'
      div
        className: 'profile-previous-usernames__icon profile-previous-usernames__icon--plain'
        i className: 'fas fa-address-card'
      div
        className: 'profile-previous-usernames__content'
        div
          className: 'profile-previous-usernames__title'
          osu.trans('users.show.previous_usernames')
        div
          className: 'profile-previous-usernames__names'
          previousUsernames


  doNothing: (e) -> # ┐(°～° )┌
