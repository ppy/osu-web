###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License version 3
# as published by the Free Software Foundation.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
{a, div, h2, h3, img, p, small, span} = React.DOM
el = React.createElement

ProfilePage.Historical = React.createClass
  mixins: [React.addons.PureRenderMixin]

  getInitialState: ->
    showingPlaycounts: 5
    showingRecent: 5


  componentDidMount: ->
    @_rankHistory()


  componentDidUpdate: ->
    @_rankHistory()


  componentWillUnmount: ->
    $(window).off '.profilePageHistorical'


  _showMore: (key, e) ->
    e.preventDefault() if e

    @setState "#{key}": (@state[key] + 5)


  _beatmapRow: (bm, bmset, key, shown, details = []) ->
    topClasses = 'beatmapset-row'
    topClasses += ' hidden' unless shown

    div
      key: key
      className: topClasses
      div
        className: 'beatmapset-row__cover'
        style:
          backgroundImage: "url('#{bmset.coverUrl}')"
      div
        className: 'beatmapset-row__detail'
        div
          className: 'beatmapset-row__detail-row'
          div
            className: 'beatmapset-row__detail-column beatmapset-row__detail-column--full'
            a
              className: 'beatmapset-row__title'
              href: "/s/#{bmset.beatmapset_id}"
              title: "#{bmset.artist} - #{bmset.title} [#{bm.version}] "
              "#{bmset.title} [#{bm.version}] "
              span
                className: 'beatmapset-row__title-small'
                bmset.artist
          div
            className: 'beatmapset-row__detail-column'
            details[0]
        div
          className: 'beatmapset-row__detail-row'
          div
            className: 'beatmapset-row__detail-column beatmapset-row__detail-column--full'
            span dangerouslySetInnerHTML:
                __html: Lang.get 'beatmaps.listing.mapped-by',
                  mapper: osu.link("/u/#{bmset.user_id}", bmset.creator,
                    classNames: ['beatmapset-row__title-small'])
          div
            className: 'beatmapset-row__detail-column'
            details[1]


  _yAxisTickValues: (data) ->
    rankRange = d3.extent data, (d) => d.y

    @_allTicks ||= [-1, -2.5, -5]

    while _.last(@_allTicks) >= rankRange[0]
      @_allTicks.push (10 * @_allTicks[@_allTicks.length - 3])

    ticks = [@_allTicks[0]]

    for tick in @_allTicks
      tick = Math.trunc(tick)
      if tick > rankRange[1]
        ticks[0] = tick
      else
        ticks.push tick
        break if tick < rankRange[0]

    ticks


  _rankHistory: ->
    return unless @props.rankHistories

    data = @props.rankHistories.data
      .filter (rank) => rank > 0

    startDate = moment().startOf('day').subtract(data.length, 'days')

    data = data.map (rank) =>
        x: startDate.add(1, 'day').clone().toDate()
        # rank must be drawn inverted.
        y: -rank

    yAxisTickValues = @_yAxisTickValues data

    unless @_rankHistoryChart
      formats =
        x: d3.time.format '%b-%-d'
        y: (d) => "##{(-d).toLocaleString()}"

      scales =
        y: d3.scale.log()

      options =
        formats: formats
        scales: scales

      @_rankHistoryChart = new LineChart(@refs.chartArea, options)
      $(window).on 'throttled-resize.profilePageHistorical', @_rankHistoryChart.resize

    @_rankHistoryChart.options.domains = y: d3.extent(yAxisTickValues)
    @_rankHistoryChart.options.tickValues = y: yAxisTickValues
    @_rankHistoryChart.loadData(data)


  render: ->
    div
      className: 'profile-extra'

      el ProfilePage.DragDropToggle
      h2 className: 'profile-extra__title', Lang.get('users.show.extra.historical.title')

      div
        className: 'hidden' unless @props.rankHistories
        h3
          className: 'profile-extra__title profile-extra__title--small'
          Lang.get('users.show.extra.historical.rank_history.title')
        div
          ref: 'chartArea'
          className: 'chart'

      h3
        className: 'profile-extra__title profile-extra__title--small'
        Lang.get('users.show.extra.historical.most_played.title')

      if @props.beatmapPlaycounts.length
        [
          @props.beatmapPlaycounts.map (pc, i) =>
            @_beatmapRow pc.beatmap.data, pc.beatmapSet.data, i, i < @state.showingPlaycounts, [
              [
                span
                  key: 'name'
                  className: 'beatmapset-row__info'
                  Lang.get('users.show.extra.historical.most_played.count')
                span
                  key: 'value'
                  className: 'beatmapset-row__info beatmapset-row__info--large'
                  " #{pc.count.toLocaleString()}"
              ]
            ]

          if @props.beatmapPlaycounts.length > @state.showingPlaycounts
            a
              key: 'more'
              href: '#'
              className: 'beatmapset-row beatmapset-row--more'
              onClick: @_showMore.bind(@, 'showingPlaycounts')
              Lang.get('common.buttons.show_more')
        ]

      else
        p null, Lang.get('users.show.extra.historical.empty')

      h3
        className: 'profile-extra__title profile-extra__title--small'
        Lang.get('users.show.extra.historical.recent_plays.title')

      if @props.scores.length
        [
          @props.scores.map (score, i) =>
            el PlayDetail, key: i, score: score, shown: i < @state.showingRecent

          if @props.scores.length > @state.showingRecent
            a
              key: 'more'
              href: '#'
              className: 'beatmapset-row beatmapset-row--more'
              onClick: @_showMore.bind(@, 'showingRecent')
              Lang.get('common.buttons.show_more')
        ]

      else
        p null, Lang.get('users.show.extra.historical.empty')
