el = React.createElement

class ProfilePage.RecentActivities extends React.Component
  constructor: (props) ->
    super props

    @state =
      recentActivities: osu.parseJson('json-user-recent-activities').data


  _renderEntry: (event) =>
    if event.type == 'rank'
      el 'li',
        className: 'event-entry'
        key: event.id
        el 'div', className: 'event-entry__detail',
          el 'div',
            className: "flex-none profile-score-rank-badge profile-score-rank-badge--#{event.scoreRank} profile-score-rank-badge--small"
          el 'div',
            className: 'event-entry__text'
            dangerouslySetInnerHTML:
              __html: Lang.get 'events.rank',
                user: osu.link(event.user.url, event.user.username)
                rank: event.rank
                beatmap: osu.link(event.beatmap.url, event.beatmap.title)
        el 'div',
          className: 'event-entry__time'
          dangerouslySetInnerHTML: { __html: osu.timeago(event.created_at) }
    else
      el 'li',
        key: event.id,
        el 'pre', null, JSON.stringify(event)


  render: =>
    el 'div', { className: 'row-page profile-extra' },
      el 'h2', { className: 'profile-extra-title' }, Lang.get('users.show.extra.recent_activities.title')
      el 'ul', { className: 'profile-recent-activities' },
        @state.recentActivities.map (activity) => @_renderEntry(activity)
