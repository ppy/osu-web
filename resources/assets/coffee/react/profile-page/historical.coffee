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


  _rankHistory: ->
    margins =
      top: 20
      right: 20
      bottom: 20
      left: 100

    measure = (area) =>
      chartAreaDims = @refs.chartArea.getBoundingClientRect()

      width: chartAreaDims.width - (margins.left + margins.right)
      height: chartAreaDims.height - (margins.top + margins.bottom)

    dimensions = measure()

    width = dimensions.width
    height = dimensions.height

    rawData = @props.rankHistories.data.filter (rank) -> rank > 0

    startDate = moment().subtract(rawData.length, 'days')

    chartData = rawData.map (rank) ->
      date: startDate.add(1, 'day').clone().toDate()
      # rank must be drawn inverted.
      rank: -rank

    x = d3.time.scale()
      .range [0, width]
      .domain d3.extent(chartData, (d) => d.date)

    y = d3.scale.linear()
      .range [height, 0]
      .domain d3.extent(chartData, (d) => d.rank)

    xAxis = d3.svg.axis()
      .scale x
      .ticks 15
      .innerTickSize -height
      .outerTickSize 0
      .tickPadding 5
      .tickFormat (d) =>
        d3.time.format('%b-%-d') d
      .orient 'bottom'

    yAxis = d3.svg.axis()
      .scale y
      .ticks 4
      .tickFormat (d) =>
        (-d).toLocaleString()
      .innerTickSize -width
      .orient 'left'

    line = d3.svg.line()
      .x (d) => x d.date
      .y (d) => y d.rank
      .interpolate 'monotone'

    topSvg = d3.select(@refs.chartArea).append 'svg'
      .attr 'width', width + (margins.left + margins.right)
      .attr 'height', height + (margins.top + margins.bottom)

    xAxisLine = topSvg.append 'defs'
      .append 'linearGradient'
      .attr 'id', 'xAxisLineGradient'
      .attr 'gradientUnits', 'userSpaceOnUse'
      .attr 'x1', '0'
      .attr 'x2', '0'
      .attr 'y1', '-100%'
      .attr 'y2', '0'

    xAxisLine.append 'stop'
      .attr 'offset', '20%'
      .attr 'stop-color', '#fff'

    xAxisLine.append 'stop'
      .attr 'offset', '100%'
      .attr 'stop-color', '#ccc'

    svg = topSvg.append 'g'
      .attr 'transform', "translate(#{margins.left}, #{margins.top})"

    svg.append 'g'
      .attr 'class', 'chart__axis chart__axis--x'
      .attr 'transform', "translate(0, #{height})"
      .call xAxis

    svg.append 'g'
      .attr 'class', 'chart__axis chart__axis--y'
      .call yAxis

    path = svg.append 'path'
      .datum chartData
      .attr 'class', 'chart__line'
      .attr 'd', line


  render: ->
    div
      className: 'profile-extra'
      div className: 'profile-extra__anchor js-profile-page-extra--scrollspy', id: 'historical'

      h2 className: 'profile-extra__title', Lang.get('users.show.extra.historical.title')

      if @props.rankHistories
        [
          h3
            key: 'title'
            className: 'profile-extra__title profile-extra__title--small'
            Lang.get('users.show.extra.historical.rank_history.title')
          div
            key: 'area'
            ref: 'chartArea'
            className: 'chart'
        ]

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
