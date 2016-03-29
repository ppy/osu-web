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
{a, div, h1, p} = React.DOM
el = React.createElement

bn = 'beatmap-discussions-overview'

BeatmapDiscussions.Overview = React.createClass
  mixins: [React.addons.PureRenderMixin]


  componentDidMount: ->
    @updateChart()


  componentWillUpdate: ->
    @_currentDiscussions = null


  componentDidUpdate: ->
    @updateChart()


  componentWillUnmount: ->
    $(window).off '.beatmapDiscussionsOverview'


  render: ->
    user = @props.lookupUser @props.beatmapset.user_id

    div
      className: bn

      div
        className: "#{bn}__row #{bn}__row--beatmaps"
        el BeatmapDiscussions.BeatmapList,
          currentBeatmap: @props.currentBeatmap
          beatmapset: @props.beatmapset

      div
        className: "#{bn}__row #{bn}__row--chart"
        div ref: 'chartArea', className: 'beatmap-discussions-chart'

      div
        className: "#{bn}__row #{bn}__row--info"

        div null,
          div
            className: "#{bn}__meta-text #{bn}__meta-text--large"
            @props.beatmapset.title
          div
            className: "#{bn}__meta-text"
            @props.beatmapset.artist
          div
            className: "#{bn}__meta-text"
            dangerouslySetInnerHTML:
              __html: Lang.get 'beatmaps.listing.mapped-by',
                mapper: "<strong>#{osu.link Url.user(user.user_id), user.username}</strong>"

        div className: 'text-right',
          @stats()


  currentDiscussions: ->
    if !@_currentDiscussions?
      @_currentDiscussions = @props
        .beatmapsetDiscussion
        .beatmap_discussions
        .data
        .filter (discussion) =>
          discussion.beatmap_id == @props.currentBeatmap.id

    @_currentDiscussions


  stats: ->
    sbn = 'beatmap-discussions-stats'

    discussions = @currentDiscussions().filter (discussion) =>
      discussion.timestamp? &&
      discussion.message_type != 'praise'

    count =
      resolved:
        discussions
          .filter (discussion) => discussion.resolved
          .length
      total: discussions.length

    count.pending = count.total - count.resolved

    ['resolved', 'pending', 'total'].map (type) =>
      div
        key: type
        className: "#{sbn} #{sbn}--#{type}"
        p className: "#{sbn}__text #{sbn}__text--type", Lang.get("beatmaps.discussions.stats.#{type}")
        p className: "#{sbn}__text #{sbn}__text--count", count[type]


  updateChart: ->
    if !@_chart?
      area = @refs.chartArea
      length = @props.currentBeatmap.total_length * 1000

      @_chart = new BeatmapDiscussionsChart(area, length)

      $(window).on 'throttled-resize.beatmapDiscussionsOverview', @_chart.resize

      window.butts = @_chart

    @_chart.loadData @currentDiscussions()
