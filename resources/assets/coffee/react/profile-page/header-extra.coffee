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

{a, div, span} = React.DOM
el = React.createElement

bn = 'profile-header-extra'

rowValue = (value) ->
  "<strong>#{value}</strong>"

class ProfilePage.HeaderExtra extends React.Component
  constructor: (props) ->
    super props

    @state = {}


  componentWillMount: =>
    @id = "profile-page-header-extra-#{osu.generateId()}"


  componentDidMount: =>
    @rankChartUpdate()


  componentDidUpdate: =>
    @rankChartUpdate()


  componentWillUnmount: =>
    $(window).off ".#{@id}"
    $.unsubscribe ".#{@id}"


  render: =>
    originKeys = []
    originKeys.push 'country' if @props.user.country.name?
    originKeys.push 'age' if @props.user.age?

    playsWith =
      (@props.user.playstyle || []).map (s) ->
        osu.trans "common.device.#{s}"
      .join ', '

    div
      className:
        """
          osu-page osu-page--small osu-page--users-show-header-extra
          js-switchable-mode-page--scrollspy js-switchable-mode-page--page
        """
      'data-page-id': 'main'
      div className: bn,
        div className: "#{bn}__column #{bn}__column--text",
          if originKeys.length != 0 || @props.user.title?
            div className: "#{bn}__rows",
              if originKeys.length != 0
                div
                  className: "#{bn}__row",
                  dangerouslySetInnerHTML:
                    __html:
                      osu.trans "users.show.origin_#{originKeys.join('_')}",
                        country: rowValue @props.user.country.name
                        age: rowValue osu.trans('users.show.age', age: @props.user.age)

          div className: "#{bn}__rows",
            div
              className: "#{bn}__row"
              dangerouslySetInnerHTML:
                __html: @props.user.joinDate
            div
              className: "#{bn}__row"
              dangerouslySetInnerHTML:
                __html:
                  osu.trans 'users.show.lastvisit',
                    date: rowValue osu.timeago(@props.user.lastvisit)

          if @props.user.playstyle?
            div className: "#{bn}__rows",
              div
                className: "#{bn}__row"
                dangerouslySetInnerHTML:
                  __html:
                    osu.trans 'users.show.plays_with',
                      devices: rowValue playsWith

        div className: "#{bn}__column #{bn}__column--text",
          div className: "#{bn}__rows",
            @fancyLink
              key: 'location'
              icon: 'map-marker'
              title:
                osu.trans 'users.show.current_location',
                  location: @props.user.location

            @fancyLink
              key: 'interests'
              icon: 'heart-o'

            @fancyLink
              key: 'occupation'
              icon: 'suitcase'

          div className: "#{bn}__rows",
            @fancyLink
              key: 'twitter'
              url: "https://twitter.com/#{@props.user.twitter}"
              text:
                span null,
                  span
                    style: fontStyle: 'normal'
                    '@'
                  @props.user.twitter

            @fancyLink
              key: 'website'
              icon: 'globe'
              url: @props.user.website

            @fancyLink
              key: 'skype'
              url: "skype:#{@props.user.skype}?chat"

            @fancyLink
              key: 'lastfm'
              url: "https://last.fm/user/#{@props.user.lastfm}"

        div
          className: "#{bn}__column #{bn}__column--chart"
          div className: "#{bn}__rank-box",
            div null,
              div className: "#{bn}__rank-global",
                if @state.hoverLine1?
                  @state.hoverLine1
                else if @props.stats.rank.is_ranked
                  "##{Math.round(@props.stats.rank.global).toLocaleString()}"
                else
                  '\u00A0'
              div className: "#{bn}__rank-country",
                if @state.hoverLine2?
                  @state.hoverLine2
                else if @props.stats.rank.is_ranked
                  "#{@props.user.country.name} ##{Math.round(@props.stats.rank.country).toLocaleString()}"
                else
                  '\u00A0'

          div
            className: "#{bn}__rank-chart"
            ref: (el) => @rankChartArea = el
          div className: "#{bn}__rank-box",
            "#{Math.round(@props.stats.pp).toLocaleString()}pp"

  fancyLink: ({key, url, icon, text, title}) =>
    return if !@props.user[key]?

    component = if url? then a else span

    component
      href: url
      className: "#{bn}__row #{bn}__row--fancy-link"
      title: title
      el Icon,
        name: icon ? key
        modifiers: ['fw']
        parentClass: "#{bn}__fancy-link-icon"
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
        hoverId: "rank-chart-#{osu.generateId()}"

      @rankChart = new FancyChart(@rankChartArea, options)
      @rankChart.margins =
        top: 5
        right: 15
        bottom: 5
        left: 5

      $(window).on "throttled-resize.#{@id}", @rankChart.resize
      $.subscribe "fancy-chart:hover-#{options.hoverId}:refresh.#{@id}", @rankChartHover
      $.subscribe "fancy-chart:hover-#{options.hoverId}:end.#{@id}", @rankChartHover

    data = (@props.rankHistories?.data ? [])
    data = data.map (rank, i) ->
      x: i - data.length + 1
      y: -rank
    .filter (point) -> point.y < 0

    if data.length == 1
      data.unshift
        x: data[0].x - 1
        y: data[0].y

    @rankChart.loadData data
