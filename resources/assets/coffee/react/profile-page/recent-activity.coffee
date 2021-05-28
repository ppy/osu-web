# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { AchievementBadge } from './achievement-badge'
import { ExtraHeader } from './extra-header'
import * as React from 'react'
import { div, li, p, ul } from 'react-dom-factories'
import ShowMoreLink from 'show-more-link'
import TimeWithTooltip from 'time-with-tooltip'
el = React.createElement

export class RecentActivity extends React.PureComponent
  link = (url, title) ->
    osu.link url, title, classNames: ['profile-extra-entries__link']


  render: =>
    div
      className: 'page-extra'
      el ExtraHeader, name: @props.name, withEdit: @props.withEdit

      if @props.recentActivity.length
        div null,
          ul
            className: 'profile-extra-entries'
            @props.recentActivity.map @_renderEntry
          div
            className: 'profile-extra-entries__item'
            el ShowMoreLink,
              modifiers: ['profile-page', 't-greyseafoam-dark']
              event: 'profile:showMore'
              hasMore: @props.pagination.recentActivity.hasMore
              loading: @props.pagination.recentActivity.loading
              data:
                name: 'recentActivity'
                url: laroute.route 'users.recent-activity', user: @props.user.id
      else
        p className: 'profile-extra-entries', osu.trans('events.empty')


  _renderEntry: (event) =>
    return if event.parse_error

    switch event.type
      when 'achievement'
        badge = div className: 'profile-extra-entries__icon',
          el AchievementBadge,
            modifiers: ['recent-activity']
            achievement: event.achievement
            userAchievement:
              achieved_at: event.created_at
              achievement_id: event.achievement.id

        text = div
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.achievement',
              user: link(event.user.url, event.user.username)
              achievement: event.achievement.name

      when 'beatmapPlaycount'
        text = div
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.beatmap_playcount',
              beatmap: link(event.beatmap.url, event.beatmap.title)
              count: event.count

      when 'beatmapsetApprove'
        text = div
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.beatmapset_approve',
              approval: osu.trans "events.beatmapset_status.#{event.approval}"
              beatmapset: link(event.beatmapset.url, event.beatmapset.title)
              user: link(event.user.url, event.user.username)

      when 'beatmapsetDelete'
        text = div
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.beatmapset_delete',
              beatmapset: link(event.beatmapset.url, event.beatmapset.title)

      when 'beatmapsetRevive'
        text = div
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.beatmapset_revive',
              beatmapset: link(event.beatmapset.url, event.beatmapset.title)
              user: link(event.user.url, event.user.username)

      when 'beatmapsetUpdate'
        text = div
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.beatmapset_update',
              user: link(event.user.url, event.user.username)
              beatmapset: link(event.beatmapset.url, event.beatmapset.title)

      when 'beatmapsetUpload'
        text = div
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.beatmapset_upload',
              beatmapset: link(event.beatmapset.url, event.beatmapset.title)
              user: link(event.user.url, event.user.username)

      when 'medal'
        # shouldn't exist because the type is overridden to achievement.
        return

      when 'rank'
        badge = div
          className: "profile-extra-entries__icon"
          div
            className: "score-rank score-rank--#{event.scoreRank}"

        text = div
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.rank',
              user: link(event.user.url, event.user.username)
              rank: event.rank
              beatmap: link(event.beatmap.url, event.beatmap.title)
              mode: osu.trans "beatmaps.mode.#{event.mode}"

      when 'rankLost'
        text = div
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.rank_lost',
              user: link(event.user.url, event.user.username)
              rank: event.rank
              beatmap: link(event.beatmap.url, event.beatmap.title)
              mode: osu.trans "beatmaps.mode.#{event.mode}"

      when 'userSupportAgain'
        text = div
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.user_support_again',
              user: link(event.user.url, event.user.username)

      when 'userSupportFirst'
        text = div
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.user_support_first',
              user: link(event.user.url, event.user.username)

      when 'userSupportGift'
        text = div
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.user_support_gift',
              user: link(event.user.url, event.user.username)

      when 'usernameChange'
        text = div
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.username_change',
              user: link(event.user.url, event.user.username)
              previousUsername: event.user.previousUsername

      else
        # unkown event
        return

    # default, empty badge
    badge ?= div className: 'profile-extra-entries__icon'

    li
      className: 'profile-extra-entries__item'
      key: event.id
      div
        className: 'profile-extra-entries__detail'
        badge
        text
      div
        className: 'profile-extra-entries__time'
        el TimeWithTooltip,
          dateTime: event.created_at
          relative: true
