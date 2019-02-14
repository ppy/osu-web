###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

{div, a, span, i} = ReactDOMFactories
el = React.createElement

class Beatmaps.Paginator extends React.PureComponent
  constructor: (props) ->
    super props

    @throttledAutoPagerOnScroll = _.throttle(@autoPagerOnScroll, 500)
    @autoPagerTriggerDistance = 3000
    @autoPagerTarget = React.createRef()


  componentDidMount: =>
    Timeout.set 0, @throttledAutoPagerOnScroll
    $(window).on 'scroll.paginator', @throttledAutoPagerOnScroll
    $(document).on 'turbolinks:before-cache.paginator', @componentWillUnmount


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
    return if !@props.more || @props.loading || !@autoPagerTarget.current?

    currentTarget = @autoPagerTarget.current.getBoundingClientRect().top
    target = document.documentElement.clientHeight + @autoPagerTriggerDistance

    return if currentTarget > target

    @showMore()


  showMore: (e) =>
    e?.preventDefault()
    $(document).trigger 'beatmap:load_more'
