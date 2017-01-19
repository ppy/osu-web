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

el = React.createElement

class ProfilePage.RecentActivities extends React.Component
  _renderEntry: (event) =>
    # default, empty badge
    badge = el 'div', className: 'profile-extra-entries__icon'

    if event.parse_error
      return

    switch event.type
      when 'rank'
        badge = el 'div',
          className: "profile-extra-entries__icon"
          el 'div',
            className: "badge-rank badge-rank--#{event.scoreRank} profile-extra-entries__icon"

        text = el 'div',
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.rank',
              user: osu.link(event.user.url, event.user.username)
              rank: event.rank
              beatmap: osu.link(event.beatmap.url, event.beatmap.title)
              mode: osu.trans "beatmaps.mode.#{event.mode}"

      when 'rankLost'
        text = el 'div',
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.rank_lost',
              user: osu.link(event.user.url, event.user.username)
              rank: event.rank
              beatmap: osu.link(event.beatmap.url, event.beatmap.title)
              mode: osu.trans "beatmaps.mode.#{event.mode}"

      when 'beatmapsetDelete'
        text = el 'div',
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.beatmapset_delete',
              beatmapset: osu.link(event.beatmapset.url, event.beatmapset.title)

      when 'beatmapsetRevive'
        text = el 'div',
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.beatmapset_revive',
              beatmapset: osu.link(event.beatmapset.url, event.beatmapset.title)
              user: osu.link(event.user.url, event.user.username)

      when 'beatmapsetUpdate'
        text = el 'div',
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.beatmapset_update',
              user: osu.link(event.user.url, event.user.username)
              beatmapset: osu.link(event.beatmapset.url, event.beatmapset.title)

      when 'beatmapsetUpload'
        text = el 'div',
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.beatmapset_upload',
              beatmapset: osu.link(event.beatmapset.url, event.beatmapset.title)
              user: osu.link(event.user.url, event.user.username)

      when 'achievement'
        badge = el ProfilePage.AchievementBadge,
          achievement: event.achievement
          userAchievement:
            achieved_at: event.createdAt
            achievement_id: event.achievement.id
          additionalClasses: 'profile-extra-entries__icon'

        text = el 'div',
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.achievement',
              user: osu.link(event.user.url, event.user.username)
              achievement: event.achievement.name

      when 'usernameChange'
        text = el 'div',
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.username_change',
              user: osu.link(event.user.url, event.user.username)
              previousUsername: event.user.previousUsername

      when 'userSupportAgain'
        text = el 'div',
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.user_support_again',
              user: osu.link(event.user.url, event.user.username)

      when 'userSupportFirst'
        text = el 'div',
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.user_support_first',
              user: osu.link(event.user.url, event.user.username)

      when 'userSupportGift'
        text = el 'div',
          className: 'profile-extra-entries__text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'events.user_support_gift',
              user: osu.link(event.user.url, event.user.username)

      else
        return null

    el 'li',
      className: 'profile-extra-entries__item'
      key: event.id
      el 'div', className: 'profile-extra-entries__detail',
        badge
        text
      el 'div',
        className: 'profile-extra-entries__time'
        dangerouslySetInnerHTML: { __html: osu.timeago(event.createdAt) }


  render: =>
    el 'div',
      className: 'page-extra'
      el ProfilePage.ExtraHeader, name: @props.name, withEdit: @props.withEdit

      if @props.recentActivities.length
        el 'ul', className: 'profile-extra-entries',
          @props.recentActivities.map (activity) => @_renderEntry(activity)
      else
        el 'p', className: 'profile-extra-entries', osu.trans('events.empty')
