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
{div, a} = React.DOM
el = React.createElement

class BeatmapsetPage.Info extends React.Component
  componentDidMount: ->
    @renderChart()

  componentDidUpdate: ->
    @renderChart()

  renderChart: ->
    failtimes = _.keyBy @props.beatmap.failtimes.data, 'type'

    data = [
      {type: 'fail', values: failtimes.fail.data},
      {type: 'retry', values: failtimes.exit.data}
    ]

    unless @_failurePointsChart
      options =
        scales:
          x: d3.scale.linear()
          y: d3.scale.linear()
        className: 'beatmapset-success-rate'

      @_failurePointsChart = new StackedBarChart @refs.chartArea, options

    @_failurePointsChart.loadData data

  render: ->
    percentage = (_.round @props.beatmap.passcount / (@props.beatmap.playcount + @props.beatmap.passcount), 2) * 100

    div className: 'osu-layout__row osu-layout__row--page-beatmapset beatmapset-info',
      div className: 'beatmapset-info__details',
        div className: 'beatmapset-info__description',
          div className: 'beatmapset-info__text beatmapset-info__text--header', osu.trans 'beatmaps.beatmapset.show.info.description'
          div
            className: 'beatmapset-info__text'
            dangerouslySetInnerHTML:
              __html: @props.beatmapset.description.data.description

        div {},
          div className: 'beatmapset-info__text-box beatmapset-info__text-box--source',
            div className: 'beatmapset-info__text beatmapset-info__text--header', osu.trans 'beatmaps.beatmapset.show.info.source'
            div
              className: 'beatmapset-info__text beatmapset-info__text--source'
              title: @props.beatmapset.source
              @props.beatmapset.source

          div className: 'beatmapset-info__text-box beatmapset-info__text-box--tags',
            div className: 'beatmapset-info__text beatmapset-info__text--header', osu.trans 'beatmaps.beatmapset.show.info.tags'
            div
              className: 'beatmapset-info__text'
              @props.beatmapset.tags.split(' ').map (tag) =>
                return if tag.length == 0

                a
                  key: tag
                  className: 'beatmapset-info__text beatmapset-info__text--tag'
                  href: laroute.route 'beatmapsets.index', q: tag
                  tag

      div className: 'beatmapset-info__success-rate beatmapset-success-rate',
        div className: 'beatmapset-success-rate__label beatmapset-success-rate__label--main', osu.trans 'beatmaps.beatmapset.show.info.success-rate'

        div className: 'beatmapset-success-rate__bar',
          div
            className: 'beatmapset-success-rate__bar beatmapset-success-rate__bar--fill'
            style:
              width: "#{percentage}%"

        div
          className: 'beatmapset-success-rate__percentage'
          style:
            paddingLeft: "#{percentage}%"
          div className: 'beatmapset-success-rate__label beatmapset-success-rate__label--percentage', "#{percentage}%"

        div className: 'beatmapset-success-rate__label beatmapset-success-rate__label--main', osu.trans 'beatmaps.beatmapset.show.info.points-of-failure'

        div
          className: 'beatmapset-success-rate__chart'
          ref: 'chartArea'
