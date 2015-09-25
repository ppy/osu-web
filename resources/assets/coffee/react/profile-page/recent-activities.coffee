el = React.createElement

class ProfilePage.RecentActivities extends React.Component
  constructor: (props) ->
    super props

    @state =
      recentActivities: osu.parseJson('json-user-recent-activities').data


  _renderEntry: (event) =>
    switch event.type
      when 'rank'
        el 'li',
          className: 'event-entry'
          key: event.id
          el 'div', className: 'event-entry__detail',
            el 'div',
              className: "profile-score-rank-badge profile-score-rank-badge--#{event.scoreRank} event-entry__icon"
            el 'div',
              className: 'event-entry__text'
              dangerouslySetInnerHTML:
                __html: Lang.get 'events.rank',
                  user: osu.link(event.user.url, event.user.username)
                  rank: event.rank
                  beatmap: osu.link(event.beatmap.url, event.beatmap.title)
                  mode: Lang.get "common.play_mode.#{event.mode}"
          el 'div',
            className: 'event-entry__time'
            dangerouslySetInnerHTML: { __html: osu.timeago(event.created_at) }

      when 'rankLost'
        el 'li',
          className: 'event-entry'
          key: event.id
          el 'div', className: 'event-entry__detail',
            el 'div',
              className: "event-entry__icon"
            el 'div',
              className: 'event-entry__text'
              dangerouslySetInnerHTML:
                __html: Lang.get 'events.rankLost',
                  user: osu.link(event.user.url, event.user.username)
                  rank: event.rank
                  beatmap: osu.link(event.beatmap.url, event.beatmap.title)
                  mode: Lang.get "common.play_mode.#{event.mode}"
          el 'div',
            className: 'event-entry__time'
            dangerouslySetInnerHTML: { __html: osu.timeago(event.created_at) }


      when 'beatmapUpdate'
        el 'li',
          className: 'event-entry'
          key: event.id
          el 'div', className: 'event-entry__detail',
            el 'div',
              className: 'event-entry__icon'
            el 'div',
              className: 'event-entry__text'
              dangerouslySetInnerHTML:
                __html: Lang.get 'events.beatmap_update',
                  user: osu.link(event.user.url, event.user.username)
                  beatmap: osu.link(event.beatmap.url, event.beatmap.title)
          el 'div',
            className: 'event-entry__time'
            dangerouslySetInnerHTML: { __html: osu.timeago(event.created_at) }

      when 'achievement'
        el 'li',
          className: 'event-entry'
          key: event.id
          el 'div', className: 'event-entry__detail',
            el ProfilePage.AchievementBadge, achievement: event.achievement, additionalClasses: 'event-entry__icon'
            el 'div',
              className: 'event-entry__text'
              dangerouslySetInnerHTML:
                __html: Lang.get 'events.achievement',
                  user: osu.link(event.user.url, event.user.username)
                  achievement: event.achievement.name
          el 'div',
            className: 'event-entry__time'
            dangerouslySetInnerHTML: { __html: osu.timeago(event.created_at) }

      else
        el 'li',
          key: event.id,
          el 'pre', null, JSON.stringify(event)


  render: =>
    el 'div',
      className: 'row-page profile-extra'
      'data-profile-extra-page': 'recent_activities'
      el 'h2', className: 'profile-extra__title', Lang.get('users.show.extra.recent_activities.title')
      if @state.recentActivities.length
        el 'ul', className: 'profile-recent-activities',
          @state.recentActivities.map (activity) => @_renderEntry(activity)
      else
        el 'p', className: 'profile-recent-activities', Lang.get('events.empty')
