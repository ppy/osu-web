el = React.createElement

class ProfilePage.RecentActivities extends React.Component
  _renderEntry: (event) =>
    switch event.type
      when 'rank'
        el 'li',
          className: 'profile-extra-entries__item'
          key: event.id
          el 'div', className: 'profile-extra-entries__detail',
            el 'div',
              className: "profile-score-rank-badge profile-score-rank-badge--#{event.scoreRank} profile-extra-entries__icon"
            el 'div',
              className: 'profile-extra-entries__text'
              dangerouslySetInnerHTML:
                __html: Lang.get 'events.rank',
                  user: osu.link(event.user.url, event.user.username)
                  rank: event.rank
                  beatmap: osu.link(event.beatmap.url, event.beatmap.title)
                  mode: Lang.get "common.play_mode.#{event.mode}"
          el 'div',
            className: 'profile-extra-entries__time'
            dangerouslySetInnerHTML: { __html: osu.timeago(event.created_at) }

      when 'rankLost'
        el 'li',
          className: 'profile-extra-entries__item'
          key: event.id
          el 'div', className: 'profile-extra-entries__detail',
            el 'div',
              className: "profile-extra-entries__icon"
            el 'div',
              className: 'profile-extra-entries__text'
              dangerouslySetInnerHTML:
                __html: Lang.get 'events.rankLost',
                  user: osu.link(event.user.url, event.user.username)
                  rank: event.rank
                  beatmap: osu.link(event.beatmap.url, event.beatmap.title)
                  mode: Lang.get "common.play_mode.#{event.mode}"
          el 'div',
            className: 'profile-extra-entries__time'
            dangerouslySetInnerHTML: { __html: osu.timeago(event.created_at) }


      when 'beatmapUpdate'
        el 'li',
          className: 'profile-extra-entries__item'
          key: event.id
          el 'div', className: 'profile-extra-entries__detail',
            el 'div',
              className: 'profile-extra-entries__icon'
            el 'div',
              className: 'profile-extra-entries__text'
              dangerouslySetInnerHTML:
                __html: Lang.get 'events.beatmap_update',
                  user: osu.link(event.user.url, event.user.username)
                  beatmap: osu.link(event.beatmap.url, event.beatmap.title)
          el 'div',
            className: 'profile-extra-entries__time'
            dangerouslySetInnerHTML: { __html: osu.timeago(event.created_at) }

      when 'achievement'
        el 'li',
          className: 'profile-extra-entries__item'
          key: event.id
          el 'div', className: 'profile-extra-entries__detail',
            el ProfilePage.AchievementBadge, achievement: event.achievement, additionalClasses: 'profile-extra-entries__icon'
            el 'div',
              className: 'profile-extra-entries__text'
              dangerouslySetInnerHTML:
                __html: Lang.get 'events.achievement',
                  user: osu.link(event.user.url, event.user.username)
                  achievement: event.achievement.name
          el 'div',
            className: 'profile-extra-entries__time'
            dangerouslySetInnerHTML: { __html: osu.timeago(event.created_at) }

      else
        el 'li',
          key: event.id,
          el 'pre', null, JSON.stringify(event)


  render: =>
    el 'div',
      className: 'row-page profile-extra'
      el 'div', className: 'profile-extra__anchor js-profile-page-extra--scrollspy', id: 'recent_activities'
      el 'h2', className: 'profile-extra__title', Lang.get('users.show.extra.recent_activities.title')
      if @props.recentActivities.length
        el 'ul', className: 'profile-extra-entries',
          @props.recentActivities.map (activity) => @_renderEntry(activity)
      else
        el 'p', className: 'profile-extra-entries', Lang.get('events.empty')
