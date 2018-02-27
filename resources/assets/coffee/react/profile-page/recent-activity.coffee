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

{div, li, p, ul} = ReactDOMFactories
el = React.createElement

class ProfilePage.RecentActivity extends React.PureComponent
  render: =>
    div
      className: 'page-extra'
      el ProfilePage.ExtraHeader, name: @props.name, withEdit: @props.withEdit

      if @props.recentActivity.length
        div null,
          ul
            className: 'profile-extra-entries'
            @props.recentActivity.map @_renderEntry
          div
            className: 'profile-extra-entries__item'
            el ProfilePage.ShowMoreLink,
              collection: @props.recentActivity
              propertyName: 'recentActivity'
              pagination: @props.pagination['recentActivity']
              route: laroute.route 'users.recent-activity', user: @props.user.id
      else
        p className: 'profile-extra-entries', osu.trans('events.empty')


  _renderEntry: (event) =>
    return if event.parse_error

    switch event.type
      when 'achievement'
        badge = el ProfilePage.AchievementBadge,
          achievement: event.achievement
          userAchievement:
            achieved_at: event.createdAt
            achievement_id: event.achievement.id
          additionalClasses: 'profile-extra-entries__icon'

        text = div
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.achievement',
              user: osu.link(event.user.url, event.user.username)
              achievement: event.achievement.name

      when 'beatmapPlaycount'
        text = div
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.beatmap_playcount',
              beatmap: osu.link(event.beatmap.url, event.beatmap.title)
              count: event.count

      when 'beatmapsetApprove'
        text = div
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.beatmapset_approve',
              approval: event.approval
              beatmapset: osu.link(event.beatmapset.url, event.beatmapset.title)
              user: osu.link(event.user.url, event.user.username)

      when 'beatmapsetDelete'
        text = div
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.beatmapset_delete',
              beatmapset: osu.link(event.beatmapset.url, event.beatmapset.title)

      when 'beatmapsetRevive'
        text = div
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.beatmapset_revive',
              beatmapset: osu.link(event.beatmapset.url, event.beatmapset.title)
              user: osu.link(event.user.url, event.user.username)

      when 'beatmapsetUpdate'
        text = div
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.beatmapset_update',
              user: osu.link(event.user.url, event.user.username)
              beatmapset: osu.link(event.beatmapset.url, event.beatmapset.title)

      when 'beatmapsetUpload'
        text = div
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.beatmapset_upload',
              beatmapset: osu.link(event.beatmapset.url, event.beatmapset.title)
              user: osu.link(event.user.url, event.user.username)

      when 'medal'
        # shouldn't exist because the type is overridden to achievement.
        return

      when 'rank'
        badge = div
          className: "profile-extra-entries__icon"
          div
            className: "badge-rank badge-rank--#{event.scoreRank} profile-extra-entries__icon"

        text = div
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.rank',
              user: osu.link(event.user.url, event.user.username)
              rank: event.rank
              beatmap: osu.link(event.beatmap.url, event.beatmap.title)
              mode: osu.trans "beatmaps.mode.#{event.mode}"

      when 'rankLost'
        text = div
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.rank_lost',
              user: osu.link(event.user.url, event.user.username)
              rank: event.rank
              beatmap: osu.link(event.beatmap.url, event.beatmap.title)
              mode: osu.trans "beatmaps.mode.#{event.mode}"

      when 'userSupportAgain'
        text = div
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.user_support_again',
              user: osu.link(event.user.url, event.user.username)

      when 'userSupportFirst'
        text = div
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.user_support_first',
              user: osu.link(event.user.url, event.user.username)

      when 'userSupportGift'
        text = div
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.user_support_gift',
              user: osu.link(event.user.url, event.user.username)

      when 'usernameChange'
        text = div
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.username_change',
              user: osu.link(event.user.url, event.user.username)
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
        dangerouslySetInnerHTML:
          __html: osu.timeago(event.createdAt)
