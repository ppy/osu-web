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

{a, div, h2, h3, img, p, small, span} = ReactDOMFactories
el = React.createElement

class ProfilePage.Historical extends React.PureComponent
  constructor: (props) ->
    super props

    @id = "users-show-historical-#{osu.uuid()}"
    @charts = {}


  componentDidMount: =>
    $(window).on "throttled-resize.#{@id}", @resizeCharts
    @monthlyPlaycountsChartUpdate()
    @replaysWatchedCountsChartUpdate()


  componentDidUpdate: =>
    @monthlyPlaycountsChartUpdate()
    @replaysWatchedCountsChartUpdate()


  componentWillUnmount: =>
    $(window).off ".#{@id}"


  render: =>
    div
      className: 'page-extra'

      el ProfilePage.ExtraHeader, name: @props.name, withEdit: @props.withEdit

      if @hasMonthlyPlaycounts()
        div null,
          h3
            className: 'page-extra__title page-extra__title--small'
            osu.trans('users.show.extra.historical.monthly_playcounts.title')

          div
            className: 'page-extra__chart'
            ref: @setMonthlyPlaycountsChartArea


      h3
        className: 'page-extra__title page-extra__title--small'
        osu.trans('users.show.extra.historical.most_played.title')

      if @props.beatmapPlaycounts?.length
        [
          @props.beatmapPlaycounts.map (pc, i) =>
            @_beatmapRow pc.beatmap, pc.beatmapset, i, [
              [
                span
                  key: 'name'
                  className: 'beatmapset-row__info'
                  osu.trans('users.show.extra.historical.most_played.count')
                span
                  key: 'value'
                  className: 'beatmapset-row__info beatmapset-row__info--large'
                  " #{pc.count.toLocaleString()}"
              ]
            ]
          span
            key: 'show-more-row'
            className: 'beatmapset-row beatmapset-row--more'
            el ShowMoreLink,
              event: 'profile:showMore'
              hasMore: @props.pagination.beatmapPlaycounts.hasMore
              loading: @props.pagination.beatmapPlaycounts.loading
              data:
                name: 'beatmapPlaycounts'
                url: laroute.route 'users.beatmapsets',
                    user: @props.user.id
                    type: 'most_played'
        ]

      else
        p null, osu.trans('users.show.extra.historical.empty')

      h3
        className: 'page-extra__title page-extra__title--small'
        osu.trans('users.show.extra.historical.recent_plays.title')

      if @props.scoresRecent?.length
        [
          el window._exported.PlayDetailList, key: 'play-detail-list', scores: @props.scoresRecent

          span
            key: 'show-more-row'
            className: 'beatmapset-row beatmapset-row--more'
            el ShowMoreLink,
              event: 'profile:showMore'
              hasMore: @props.pagination.scoresRecent.hasMore
              loading: @props.pagination.scoresRecent.loading
              data:
                name: 'scoresRecent'
                url: laroute.route 'users.scores',
                    user: @props.user.id
                    type: 'recent'
                    mode: @props.currentMode
        ]

      else
        p null, osu.trans('users.show.extra.historical.empty')

      if @hasReplaysWatchedCounts()
        div null,
          h3
            className: 'page-extra__title page-extra__title--small'
            osu.trans('users.show.extra.historical.replays_watched_counts.title')

          div
            className: 'page-extra__chart'
            ref: @setReplaysWatchedCountsChartArea


  _beatmapRow: (bm, bmset, key, details = []) =>
    div
      key: key
      className: 'beatmapset-row'
      div
        className: 'beatmapset-row__cover'
        style:
          backgroundImage: osu.urlPresence(bmset.covers.list)
      div
        className: 'beatmapset-row__detail'
        div
          className: 'beatmapset-row__detail-row'
          div
            className: 'beatmapset-row__detail-column beatmapset-row__detail-column--full'
            a
              className: 'beatmapset-row__title'
              href: laroute.route 'beatmaps.show', beatmap: bm.id
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
                __html: osu.trans 'beatmapsets.show.details.mapped_by',
                  mapper: laroute.link_to_route 'users.show',
                    bmset.creator
                    { user: bmset.user_id }
                    class: 'beatmapset-row__title-small js-usercard'
                    'data-user-id': bmset.user_id
          div
            className: 'beatmapset-row__detail-column'
            details[1]


  chartUpdate: (attribute, area) =>
    dataPadder = (padded, entry) ->
      if padded.length > 0
        lastEntry = _.last(padded)
        missingMonths = entry.x.diff(lastEntry.x, 'months') - 1

        _.times missingMonths, (i) ->
          padded.push
            x: lastEntry.x.clone().add(i + 1, 'months')
            y: 0

      padded.push entry
      padded

    data = _(@props.user[attribute])
      .sortBy 'start_date'
      .map (count) ->
        x: moment(count.start_date)
        y: count.count
      .reduce dataPadder, []

    if data.length == 1
      data.unshift
        x: data[0].x.clone().subtract(1, 'month')
        y: 0

    if !@charts[attribute]?
      options =
        curve: d3.curveLinear
        formats:
          x: (d) -> moment(d).format(osu.trans('common.datetime.year_month_short.moment'))
          y: (d) -> d.toLocaleString()
        margins: right: 80 # more spacing for x axis label
        tooltipFormats:
          x: (d) -> moment(d).format(osu.trans('common.datetime.year_month.moment'))
        tickValues: {}
        ticks: {}

      @charts[attribute] = new LineChart(area, options)

    @updateTicks @charts[attribute], data
    @charts[attribute].loadData data


  hasMonthlyPlaycounts: =>
    @props.user.monthly_playcounts.length > 0


  hasReplaysWatchedCounts: =>
    @props.user.replays_watched_counts.length > 0


  monthlyPlaycountsChartUpdate: =>
    return if !@hasMonthlyPlaycounts()

    @chartUpdate 'monthly_playcounts', @monthlyPlaycountsChartArea


  replaysWatchedCountsChartUpdate: =>
    return if !@hasReplaysWatchedCounts()

    @chartUpdate 'replays_watched_counts', @replaysWatchedCountsChartArea


  updateTicks: (chart, data) =>
    if osu.isDesktop()
      chart.options.ticks.x = null

      data ?= chart.data
      chart.options.tickValues.x =
        if data.length < 10
          data.map (d) -> d.x
        else
          null
    else
      chart.options.ticks.x = Math.min(6, (data ? chart.data).length)
      chart.options.tickValues.x = null


  resizeCharts: =>
    for own _name, chart of @charts
      @updateTicks chart
      chart.resize()


  setMonthlyPlaycountsChartArea: (ref) =>
    @monthlyPlaycountsChartArea = ref


  setReplaysWatchedCountsChartArea: (ref) =>
    @replaysWatchedCountsChartArea = ref
