###*
*    Copyright 2015 ppy Pty. Ltd.
*
*    This file is part of osu!web. osu!web is distributed with the hope of
*    attracting more community contributions to the core ecosystem of osu!.
*
*    osu!web is free software: you can redistribute it and/or modify
*    it under the terms of the Affero GNU General Public License version 3
*    as published by the Free Software Foundation.
*
*    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
*    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*    See the GNU Affero General Public License for more details.
*
*    You should have received a copy of the GNU Affero General Public License
*    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
*
###

{div,a,span,i} = React.DOM
el = React.createElement

Beatmaps.Paginator = React.createClass
  autoPagerTriggerDistance: 3000
  clicked: (e) ->
    e.preventDefault()
    $(document).trigger 'beatmap:load_more'

  autoPagerOnScroll: (e) ->
    if @autoPagerTarget == 'undefined' or @autoPagerTarget[0].getBoundingClientRect().top > document.documentElement.clientHeight + @autoPagerTriggerDistance
      return

    $(document).trigger 'beatmap:load_more'

  componentDidMount: ->
    @autoPagerTarget = $('#js-beatmaps-load-more')
    $(window).on 'scroll.paginator', _.throttle(@autoPagerOnScroll, 500)

  componentWillUnmount: ->
    $(window).off '.paginator'

  render: ->
    div className: ['beatmaps-load-more', ('loading ' if @props.paging.loading), ('no_more' if not @props.paging.more)].join(' '),
      a href: @props.paging.url, id: "js-beatmaps-load-more", 'data-mode': "next", onClick: @clicked, "Load more"
      i className: "fa fa-refresh fa-spin"
