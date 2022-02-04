# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import ShowMoreLink from 'components/show-more-link'
import core from 'osu-core-singleton'
import * as React from 'react'
import { div } from 'react-dom-factories'

el = React.createElement

export class Paginator extends React.PureComponent
  constructor: (props) ->
    super props

    @throttledAutoPagerOnScroll = _.throttle(@autoPagerOnScroll, 500)
    @autoPagerTriggerDistance = 3000
    @lineRef = React.createRef()


  componentDidMount: =>
    Timeout.set 0, @throttledAutoPagerOnScroll
    $(window).on 'scroll', @throttledAutoPagerOnScroll


  componentWillUnmount: =>
    $(window).off 'scroll', @throttledAutoPagerOnScroll
    @throttledAutoPagerOnScroll.cancel()


  render: =>
    el React.Fragment, null,
      div ref: @lineRef
      el ShowMoreLink,
        loading: @props.loading
        callback: @showMore
        hasMore: @props.more
        modifiers: ['beatmapsets', 't-ddd']


  autoPagerOnScroll: =>
    return if @props.error? || !@props.more || @props.loading || !@lineRef.current?

    currentTarget = @lineRef.current.getBoundingClientRect().top
    target = document.documentElement.clientHeight + @autoPagerTriggerDistance

    return if currentTarget > target

    @showMore()


  showMore: (e) ->
    core.beatmapsetSearchController.loadMore()
