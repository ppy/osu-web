###
# Copyright 2015-2016 ppy Pty. Ltd.
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
{div, span} = React.DOM
el = React.createElement

class BeatmapsetPage.Stats extends React.Component
  componentDidMount: ->
    @_renderChart()

  componentDidUpdate: ->
    @_renderChart()

  _renderChart: ->
    data = [
      {values: @props.beatmapset.ratings.data[1..]}
    ]

    unless @_ratingChart
      options =
        scales:
          x: d3.scale.linear()
          y: d3.scale.linear()
        className: 'beatmapset-rating-chart'

      @_ratingChart = new StackedBarChart @refs.chartArea, options

    @_ratingChart.loadData data

  render: ->
    ratingsPositive = 0
    ratingsNegative = 0

    for rating, count of @props.beatmapset.ratings.data
      ratingsNegative += count if rating >= 1 && rating <= 5
      ratingsPositive += count if rating >= 6 && rating <= 10

    ratingsAll = ratingsPositive + ratingsNegative

    div className: 'beatmapset-header__stats beatmapset-stats',
      div className: 'beatmapset-stats__row beatmapset-stats__row--basic',
        for stat in ['total_length', 'bpm', 'count_circles', 'count_sliders']
          value = if stat == 'bpm' then @props.beatmapset.bpm else @props.beatmap[stat]

          if stat == 'total_length'
            value = moment(0).seconds(value).format 'm:ss'

          div
            className: 'beatmapset-stats__basic'
            key: stat
            title: osu.trans "beatmaps.beatmapset.show.stats.#{stat}"
            div
              className: 'beatmapset-stats__icon'
              style:
                backgroundImage: "url(/images/layout/beatmapset-page/#{stat}.svg)"
            span className: 'beatmapset-stats__text beatmapset-stats__text--value-basic', value.toLocaleString()

      div className: 'beatmapset-stats__row beatmapset-stats__row--advanced',
        for stat in ['cs', 'drain', 'accuracy', 'ar', 'stars']
          value = if stat == 'stars'
            @props.beatmap.difficulty_rating.toFixed 2
          else
            @props.beatmap[stat]

          div className: 'beatmapset-stats__advanced', key: stat,
            span className: 'beatmapset-stats__text beatmapset-stats__text--label', osu.trans "beatmaps.beatmapset.show.stats.#{stat}"
            div className: 'beatmapset-stats__bar-advanced',
              div
                className: "beatmapset-stats__bar-advanced beatmapset-stats__bar-advanced--fill beatmapset-stats__bar-advanced--#{stat}"
                style:
                  width: "#{value * 10}%"
            span className: 'beatmapset-stats__text beatmapset-stats__text--value-advanced', value.toLocaleString()

      div className: 'beatmapset-stats__row beatmapset-stats__row--advanced',
        div className: 'beatmapset-stats__text beatmapset-stats__text--rating', osu.trans 'beatmaps.beatmapset.show.stats.user-rating'
        div className: 'beatmapset-stats__bar-rating',
          div
            className: 'beatmapset-stats__bar-rating beatmapset-stats__bar-rating--fill'
            style:
              width: "#{(ratingsNegative / ratingsAll) * 100}%"

        div className: 'beatmapset-stats__rating-values',
          span className: 'beatmapset-stats__rating-value beatmapset-stats__rating-value--negative', ratingsNegative.toLocaleString()
          span className: 'beatmapset-stats__rating-value beatmapset-stats__rating-value--positive', ratingsPositive.toLocaleString()

        div className: 'beatmapset-stats__text beatmapset-stats__text--rating', osu.trans 'beatmaps.beatmapset.show.stats.rating-spread'

        div
          className: 'beatmapset-stats__rating-chart beatmapset-rating-chart'
          ref: 'chartArea'
