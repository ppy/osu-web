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

{a, div, h3, span} = React.DOM
el = React.createElement

class BeatmapsetPage.Info extends React.Component
  componentDidMount: ->
    @renderChart()


  componentDidUpdate: ->
    @renderChart()


  componentWillUnmount: =>
    $(window).off '.beatmapsetPageInfo'


  renderChart: ->
    return if !@props.beatmapset.has_scores

    unless @_failurePointsChart?
      options =
        scales:
          x: d3.scaleLinear()
          y: d3.scaleLinear()
        modifiers: ['beatmap-success-rate']

      @_failurePointsChart = new StackedBarChart @refs.chartArea, options
      $(window).on 'throttled-resize.beatmapsetPageInfo', @_failurePointsChart.resize

    @_failurePointsChart.loadData @props.beatmap.failtimes

  render: ->
    percentage = _.round (@props.beatmap.passcount / (@props.beatmap.playcount + @props.beatmap.passcount)) * 100

    div className: 'beatmapset-info',
      div className: 'beatmapset-info__box beatmapset-info__box--description',
        h3
          className: 'beatmapset-info__header'
          osu.trans 'beatmapsets.show.info.description'

        div
          className: 'beatmapset-info__description'
          dangerouslySetInnerHTML:
            __html: @props.beatmapset.description.description

      div className: 'beatmapset-info__box beatmapset-info__box--meta',
        if @props.beatmapset.source
          div null,
            h3
              className: 'beatmapset-info__header'
              osu.trans 'beatmapsets.show.info.source'

            div null, @props.beatmapset.source

        if @props.beatmapset.tags
          div null,
            h3
              className: 'beatmapset-info__header'
              osu.trans 'beatmapsets.show.info.tags'

            div null,
              @props.beatmapset.tags.split(' ').map (tag) =>
                return if tag.length == 0

                [
                  a
                    key: tag
                    href: laroute.route('beatmapsets.index', q: tag)
                    tag

                  span key: "#{tag}-space", ' '
                ]

      div className: 'beatmapset-info__box beatmapset-info__box--success-rate',
        if @props.beatmapset.has_scores
          div className: 'beatmap-success-rate',
            h3
              className: 'beatmap-success-rate__header'
              osu.trans 'beatmapsets.show.info.success-rate'

            div className: 'bar bar--beatmap-success-rate',
              div
                className: 'bar__fill'
                style:
                  width: "#{percentage}%"

            div
              className: 'beatmap-success-rate__percentage'
              style:
                paddingLeft: "#{percentage}%"
              div null, "#{percentage}%"

            h3
              className: 'beatmap-success-rate__header'
              osu.trans 'beatmapsets.show.info.points-of-failure'

            div
              className: 'beatmap-success-rate__chart'
              ref: 'chartArea'
        else
          div className: 'beatmap-success-rate',
            div
              className: 'beatmap-success-rate__empty'
              osu.trans 'beatmapsets.show.info.no_scores'
