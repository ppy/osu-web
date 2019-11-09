###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

import core from 'osu-core-singleton'
import * as React from 'react'
import { div, a, span, i } from 'react-dom-factories'
import { ShowMoreLink } from 'show-more-link'
el = React.createElement

export class Paginator extends React.PureComponent
  constructor: (props) ->
    super props

    @throttledAutoPagerOnScroll = _.throttle(@autoPagerOnScroll, 500)
    @autoPagerTriggerDistance = 3000
    @autoPagerTarget = React.createRef()


  componentDidMount: =>
    Timeout.set 0, @throttledAutoPagerOnScroll
    $(window).on 'scroll.paginator', @throttledAutoPagerOnScroll


  componentWillUnmount: =>
    $(window).off '.paginator'
    $(document).off '.paginator'
    @throttledAutoPagerOnScroll.cancel()


  render: =>
    el ShowMoreLink,
      loading: @props.loading
      callback: @showMore
      hasMore: @props.more
      ref: @autoPagerTarget
      modifiers: ['beatmapsets', 't-ddd']


  autoPagerOnScroll: =>
    return if @props.error? || !@props.more || @props.loading || !@autoPagerTarget.current?

    currentTarget = @autoPagerTarget.current.getBoundingClientRect().top
    target = document.documentElement.clientHeight + @autoPagerTriggerDistance

    return if currentTarget > target

    @showMore()


  showMore: (e) ->
    core.beatmapsetSearchController.loadMore()
