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

{a, button, div, dd, dl, dt, h1, i, img, li, span, ul} = ReactDOMFactories
el = React.createElement

class Detail extends React.PureComponent
  constructor: (props) ->
    super props

    @rankChartEventId = "rank-chart-profile-detail-#{osu.uuid()}"
    @state = extended: true


  render: =>
    div className: 'profile-detail',
      div className: 'profile-detail__bar',
        el DetailBar,
          stats: @props.stats
          toggleExtend: @toggleExtend
          extended: @state.extended
      div
        className: if @state.extended then '' else 'hidden'
        div className: 'profile-detail__row profile-detail__row--top',
          div className: 'profile-detail__col profile-detail__col--top-left',
            div className: 'profile-detail__top-left-item',
              el PlayTime, stats: @props.stats
            div className: 'profile-detail__top-left-item',
              el MedalsCount, userAchievements: @props.userAchievements
            div className: 'profile-detail__top-left-item',
              el Pp, stats: @props.stats

          div className: 'profile-detail__col',
            el RankCount, stats: @props.stats
        div className: 'profile-detail__row',
          div className: 'profile-detail__col profile-detail__col--bottom-left',
            el ProfilePage.RankChart,
              eventId: @rankChartEventId
              rankHistory: @props.rankHistory
              stats: @props.stats

          div className: 'profile-detail__col profile-detail__col--bottom-right',
            div className: 'profile-detail__bottom-right-item',
              div className: 'value-display value-display--large',
                div className: 'value-display__label',
                  osu.trans('users.show.rank.global_simple')
                div className: 'value-display__value',
                  if @props.stats.rank.global?
                    @props.stats.rank.global.toLocaleString()
                  else
                    '-'

            div className: 'profile-detail__bottom-right-item',
              div className: 'value-display',
                div className: 'value-display__label',
                  osu.trans('users.show.rank.country_simple')
                div className: 'value-display__value',
                  if @props.stats.rank.country?
                    @props.stats.rank.country.toLocaleString()
                  else
                    '-'


  toggleExtend: =>
    @setState extended: !@state.extended


class DetailBar extends React.PureComponent
  bn = 'profile-detail-bar'


  render: =>
    div className: bn,
      div className: "#{bn}__page-toggle",
        button
          className: 'profile-page-toggle'
          onClick: @props.toggleExtend
          if @props.extended
            span className: 'fas fa-chevron-up'
          else
            span className: 'fas fa-chevron-down'

      div className: "#{bn}__column #{bn}__column--left"
      div className: "#{bn}__column #{bn}__column--right",
        if @props.extended
          div className: "#{bn}__entry #{bn}__entry--level-progress",
            div className: 'bar bar--user-profile',
              div
                className: 'bar__fill'
                style:
                  width: "#{@props.stats.level.progress}%"
              div className: "bar__text",
                "#{@props.stats.level.progress}%"

        if !@props.extended
          div className: "#{bn}__entry #{bn}__entry--ranking",
            div className: 'value-display',
              div className: 'value-display__label',
                osu.trans('users.show.rank.global_simple')
              div className: 'value-display__value',
                if @props.stats.rank.global?
                  @props.stats.rank.global.toLocaleString()
                else
                  '-'

        if !@props.extended
          div className: "#{bn}__entry #{bn}__entry--ranking",
            div className: 'value-display',
              div className: 'value-display__label',
                osu.trans('users.show.rank.country_simple')
              div className: 'value-display__value',
                if @props.stats.rank.country?
                  @props.stats.rank.country.toLocaleString()
                else
                  '-'

        div className: "#{bn}__entry #{bn}__entry--level",
          div className: "#{bn}__level",
            @props.stats.level.current


class DetailMobile extends React.PureComponent
  render: =>
    div className: 'profile-detail-mobile',
      div className: 'profile-detail-mobile__item',
        el Rank, type: 'global', stats: @props.stats
      div className: 'profile-detail-mobile__item',
        el Rank, type: 'country', stats: @props.stats
      div className: 'profile-detail-mobile__item',
        el PlayTime, stats: @props.stats
      div className: 'profile-detail-mobile__item profile-detail-mobile__item--half',
        el MedalsCount, userAchievements: @props.userAchievements
      div className: 'profile-detail-mobile__item profile-detail-mobile__item--half',
        el Pp, stats: @props.stats


class GameModeSwitcher extends React.PureComponent
  render: =>
    return null if @props.user.is_bot

    ul className: 'game-mode hidden-xs',
      for mode in BeatmapHelper.modes
        linkClass = 'game-mode-link'
        linkClass += ' game-mode-link--active' if mode == @props.currentMode

        li
          className: 'game-mode__item'
          key: mode
          a
            className: linkClass
            href: laroute.route 'users.show',
              user: @props.user.id
              mode: mode
            osu.trans "beatmaps.mode.#{mode}"
            if @props.user.playmode == mode
              span
                className: 'game-mode-link__icon'
                title: osu.trans('users.show.edit.default_playmode.is_default_tooltip')
                ' '
                i className: 'fas fa-star'


class HeaderInfo extends React.PureComponent
  bn = 'profile-info'


  render: =>
    avatar = el UserAvatar, user: @props.user, modifiers: ['full']

    div className: bn,
      div
        className: "#{bn}__bg"
        style:
          backgroundImage: osu.urlPresence(@props.user.cover_url)

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
          span className: 'u-ellipsis-overflow', @props.user.username
          div className: "#{bn}__previous-usernames", @previousUsernames()
        # hard space if no title
        span className: "#{bn}__title", @props.user.title ? '\u00A0'
        div className: "#{bn}__icon-group",
          div className: "#{bn}__icons",
            if @props.user.is_supporter
              span className: "#{bn}__icon #{bn}__icon--supporter",
                span className: 'fas fa-heart'
          div className: "#{bn}__icons #{bn}__icons--flag",
            if @props.user.country?
              a
                className: "#{bn}__flag #{bn}__flag--country"
                href: laroute.route 'rankings',
                  mode: @props.currentMode,
                  country: @props.user.country.code,
                  type: 'performance'
                span className: "#{bn}__flag-flag",
                  el FlagCountry, country: @props.user.country, classModifiers: ['full']
                span className: "#{bn}__flag-text",
                  @props.user.country.name
      div
        className: 'profile-info__bar hidden-xs'
        style:
          backgroundColor: @props.user.profile_colour


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
        i className: 'fas fa-address-card'
      div
        className: 'profile-previous-usernames__icon profile-previous-usernames__icon--plain'
        i className: 'fas fa-address-card'
      div
        className: 'profile-previous-usernames__content'
        div
          className: 'profile-previous-usernames__title'
          osu.trans('users.show.previous_usernames')
        div
          className: 'profile-previous-usernames__names'
          previousUsernames


  doNothing: (e) -> # ┐(°～° )┌


class Links extends React.PureComponent
  bn = 'profile-links'

  rowValue = (value, attributes = {}, modifiers = []) ->
    if attributes.href?
      tagName = 'a'
      modifiers.push 'link'
    else
      tagName = 'span'

    elem = document.createElement(tagName)
    elem[k] = v for own k, v of attributes
    elem.className += " #{osu.classWithModifiers "#{bn}__value", modifiers}"
    elem.innerHTML = value

    elem.outerHTML


  linkMapping =
    twitter:
      icon: 'fab fa-twitter'
      url: (val) -> "https://twitter.com/#{val}"
      text: (val) -> "@#{val}"
    discord:
      icon: 'fab fa-discord'
      text: (val) ->
        el ClickToCopy, value: val, modifiers: ['profile-header-extra']
    interests:
      icon: 'far fa-heart'
    skype:
      icon: 'fab fa-skype'
      url: (val) -> "skype:#{val}?chat"
    lastfm:
      icon: 'fab fa-lastfm'
      url: (val) -> "https://last.fm/user/#{val}"
    location:
      icon: 'fas fa-map-marker-alt'
    occupation:
      icon: 'fas fa-suitcase'
    website:
      icon: 'fas fa-link'
      url: (val) -> val
      text: (val) -> val.replace(/^https?:\/\//, '')


  render: =>
    rows = [
      [
        @renderJoinDate()
        @renderLastVisit()
        @renderPlaystyle()
        @renderPostCount()
      ]
      [
        @renderLink 'location'
        @renderLink 'interests'
        @renderLink 'occupation'
      ]
      [
        @renderLink 'twitter'
        @renderLink 'discord'
        @renderLink 'skype'
        @renderLink 'lastfm'
        @renderLink 'website'
      ]
    ]

    div className: bn,
      for row, i in rows when _.compact(row).length > 0
        div key: i, className: "#{bn}__row #{bn}__row--#{i}", row


  renderJoinDate: =>
    joinDate = moment(@props.user.join_date)
    joinDateTitle = joinDate.format('LL')

    if joinDate.isBefore moment('2008-01-01')
      div
        className: "#{bn}__item"
        key: 'join_date'
        title: joinDateTitle
        osu.trans 'users.show.first_members'
    else
      div
        className: "#{bn}__item"
        key: 'join_date'
        dangerouslySetInnerHTML:
          __html:
            osu.trans 'users.show.joined_at',
              date: rowValue joinDate.format(osu.trans('common.datetime.year_month.moment')), title: joinDateTitle


  renderLastVisit: =>
    value = @props.user.last_visit

    return unless value?

    div
      className: "#{bn}__item"
      key: 'last_visit'
      dangerouslySetInnerHTML:
        __html:
          osu.trans 'users.show.lastvisit',
            date: rowValue osu.timeago(value)


  renderLink: (key) =>
    value = @props.user[key]

    return unless value?

    {url, icon, text, title} = linkMapping[key]

    componentClass = "u-ellipsis-overflow #{bn}__value"

    if url?
      component = a
      componentClass += " #{bn}__value--link"
      href = url(value)
    else
      component = span

    title ?= osu.trans "users.show.info.#{key}"

    div
      className: "#{bn}__item"
      key: key

      span
        className: "#{bn}__icon"
        title: title
        i className: "fa-fw #{icon}"

      component
        href: href
        className: componentClass
        text?(value) ? value

  renderPlaystyle: =>
    value = @props.user.playstyle

    return unless value?

    playsWith = (value ? []).map (s) ->
      osu.trans "common.device.#{s}"
    .join ', '

    div
      className: "#{bn}__item"
      key: 'playstyle'
      dangerouslySetInnerHTML:
        __html:
          osu.trans 'users.show.plays_with',
            devices: rowValue playsWith


  renderPostCount: =>
    count = osu.transChoice 'users.show.post_count.count', @props.user.post_count.toLocaleString()
    url = laroute.route('users.posts', user: @props.user.id)

    div
      className: "#{bn}__item"
      key: 'post_count'
      dangerouslySetInnerHTML:
        __html:
          osu.trans 'users.show.post_count._',
            link: rowValue count, href: url


class MedalsCount extends React.PureComponent
  render: =>
    div className: 'value-display value-display--medals',
      div className: 'value-display__label',
        osu.trans('users.show.stats.medals')
      div className: 'value-display__value',
        @props.userAchievements.length


class PlayTime extends React.PureComponent
  render: =>
    playTime = moment.duration @props.stats.play_time, 'seconds'

    daysLeftOver = Math.floor playTime.asDays()
    hours = playTime.hours()
    minutes = playTime.minutes()
    seconds = playTime.seconds()

    timeString = ''
    timeString = "#{daysLeftOver.toLocaleString()}d " if daysLeftOver > 0
    timeString += "#{hours}h #{minutes}m #{seconds}s"

    div className: 'value-display',
      div className: 'value-display__label',
        osu.trans('users.show.stats.play_time')
      div className: 'value-display__value',
        timeString


class Rank extends React.PureComponent
  render: =>
    div className: 'value-display',
      div className: 'value-display__label',
        osu.trans("users.show.rank.#{@props.type}_simple")
      div className: 'value-display__value',
        @props.stats.rank[@props.type]?.toLocaleString() ? '-'


class Pp extends React.PureComponent
  render: =>
    div className: 'value-display value-display--pp',
      div className: 'value-display__label',
        'pp'
      div className: 'value-display__value',
        Math.round(@props.stats.pp).toLocaleString()


class Stats extends React.PureComponent
  defaultValueFormatter = (val) -> val.toLocaleString()


  render: =>
    div className: 'profile-stats',
      @renderSimpleEntry 'ranked_score'
      @renderSimpleEntry 'hit_accuracy', (val) -> "#{val.toFixed(2)}%"
      @renderSimpleEntry 'play_count'
      @renderSimpleEntry 'total_score'
      @renderSimpleEntry 'total_hits'
      @renderSimpleEntry 'maximum_combo'
      @renderSimpleEntry 'replays_watched_by_others'


  renderSimpleEntry: (key, valueFormatter = defaultValueFormatter) =>
    dl className: 'profile-stats__entry',
      dt className: 'profile-stats__key', osu.trans("users.show.stats.#{key}")
      dd className: 'profile-stats__value', valueFormatter(@props.stats[key])


class RankCount extends React.PureComponent
  render: =>
    div className: 'profile-rank-count',
      @renderRankCountEntry 'XH'
      @renderRankCountEntry 'X'
      @renderRankCountEntry 'SH'
      @renderRankCountEntry 'S'
      @renderRankCountEntry 'A'


  renderRankCountEntry: (name) =>
    rankCount = @props.stats.scoreRanks[name]

    div
      className: 'profile-rank-count__item'
      div
        className: "score-rank-v2 score-rank-v2--#{name} score-rank-v2--profile-page"
      div null, rankCount.toLocaleString()


class ProfilePage.Header extends React.Component
  constructor: (props) ->
    super props

    @state =
      editing: false
      coverUrl: props.user.cover_url
      isCoverUpdating: false
      settingDefaultMode: false

    @debouncedCoverSet = _.debounce @coverSet, 300


  componentDidMount: =>
    $.subscribe 'user:cover:reset.profilePageHeaderMain', @coverReset
    $.subscribe 'user:cover:set.profilePageHeaderMain', @debouncedCoverSet
    $.subscribe 'user:cover:upload:state.profilePageHeaderMain', @coverUploadState

    $.subscribe 'key:esc.profilePageHeaderMain', @closeEdit
    $(document).on 'click.profilePageHeaderMain', @closeEdit


  componentWillReceiveProps: (newProps) =>
    @debouncedCoverSet null, newProps.user.cover.url


  componentWillUnmount: =>
    $.unsubscribe '.profilePageHeaderMain'
    $(document).off '.profilePageHeaderMain'

    @closeEdit()
    @debouncedCoverSet.cancel()
    @xhr?.abort()


  render: =>
    div
      className: 'js-switchable-mode-page--scrollspy js-switchable-mode-page--page'
      'data-page-id': 'main'
      div className: 'header-v3 header-v3--users',
        div
          className: 'header-v3__bg'
          style:
            backgroundImage: osu.urlPresence(@state.coverUrl)
        div className: 'header-v3__overlay'
        div className: 'osu-page osu-page--header-v3',
          @renderTitle()
          @renderTabs()
          el GameModeSwitcher, user: @props.user, currentMode: @props.currentMode
      div className: 'osu-page osu-page--users',
        div className: 'profile-header',
          div className: 'profile-header__top',
            el HeaderInfo, user: @props.user, currentMode: @props.currentMode

            el DetailMobile,
              stats: @props.stats
              userAchievements: @props.userAchievements

            if !@props.user.is_bot
              el Stats, stats: @props.stats

          if !@props.user.is_bot
            el Detail,
              stats: @props.stats
              userAchievements: @props.userAchievements
              rankHistory: @props.rankHistory

          if @props.user.badges.length > 0
            el ProfilePage.Badges, badges: @props.user.badges

          el Links, user: @props.user


  renderTabs: =>
    ul className: 'page-mode-v2 page-mode-v2--users',
      li
        className: 'page-mode-v2__item'
        a
          href: laroute.route('users.show', user: @props.user.id)
          className: 'page-mode-v2__link page-mode-v2__link--active'
          osu.trans 'users.show.header_title.info'
        a
          href: laroute.route('users.modding.index', user: @props.user.id)
          className: 'page-mode-v2__link'
          osu.trans 'users.beatmapset_activities.title_compact'


  renderTitle: =>
    div className: 'osu-page-header-v3 osu-page-header-v3--users',
      div className: 'osu-page-header-v3__title js-nav2--hidden-on-menu-access',
        div className: 'osu-page-header-v3__title-icon',
          div className: 'osu-page-header-v3__icon'
        h1
          className: 'osu-page-header-v3__title-text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'users.show.header_title._',
            info: "<span class='osu-page-header-v3__title-highlight'>#{osu.trans('users.show.header_title.info')}</span>"


  renderTournamentBanner: ({modifiers} = {}) =>
    return if !@props.user.active_tournament_banner.id?

    a
      href: laroute.route('tournaments.show', tournament: @props.user.active_tournament_banner.tournament_id)
      className: osu.classWithModifiers 'profile-header__tournament-banner', modifiers
      el Img2x,
        src: @props.user.active_tournament_banner.image
        className: 'profile-header__tournament-banner-image'


  closeEdit: (e) =>
    return unless @state.editing

    if e?
      return if e.button != 0
      return if $(e.target).closest(@coverSelector).length

    return if $('#overlay').is(':visible')
    return if document.body.classList.contains('modal-open')

    Blackout.hide()
    @setState editing: false, =>
      @coverReset()


  coverReset: =>
    @debouncedCoverSet null, @props.user.cover.url


  coverSet: (_e, url) =>
    return if @state.isCoverUpdating

    @setState coverUrl: url


  coverUploadState: (_e, state) =>
    @setState isCoverUpdating: state


  openEdit: =>
    Blackout.show()
    @setState editing: true


  toggleEdit: =>
    if @state.editing
      @closeEdit()
    else
      @openEdit()


  setDefaultMode: =>
    @setState settingDefaultMode: true

    @xhr = $.ajax laroute.route('account.update'),
      method: 'PUT'
      data:
        user:
          playmode: @props.currentMode
    .done (data) ->
      $.publish 'user:update', data
    .fail (xhr, status) ->
      return if status == 'abort'

      osu.emitAjaxError() xhr
    .always =>
      @setState settingDefaultMode: false
