# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Badges } from '../profile-page/badges'
import { Detail } from './detail'
import { HeaderInfo } from '../profile-page/header-info'
import { Links } from '../profile-page/links'
import { Stats } from './stats'
import * as React from 'react'
import HeaderV4 from 'header-v4'
import { Img2x } from 'img2x'
import headerLinks from 'profile-page/header-links'
import { a, div, h1, li, span, ul } from 'react-dom-factories'
el = React.createElement

export class Header extends React.Component
  render: =>
    div
      className: 'js-switchable-mode-page--scrollspy js-switchable-mode-page--page'
      'data-page-id': 'main'
      el HeaderV4,
        backgroundImage: @props.user.cover_url
        contentPrepend: @renderTournamentBanner()
        links: headerLinks(@props.user, 'modding')
        theme: 'users'
      div className: 'osu-page osu-page--users',
        div className: 'profile-header',
          div className: 'profile-header__top',
            el HeaderInfo, user: @props.user, currentMode: @props.user.playmode, coverUrl: @props.user.cover_url

            if !@props.user.is_bot
              el Stats, user: @props.user

          if !@props.user.is_bot
            el Detail,
              stats: @props.stats
              userAchievements: @props.userAchievements
              user: @props.user

          if @props.user.badges.length > 0
            el Badges, badges: @props.user.badges

          el Links, user: @props.user


  renderTournamentBanner: ({modifiers} = {}) =>
    return if !@props.user.active_tournament_banner?.id?

    a
      href: laroute.route('tournaments.show', tournament: @props.user.active_tournament_banner.tournament_id)
      className: osu.classWithModifiers 'profile-tournament-banner', modifiers
      el Img2x,
        src: @props.user.active_tournament_banner.image
        className: 'profile-tournament-banner__image'
