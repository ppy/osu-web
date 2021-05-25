# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Detail } from './detail'
import { Stats } from './stats'
import * as React from 'react'
import HeaderV4 from 'header-v4'
import { Img2x } from 'img2x'
import Badges from 'profile-page/badges'
import HeaderInfo from 'profile-page/header-info'
import headerLinks from 'profile-page/header-links'
import Links from 'profile-page/links'
import ProfileTournamentBanner from 'profile-tournament-banner'
import { a, div, h1, li, span, ul } from 'react-dom-factories'
el = React.createElement

export class Header extends React.Component
  render: =>
    div
      className: 'js-switchable-mode-page--scrollspy js-switchable-mode-page--page'
      'data-page-id': 'main'
      el HeaderV4,
        backgroundImage: @props.user.cover.url
        contentPrepend: el ProfileTournamentBanner,
          banner: @props.user.active_tournament_banner
        links: headerLinks(@props.user, 'modding')
        theme: 'users'
      div className: 'osu-page osu-page--users',
        div className: 'profile-header',
          div className: 'profile-header__top',
            el HeaderInfo, user: @props.user, currentMode: @props.user.playmode, coverUrl: @props.user.cover.url

            if !@props.user.is_bot
              el Stats, user: @props.user

          if !@props.user.is_bot
            el Detail,
              stats: @props.stats
              userAchievements: @props.userAchievements
              user: @props.user

          el Badges, badges: @props.user.badges

          el Links, user: @props.user
