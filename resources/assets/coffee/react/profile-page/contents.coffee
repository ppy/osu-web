###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
el = React.createElement


class Info extends React.Component
  componentDidMount: ->
    $(document).trigger 'osu:page:change'


  componentDidUpdate: ->
    $(document).trigger 'osu:page:change'


  originKeys: =>
    keys = []
    if @props.user.country != null
      keys.push 'country'
    if @props.user.age != null
      keys.push 'age'

    return keys


  render: =>
    el 'div', className: 'profile-content flex-col-33',
      el 'div', className: 'profile-icons profile-row',
        if @props.user.isSupporter
          el 'div',
            className: 'user-icon forum__user-icon--supporter profile-icon'
            title: Lang.get 'users.show.is_supporter'
            el 'i', className: 'fa fa-heart'

      el 'div', className: 'compact profile-row',
        if @props.user.isSupporter
          el 'p', className: 'profile-title profile-title--supporter',
            Lang.get('users.show.is_supporter')

        if @props.user.title != null
          el 'p', className: 'profile-title', @props.user.title

      el 'div', className: 'compact profile-row',
        if @originKeys().length
          el 'p', null,
            Lang.get "users.show.origin.#{@originKeys().join('_')}",
              country: @props.user.country
              age: @props.user.age

        if @props.user.location
          el 'p', null,
            Lang.get 'users.show.current_location', location: @props.user.location

      el 'p',
        className: 'profile-row'
        dangerouslySetInnerHTML:
          __html: Lang.get 'users.show.lastvisit', date: osu.timeago(@props.user.lastvisit)

      if @props.user.twitter
        el 'dl', className: 'profile-data profile-row',
          el 'dt', null, 'Twitter'
          el 'dd', null,
            el 'a', href: "https://twitter.com/#{@props.user.twitter}",
              "@#{@props.user.twitter}"

      if @props.user.skype
        el 'dl', className: 'profile-data profile-row',
          el 'dt', null, 'Skype'
          el 'dd', null,
            el 'a', href: "skype:#{@props.user.skype}?chat", @props.user.skype

      if @props.user.lastfm
        el 'dl', className: 'profile-data profile-row',
          el 'dt', null, 'Last.fm'
          el 'dd', null,
            el 'a', href: "https://last.fm/user/#{@props.user.lastfm}",
              @props.user.lastfm

      if @props.user.playstyle.length
        el 'dl', className: 'profile-data profile-row',
          el 'dt', null, Lang.get('users.show.plays_with._')
          el 'dd', null,
            @props.user.playstyle.map (s) ->
              Lang.get "users.show.plays_with.#{s}"
            .join ', '


class Stats extends React.Component
  render: =>
    el 'div', className: 'profile-content flex-col-33',
      el 'div', className: 'profile-row profile-row--top',
        el 'div', className: 'profile-top-badge profile-level-badge',
          el 'span', className: 'profile-badge-number', @props.stats.level.current

        el 'div', className: 'profile-exp-bar',
          el 'div',
            className: 'profile-exp-bar-fill'
            style:
              width: "#{@props.stats.level.progress.toFixed()}%"

        el 'dl', className: 'profile-stats profile-stats--light',
          el 'dt', null,
            Lang.get('users.show.stats.level', level: @props.stats.level.current)
          el 'dd', null, "#{@props.stats.level.progress.toFixed()}%"

      el 'div', className: 'profile-row',
        el 'dl', className: 'profile-stats',
          el 'dt', null, Lang.get('users.show.stats.ranked_score')
          el 'dd', null, @props.stats.rankedScore.toLocaleString()

        el 'dl', className: 'profile-stats',
          el 'dt', null, Lang.get('users.show.stats.hit_accuracy')
          el 'dd', null, "#{@props.stats.hitAccuracy.toFixed(2)}%"

        el 'dl', className: 'profile-stats',
          el 'dt', null, Lang.get('users.show.stats.play_count')
          el 'dd', null, @props.stats.playCount.toLocaleString()

        el 'dl', className: 'profile-stats',
          el 'dt', null, Lang.get('users.show.stats.total_score')
          el 'dd', null, @props.stats.totalScore.toLocaleString()

        el 'dl', className: 'profile-stats',
          el 'dt', null, Lang.get('users.show.stats.total_hits')
          el 'dd', null, @props.stats.totalHits.toLocaleString()

        el 'dl', className: 'profile-stats',
          el 'dt', null, Lang.get('users.show.stats.maximum_combo')
          el 'dd', null, @props.stats.maximumCombo.toLocaleString()

        el 'dl', className: 'profile-stats',
          el 'dt', null, Lang.get('users.show.stats.replays_watched_by_others')
          el 'dd', null, @props.stats.replaysWatchedByOthers.toLocaleString()

        el 'dl', className: 'profile-stats profile-stats--full',
          el 'dt', null, Lang.get('users.show.stats.score_ranks')
          el 'dd', className: 'profile-score-ranks',
            ['ss', 's', 'a'].map (x) =>
              el 'div',
                key: "rank-#{x}"
                className: 'profile-score-rank'
                el 'div',
                  className: "profile-score-rank-badge profile-score-rank-badge--#{x}"
                el 'div', null, @props.stats.scoreRanks[x].toLocaleString()


class AchievementBadge extends React.Component
  render: =>
    filename = "/images/badges/user-achievements/#{@props.achievement.slug}.png"
    filename2x = "/images/badges/user-achievements/#{@props.achievement.slug}@2x.png"

    el 'div',
      className: "profile-achievement-badge #{@props.additionalClasses}",
      el 'img',
        src: filename
        srcSet: "#{filename} 1x, #{filename2x} 2x"
        alt: @props.achievement.name
        title: @props.achievement.name


class RecentAchievements extends React.Component
  render: =>
    achievementsProgress = (100 * @props.achievementsCounts.user / @props.achievementsCounts.total).toFixed()
    moreCount = @props.achievementsCounts.user - @props.recentAchievements.length

    el 'div', className: 'profile-content flex-col-33 text-center',
      el 'div', className: 'profile-row profile-row--top',
        el 'div', className: 'profile-achievements-badge profile-top-badge',
          el 'span', className: 'profile-badge-number',
            @props.achievementsCounts.user

        el 'div', className: 'profile-exp-bar',
          el 'div',
            className: 'profile-exp-bar-fill'
            style:
              width: "#{achievementsProgress}%"

        el 'dl', className: 'profile-stats profile-stats--light',
          el 'dt'
          el 'dd', null, "#{achievementsProgress}%"

      el 'div', className: 'profile-row profile-recent-achievements',
        @props.recentAchievements.map (achievement) =>
          el AchievementBadge,
            key: "profile-achievement-#{achievement.achievement_id}"
            achievement: achievement
            additionalClasses: 'profile-recent-achievement-badge'

      if moreCount > 0
        el 'small', null,
          Lang.get('users.show.more_achievements', count: moreCount)


class Tab extends React.Component
  render: =>
    className = 'profile-tab'
    className += ' profile-tab--active' if @props.mode == @props.currentMode

    el 'a',
      href: '#'
      'data-mode': @props.mode
      onClick: @props.modeChange
      className: className
      @props.text


class UserPage extends React.Component
  editStart: (e) ->
    e.preventDefault()
    $(document).trigger 'profile.user-page.update', editing: true


  pageNew: =>
    canCreate = @props.withEdit and @props.user.isSupporter

    el 'div',
      className: 'profile-content flex-col-66 text-center'

      el 'button',
        className: 'profile-page-new-content btn-osu btn-osu--lite btn-osu--profile-page-edit'
        onClick: @editStart
        disabled: !canCreate
        Lang.get('users.show.page.edit_big')

      el 'p', className: 'profile-page-new-content profile-page-new-icon',
        el 'i', className: 'fa fa-pencil-square-o'

      el 'p',
        className: 'profile-page-new-content'
        dangerouslySetInnerHTML:
          __html: Lang.get('users.show.page.description')

      el 'p',
        className: 'profile-page-new-content'
        dangerouslySetInnerHTML:
          __html: Lang.get('users.show.page.restriction_info')


  pageShow: =>
    el 'div', className: 'profile-content flex-col-66',
      if @props.withEdit
        el 'div', className: 'profile-user-page-header text-right',
          el 'a',
            href: '#'
            onClick: @editStart
            el 'i', className: 'fa fa-edit'

      el 'div', dangerouslySetInnerHTML:
        __html: @props.userPage.html

  render: =>
    if !@props.withEdit
      @pageShow()
    else if @props.userPage.editing
      el UserPageEditor, userPage: @props.userPage
    else if @props.userPage.html == ''
      @pageNew()
    else
      @pageShow()


class UserPageEditor extends React.Component
  constructor: (props) ->
    super props
    @state = raw: @props.userPage.raw


  componentDidMount: =>
    body = @_body()
    $(body).on 'change', @_change
    body.selectionStart = @props.userPage.selection[0]
    body.selectionEnd = @props.userPage.selection[1]
    @_focus()


  componentWillUnmount: =>
    body = @_body()
    $(body).off 'change', @_change

    $(document).trigger 'profile.user-page.update',
      raw: @state.raw
      selection: [body.selectionStart, body.selectionEnd]


  _body: => React.findDOMNode(@refs.body)


  _focus: => @_body().focus()


  _reset: (_e, callback) =>
    if typeof callback != 'function'
      callback = @_focus

    @setState raw: @props.userPage.initialRaw, callback


  _cancel: =>
    @_reset null, ->
      $(document).trigger 'profile.user-page.update', editing: false


  _save: (e) =>
    body = @state.raw
    osu.showLoadingOverlay()

    $.ajax window.changePageUrl,
      method: 'PUT'
      dataType: 'json'
      data: body: body
    .done (data) ->
      $(document).trigger 'profile.user-page.update',
        html: data.html
        editing: false
        raw: body
        initialRaw: body
    .always osu.hideLoadingOverlay


  _change: (e) => @setState(raw: e.target.value)


  render: =>
    el 'form', className: 'profile-content flex-col-66 profile-page-editor flex-column',
      el 'textarea',
        className: 'flex-full profile-page-editor-body'
        name: 'body'
        value: @state.raw
        onChange: @_change
        placeholder: Lang.get('users.show.page.placeholder')
        ref: 'body'

      el 'div', className: 'post-editor__footer post-editor__footer--profile-page',
        el 'div', dangerouslySetInnerHTML:
          __html: osu.parseJson('json-post-editor-toolbar').html

        el 'div', className: 'post-editor__actions',
          el 'button',
            className: 'btn-osu btn-osu--small btn-osu-default post-editor__action'
            type: 'button'
            onClick: @_cancel
            Lang.get('common.buttons.cancel')

          el 'button',
            className: 'btn-osu btn-osu--small btn-osu-default post-editor__action'
            type: 'button'
            onClick: @_reset
            Lang.get('common.buttons.reset')

          el 'button',
            className: 'btn-osu btn-osu--small btn-osu-default post-editor__action'
            type: 'button'
            onClick: @_save
            Lang.get('common.buttons.save')


class @ProfileContents extends React.Component
  componentDidMount: =>
    @componentWillReceiveProps()


  componentWillReceiveProps: ->
    reinit = ->
      $(document).trigger 'osu:page:change'
    setTimeout reinit, 0


  render: =>
    tabs = [
      ['osu', 'osu!']
      ['taiko', 'osu!taiko']
      ['ctb', 'osu!ctb']
      ['mania', 'osu!mania']
    ]

    if @props.userPage.html != '' || @props.withEdit
      tabs.unshift ['me', 'me!']

    mainClass = 'row-page row-page--profile flex-column'
    if @props.mode == 'me'
      mainClass += ' flex-full'

    el 'div', className: mainClass,
      el 'div', className: 'profile-tabs',
        tabs.map (t) =>
          el Tab,
            key: t[0]
            currentMode: @props.mode
            modeChange: @props.modeChange
            mode: t[0]
            text: t[1]
      el 'div', className: 'profile-contents flex-full flex-row',
        el Info, user: @props.user
        if @props.mode == 'me'
          el UserPage,
            withEdit: @props.withEdit
            userPage: @props.userPage
            user: @props.user
        else
          [
            el Stats,
              key: 'stats'
              stats: @props.stats
            el RecentAchievements,
              key: 'recent-achievements'
              achievementsCounts: @props.achievementsCounts
              recentAchievements: @props.recentAchievements
          ]
