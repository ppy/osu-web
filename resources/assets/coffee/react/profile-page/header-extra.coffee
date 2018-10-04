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

{a, div, i, span} = ReactDOMFactories
el = React.createElement

bn = 'profile-header-extra'

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


class ProfilePage.HeaderExtra extends React.Component
  constructor: (props) ->
    super props

    @state = {}


  componentWillMount: =>
    @id = "profile-page-header-extra-#{osu.uuid()}"


  componentDidMount: =>
    @rankChartUpdate()


  componentDidUpdate: =>
    @rankChartUpdate()


  componentWillUnmount: =>
    $(window).off ".#{@id}"
    $.unsubscribe ".#{@id}"


  render: =>
    if currentUser.id?
      friendState = _.find(currentUser.friends, (o) => o.target_id == @props.user.id)

    friendButtonHidden = !currentUser.id || currentUser.id == @props.user.id

    playsWith =
      (@props.user.playstyle || []).map (s) ->
        osu.trans "common.device.#{s}"
      .join ', '

    joinDate = moment(@props.user.join_date)
    joinDateTitle = joinDate.format('LL')
    isBlocked = _.find(currentUser.blocks, target_id: @props.user.id)

    div
      className:
        """
          osu-page osu-page--small osu-page--users-show-header-extra
          js-switchable-mode-page--scrollspy js-switchable-mode-page--page
        """
      'data-page-id': 'main'
      div className: "#{bn} #{bn}--follower-meta",
        if currentUser.id?
          el FriendButton, user_id: @props.user.id

        div className: "#{bn}__follower-count#{if friendButtonHidden then '--no-button' else ''}",
          osu.transChoice('users.show.extra.followers', @props.user.follower_count[0].toLocaleString())

        if friendState?.mutual
          div className: "#{bn}__follower-mutual-divider", "|"
        if friendState?.mutual
          div className: "#{bn}__follower-mutual", osu.trans 'friends.state.mutual'

      div className: bn,
        div className: "#{bn}__column #{bn}__column--text",
          if @props.user.country.name?
            div className: "#{bn}__rows",
              div
                className: "#{bn}__row"
                dangerouslySetInnerHTML:
                  __html:
                    osu.trans 'users.show.origin_country',
                      country: rowValue @props.user.country.name

          div className: "#{bn}__rows",
            if joinDate.isBefore moment('2008-01-01')
              div
                className: "#{bn}__row"
                title: joinDateTitle
                osu.trans 'users.show.first_members'
            else
              div
                className: "#{bn}__row"
                dangerouslySetInnerHTML:
                  __html:
                    osu.trans 'users.show.joined_at',
                      date: rowValue joinDate.format(osu.trans('common.datetime.year_month.moment')), title: joinDateTitle

            if @props.user.last_visit?
              div
                className: "#{bn}__row"
                dangerouslySetInnerHTML:
                  __html:
                    osu.trans 'users.show.lastvisit',
                      date: rowValue osu.timeago(@props.user.last_visit)

          div className: "#{bn}__rows",
            if @props.user.playstyle?
              div
                className: "#{bn}__row"
                dangerouslySetInnerHTML:
                  __html:
                    osu.trans 'users.show.plays_with',
                      devices: rowValue playsWith
            @renderPostCount()

          if !currentUser.id? || currentUser.id != @props.user.id
            div className: "#{bn}__rows #{bn}__rows--actions",
              if !isBlocked
                span null,
                  a
                    className: 'user-action-button user-action-button--message user-action-button--right-margin'
                    href: laroute.route 'messages.users.show', user: @props.user.id
                    title: osu.trans('users.card.send_message')
                    i className: 'fas fa-envelope'

                  el BlockButton, user_id: @props.user.id

              el _exported.ReportForm, user: @props.user

        div className: "#{bn}__column #{bn}__column--text #{bn}__column--shrink",
          div className: "#{bn}__rows",
            @fancyLink
              key: 'location'
              icon: 'fas fa-map-marker-alt'

            @fancyLink
              key: 'interests'
              icon: 'far fa-heart'

            @fancyLink
              key: 'occupation'
              icon: 'fas fa-suitcase'

          div className: "#{bn}__rows",
            @fancyLink
              key: 'twitter'
              icon: 'fab fa-twitter'
              url: "https://twitter.com/#{@props.user.twitter}"
              text:
                span null,
                  span
                    style: fontStyle: 'normal'
                    '@'
                  @props.user.twitter

            @fancyLink
              key: 'discord'
              icon: 'fab fa-discord'
              text: el ClickToCopy,
                value: @props.user.discord
                modifiers: ['profile-header-extra']

            @fancyLink
              key: 'skype'
              icon: 'fab fa-skype'
              url: "skype:#{@props.user.skype}?chat"

            @fancyLink
              key: 'lastfm'
              icon: 'fab fa-lastfm'
              url: "https://last.fm/user/#{@props.user.lastfm}"

            @fancyLink
              key: 'website'
              icon: 'fas fa-link'
              url: @props.user.website
              text: @props.user.website?.replace(/^https?:\/\//, '')

        div
          className: "#{bn}__column #{bn}__column--chart #{'invisible' if @props.user.is_bot}"
          div className: "#{bn}__rank-box",
            div null,
              div className: "#{bn}__rank-global",
                if @state.hoverLine1?
                  @state.hoverLine1
                else if @props.stats.rank.global?
                  "##{Math.round(@props.stats.rank.global).toLocaleString()}"
                else
                  '\u00A0'
              div className: "#{bn}__rank-country",
                if @state.hoverLine2?
                  @state.hoverLine2
                else if @props.stats.rank.country?
                  "#{@props.user.country.name} ##{Math.round(@props.stats.rank.country).toLocaleString()}"
                else
                  '\u00A0'

          div
            className: "#{bn}__rank-chart"
            ref: (el) => @rankChartArea = el
          div className: "#{bn}__rank-box",
            if @props.stats.is_ranked
              "#{Math.round(@props.stats.pp).toLocaleString()}pp"
            else
              osu.trans('users.show.extra.unranked')

  renderPostCount: =>
    count = osu.transChoice 'users.show.post_count.count', @props.user.post_count.toLocaleString()
    url = laroute.route('users.posts', user: @props.user.id)

    div
      className: "#{bn}__row"
      dangerouslySetInnerHTML:
        __html:
          osu.trans 'users.show.post_count._',
            link: rowValue count, href: url


  fancyLink: ({key, url, icon, text, title}) =>
    return if !@props.user[key]?

    componentClass = "u-ellipsis-overflow #{bn}__value #{bn}__value--fancy-link"

    if url?
      component = a
      componentClass += " #{bn}__value--link"
    else
      component = span

    title ?= osu.trans "users.show.info.#{key}"

    div
      className: "#{bn}__row #{bn}__row--fancy-link"

      span
        className: "#{bn}__fancy-link-icon"
        title: title
        i className: "fa-fw #{icon}"

      component
        href: url
        className: componentClass
        text ? @props.user[key]


  rankChartHover: (_e, {data} = {}) =>
    if data?
      hoverLine1 = "##{(-data.y).toLocaleString()}"
      hoverLine2 =
        if data.x == 0
          osu.trans('common.time.now')
        else
          osu.transChoice('common.time.days_ago', -data.x)
    else
      hoverLine1 = hoverLine2 = null

    @setState {hoverLine1, hoverLine2}


  rankChartUpdate: =>
    if !@rankChart?
      options =
        scales:
          y: d3.scaleLog()
        hoverId: "rank-chart-#{osu.uuid()}"

      @rankChart = new FancyChart(@rankChartArea, options)
      @rankChart.margins =
        top: 5
        right: 15
        bottom: 5
        left: 5

      $(window).on "throttled-resize.#{@id}", @rankChart.resize
      $.subscribe "fancy-chart:hover-#{options.hoverId}:refresh.#{@id}", @rankChartHover
      $.subscribe "fancy-chart:hover-#{options.hoverId}:end.#{@id}", @rankChartHover

    data = @props.rankHistory?.data if @props.stats.is_ranked

    data = (data ? []).map (rank, i) ->
      x: i - data.length + 1
      y: -rank
    .filter (point) -> point.y < 0

    if data.length == 1
      data.unshift
        x: data[0].x - 1
        y: data[0].y

    @rankChart.loadData data
