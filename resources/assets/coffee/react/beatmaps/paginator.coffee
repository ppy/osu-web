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

{div,a,span,i} = React.DOM
el = React.createElement

Beatmaps.Paginator = React.createClass
  componentDidMount: ->
    @throttledAutoPagerOnScroll = _.throttle(@autoPagerOnScroll, 500)
    $(window).on 'scroll.paginator', @throttledAutoPagerOnScroll


  componentWillUnmount: ->
    $(window).off '.paginator'
    @throttledAutoPagerOnScroll.cancel()


  render: ->
    if @props.paging.load || @props.paging.more
      div
        className: 'beatmapsets-show-more'
        if @props.paging.loading
          el Icon, name: 'refresh', modifiers: ['spin']
        else if @props.paging.more
          a
            href: @props.paging.url
            className: 'beatmapsets-show-more__link'
            ref: (el) => @autoPagerTarget = el
            onClick: @showMore
            osu.trans('common.buttons.show_more')
    else
      div()


  autoPagerOnScroll: (e) ->
    return if !@props.paging.more || @props.paging.loading

    currentTarget = @autoPagerTarget.getBoundingClientRect().top
    target = document.documentElement.clientHeight + @autoPagerTriggerDistance

    if !@autoPagerTarget? || currentTarget > target
      return

    $(document).trigger 'beatmap:load_more'


  autoPagerTriggerDistance: 3000


  showMore: (e) ->
    e.preventDefault()
    $(document).trigger 'beatmap:load_more'
