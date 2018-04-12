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

ProfilePage.HeaderInfo = ({user, currentMode}) ->
  avatar = el UserAvatar, user: user, modifiers: ['profile']

  div className: 'profile-info',
    if user.id == currentUser.id
      a
        href: "#{laroute.route 'account.edit'}#avatar"
        title: osu.trans 'users.show.change_avatar'
        avatar
    else
      avatar
    div className: 'profile-info__details',
      if user.is_supporter
        el SupporterIcon
      h1
        className: 'profile-info__name'
        title:
          if user.previous_usernames.length > 0
            osu.trans('users.show.previous_names', names: osu.transArray(user.previous_usernames))
        user.username
      # hard space if no title
      span className: 'profile-info__title', user.title ? '\u00A0'
      div className: 'profile-info__flags',
        a
          href: laroute.route 'rankings',
            mode: currentMode,
            country: user.country.code,
            type: 'performance'
          el FlagCountry, country: user.country
    div
      className: 'profile-info__bar hidden-xs'
      style:
        backgroundColor: user.profile_colour
