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

{div, a, span, i} = ReactDOMFactories
el = React.createElement

class Beatmaps.Paginator extends React.PureComponent
  constructor: (props) ->
    super props

    @throttledAutoPagerOnScroll = _.throttle(@autoPagerOnScroll, 500)
    @autoPagerTriggerDistance = 3000


  componentDidMount: =>
    Timeout.set 0, @throttledAutoPagerOnScroll
    $(window).on 'scroll.paginator', @throttledAutoPagerOnScroll
    $(document).on 'turbolinks:before-cache.paginator', @componentWillUnmount


  componentWillUnmount: =>
    $(window).off '.paginator'
    $(document).off '.paginator'
    @throttledAutoPagerOnScroll.cancel()


  render: =>
    return div() if !@props.loading && !@props.more

    div
      className: 'beatmapsets-show-more'
      if @props.loading
        el Spinner
      else if @props.more
        a
          href: @props.url
          className: 'beatmapsets-show-more__link'
          ref: (el) => @autoPagerTarget = el
          onClick: @showMore
          osu.trans('common.buttons.show_more')


  autoPagerOnScroll: =>
    return if !@props.more || @props.loading

    currentTarget = @autoPagerTarget.getBoundingClientRect().top
    target = document.documentElement.clientHeight + @autoPagerTriggerDistance

    if !@autoPagerTarget? || currentTarget > target
      return

    $(document).trigger 'beatmap:load_more'


  showMore: (e) =>
    e.preventDefault()
    $(document).trigger 'beatmap:load_more'
