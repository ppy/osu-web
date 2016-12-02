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
{a, button, div, h1, h2, p} = React.DOM
el = React.createElement

BeatmapDiscussions.Header = React.createClass
  mixins: [React.addons.PureRenderMixin]


  componentDidMount: ->
    @updateChart()


  componentDidUpdate: ->
    @updateChart()


  componentWillUnmount: ->
    $(window).off '.beatmapDiscussionsOverview'


  render: ->
    div null,
      div
        className: 'osu-page'
        @headerTop()

      div
        className: 'osu-page osu-page--small'
        @headerBottom()


  headerBottom: ->
    bn = 'beatmap-discussions-header-bottom'

    div className: bn,
      div className: "#{bn}__content #{bn}__content--nomination",
        el BeatmapDiscussions.Nominations,
          beatmapset: @props.beatmapset
          currentUser: @props.currentUser

      div className: "#{bn}__content #{bn}__content--mapping",
        el BeatmapsetMapping,
          beatmapset: @props.beatmapset
          user: @props.users[@props.beatmapset.user_id]


  headerTop: ->
    bn = 'beatmap-discussions-header-top'

    div
      className: bn

      el PlaymodeTabs,
        currentMode: @props.currentBeatmap.mode
        beatmaps: @props.beatmaps

      div
        className: "#{bn}__content"
        style:
          backgroundImage: "url('#{@props.beatmapset.covers.cover}')"

        a
          className: "#{bn}__title-container"
          href: laroute.route('beatmapsets.show', beatmapset: @props.beatmapset.id)
          h1
            className: "#{bn}__title"
            @props.beatmapset.title
          h2
            className: "#{bn}__title #{bn}__title--artist"
            @props.beatmapset.artist

        div
          className: "#{bn}__filters"

          el BeatmapDiscussions.BeatmapList,
            currentBeatmap: @props.currentBeatmap
            beatmaps: @props.beatmaps[@props.currentBeatmap.mode]

          div
            className: "#{bn}__stats"
            @stats()

        div null,
          div ref: 'chartArea', className: "#{bn}__chart"

          div className: "#{bn}__beatmap-stats",
            el BeatmapBasicStats,
              beatmapset: @props.beatmapset
              beatmap: @props.currentBeatmap


  stats: ->
    bn = 'counter-box'

    types = ['mine', 'resolved', 'pending', 'praises']
    types.push('deleted') if @props.currentUser.isAdmin
    types.push('total')

    for type in types
      topClasses = "#{bn} #{bn}--beatmap-discussions #{bn}--#{type}"
      topClasses += ' js-active' if @props.mode == 'timeline' && @props.currentFilter == type

      a
        key: type
        href: '#'
        className: topClasses
        'data-type': type
        onClick: @setFilter

        div
          className: "#{bn}__content"
          div
            className: "#{bn}__title"
            osu.trans("beatmaps.discussions.stats.#{type}")
          div
            className: "#{bn}__count"
            _.size(@props.currentDiscussions.timelineByFilter[type])

        div className: "#{bn}__line"


  updateChart: ->
    if !@_chart?
      area = @refs.chartArea
      length = @props.currentBeatmap.total_length * 1000

      @_chart = new BeatmapDiscussionsChart(area, length)

      $(window).on 'throttled-resize.beatmapDiscussionsOverview', @_chart.resize

    @_chart.loadData _.values(@props.currentDiscussions.timelineByFilter[@props.currentFilter])


  setFilter: (e) ->
    e.preventDefault()
    $.publish 'beatmapDiscussion:filter', filter: e.currentTarget.dataset.type
