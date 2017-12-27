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

{a, button, div, p, span} = ReactDOMFactories
el = React.createElement

bn = 'beatmap-discussions'
lp = 'beatmaps.discussions'

sortPresets =
  updated_at:
    icon: 'arrow-up'
    text: osu.trans('beatmaps.discussions.sort.updated-time')
    sort: (a, b) ->
      if Date.parse(a.updated_at) < Date.parse(b.updated_at) then 1 else -1

  created_at:
    icon: 'calendar'
    text: osu.trans('beatmaps.discussions.sort.post-time')
    sort: (a, b) ->
      if Date.parse(a.created_at) > Date.parse(b.created_at) then 1 else -1

  # there's obviously no timeline field
  timeline:
    icon: 'clock-o'
    text: osu.trans('beatmaps.discussions.sort.timeline')
    sort: (a, b) ->
      0

class BeatmapDiscussions.Discussions extends React.PureComponent
  constructor: (props) ->
    super props

    @state =
      sortField: if @props.mode == 'timeline' then 'timeline' else 'created_at'


  componentWillReceiveProps: (nextProps) =>
    if _.includes(['created_at', 'timeline'], @state.sortField)
      if nextProps.mode == 'timeline'
        @setState sortField: 'timeline'
      else
        @setState sortField: 'created_at'


  render: =>
    discussions = @props.currentDiscussions[@props.mode]

    div className: 'osu-page osu-page--small osu-page--full',
      div
        className: bn

        div className: 'page-title',
          osu.trans('beatmaps.discussions.title')

        div className: "#{bn}__toolbar",
          div className: "#{bn}__toolbar-content #{bn}__toolbar-content--right",
            a
              href: '#'
              className: "#{bn}__toolbar-link"
              'data-type': 'sort'
              onClick: @changeSort
              span className: "#{bn}__toolbar-link-content", osu.trans('beatmaps.discussions.sort._')
              el Icon,
                name: sortPresets[@state.sortField].icon
                parentClass: "#{bn}__toolbar-link-content"
              span className: "#{bn}__toolbar-link-content", sortPresets[@state.sortField].text

            a
              href: '#'
              className: "#{bn}__toolbar-link"
              'data-type': 'collapse'
              onClick: @expand
              el IconExpand,
                expand: false
                parentClass: "#{bn}__toolbar-link-content"
              span className: "#{bn}__toolbar-link-content",
                osu.trans('beatmaps.discussions.collapse.all-collapse')

            a
              href: '#'
              className: "#{bn}__toolbar-link"
              'data-type': 'expand'
              onClick: @expand
              el IconExpand,
                parentClass: "#{bn}__toolbar-link-content"
              span className: "#{bn}__toolbar-link-content",
                osu.trans('beatmaps.discussions.collapse.all-expand')


        if discussions.length == 0
          div className: "#{bn}__discussions #{bn}__discussions--empty",
            osu.trans 'beatmaps.discussions.empty.empty'

        else if _.size(@props.currentDiscussions.byFilter[@props.currentFilter][@props.mode]) == 0
          div className: "#{bn}__discussions #{bn}__discussions--empty",
            osu.trans 'beatmaps.discussions.empty.hidden'

        else
          div
            className: "#{bn}__discussions"
            @timelineCircle()

            if @isTimelineVisible()
              div className: "#{bn}__timeline-line hidden-xs"

            div null,
              @sortedDisussions().map @discussionPage

            @timelineCircle()


  discussionPage: (discussion) =>
    return if !discussion.id?

    className = "#{bn}__discussion"
    visible = @props.currentDiscussions.byFilter[@props.currentFilter][@props.mode][discussion.id]?
    className += ' u-hide-by-height' unless visible

    div
      key: discussion.id
      className: className
      el BeatmapDiscussions.Discussion,
        discussion: discussion
        users: @props.users
        currentUser: @props.currentUser
        beatmapset: @props.beatmapset
        currentBeatmap: @props.currentBeatmap
        userPermissions: @props.userPermissions
        readPostIds: @props.readPostIds
        isTimelineVisible: @isTimelineVisible()
        visible: visible


  changeSort: (e) =>
    e.preventDefault()
    if @state.sortField == 'updated_at'
      if @props.mode == 'timeline'
        @setState sortField: 'timeline'
      else
        @setState sortField: 'created_at'

    else
      @setState sortField: 'updated_at'


  expand: (e) =>
    e.preventDefault()
    $.publish 'beatmapDiscussionEntry:collapse', collapse: e.currentTarget.dataset.type


  hidden: (discussion) =>
    switch @props.currentFilter
      when 'mine' then discussion.user_id != @props.currentUser.id
      when 'resolved' then discussion.message_type == 'praise' || !discussion.resolved
      when 'pending' then discussion.message_type == 'praise' || discussion.resolved
      when 'praises' then discussion.message_type != 'praise'
      else false


  isTimelineVisible: =>
    @props.mode == 'timeline' && @state.sortField == 'timeline'


  sortedDisussions: ->
    discussions = @props.currentDiscussions[@props.mode].slice(0)
    discussions.sort sortPresets[@state.sortField].sort


  timelineCircle: =>
    div
      'data-visibility': if !@isTimelineVisible() then 'hidden'
      className: "#{bn}__mode-circle #{bn}__mode-circle--active hidden-xs"
