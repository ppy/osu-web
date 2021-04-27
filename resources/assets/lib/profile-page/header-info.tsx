# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import FlagCountry from 'flag-country'
import * as React from 'react'
import { a, div, h1, span } from 'react-dom-factories'
import UserAvatar from 'user-avatar'
import UserGroupBadges from 'user-group-badges'
el = React.createElement


export class HeaderInfo extends React.PureComponent
  bn = 'profile-info'


  render: =>
    avatar = el UserAvatar, user: @props.user, modifiers: ['full']

    div className: bn,
      div
        className: "#{bn}__bg"
        style:
          backgroundImage: osu.urlPresence(@props.coverUrl)

      if @props.user.id == currentUser.id
        a
          className: "#{bn}__avatar"
          href: "#{laroute.route 'account.edit'}#avatar"
          title: osu.trans 'users.show.change_avatar'
          avatar
      else
        div
          className: "#{bn}__avatar"
          avatar

      div className: "#{bn}__details",
        h1
          className: "#{bn}__name"
          span className: 'u-ellipsis-pre-overflow', @props.user.username
          div className: "#{bn}__previous-usernames", @previousUsernames()

        @renderTitle() if @props.user.title?

        div className: "#{bn}__icon-group",
          div className: "#{bn}__icons",
            if @props.user.is_supporter
              span
                className: "#{bn}__icon #{bn}__icon--supporter"
                title: osu.trans('users.show.is_supporter')
                _(@props.user.support_level).times (i) =>
                  span
                    key: i
                    className: 'fas fa-heart'
            el UserGroupBadges, groups: @props.user.groups, modifiers: ['profile-page'], wrapper: "#{bn}__icon"
          div className: "#{bn}__icons #{bn}__icons--flag",
            if @props.user.country?.code?
              a
                className: "#{bn}__flag #{bn}__flag--country"
                href: laroute.route 'rankings',
                  mode: @props.currentMode,
                  country: @props.user.country.code,
                  type: 'performance'
                span className: "#{bn}__flag-flag",
                  el FlagCountry, country: @props.user.country
                span className: "#{bn}__flag-text",
                  @props.user.country.name
      div
        className: 'profile-info__bar hidden-xs'
        style:
          backgroundColor: @props.user.profile_colour


  renderTitle: ->
    element = if @props.user.title_url? then a else span

    element
      className: "#{bn}__title"
      href: @props.user.title_url
      style: color: @props.user.profile_colour
      @props.user.title


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
        span className: 'fas fa-address-card'
      div
        className: 'profile-previous-usernames__icon profile-previous-usernames__icon--plain'
        span className: 'fas fa-address-card'
      div
        className: 'profile-previous-usernames__content'
        div
          className: 'profile-previous-usernames__title'
          osu.trans('users.show.previous_usernames')
        div
          className: 'profile-previous-usernames__names'
          previousUsernames


  doNothing: (e) -> # ┐(°～° )┌
