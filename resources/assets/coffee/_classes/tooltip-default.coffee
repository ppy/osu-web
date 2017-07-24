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

class @TooltipDefault
  constructor: ->
    $(document).on 'mouseover', '[title]:not(iframe)', @onMouseOver
    $(document).on 'mouseenter touchstart', '.u-ellipsis-overflow', @autoAddTooltip
    $(document).on 'turbolinks:before-cache', @rollback


  onMouseOver: (event) =>
    el = event.currentTarget

    title = el.getAttribute 'title'
    el.removeAttribute 'title'

    return if _.size(title) == 0

    isTime = el.classList.contains 'timeago'

    $content =
      if isTime
        @timeagoTip el, title
      else
        $('<span>').text(title)

    if el._tooltip
      $(el).qtip 'set', 'content.text': $content
      return

    el._tooltip = true

    at = el.dataset.tooltipPosition ? 'top center'

    my = switch at
      when 'top center' then 'bottom center'
      when 'left center' then 'right center'
      when 'right center' then 'left center'

    classes = 'qtip tooltip-default'
    if el.dataset.tooltipFloat == 'fixed'
      classes += ' tooltip-default--fixed'
    if isTime
      classes += ' tooltip-default--time'

    options =
      overwrite: false
      content: $content
      position:
        my: my
        at: at
        viewport: $(window)
      show:
        event: event.type
        ready: true
      hide:
        inactive: 3000
      style:
        classes: classes
        tip:
          width: 10
          height: 8

    el.dataset.origTitle = title

    $(el).qtip options, event

  autoAddTooltip: (e) =>
    # Automagically add qtips when text becomes truncated (and auto-removes
    # them when text becomes... un-truncated)
    target = e.currentTarget
    $target = $(target)
    api = $target.qtip('api')

    if (target.offsetWidth < target.scrollWidth)
      if (api)
        api.enable()
      else
        $target.attr 'title', $target.text()
        $target.trigger('mouseover') # immediately trigger qtip magic
    else
      api?.disable()

  rollback: =>
    $('.qtip').remove()

    for el in document.querySelectorAll('[data-orig-title]')
      el.setAttribute 'title', el.dataset.origTitle


  timeagoTip: (el, title) =>
    timeString = el.getAttribute('datetime') ? title ? el.textContent

    time = moment(timeString)

    $dateEl = $('<span>')
      .addClass 'tooltip-default__date'
      .text time.format('d MMM Y')
    $timeEl = $('<span>')
      .addClass 'tooltip-default__time'
      .text time.format('HH:mm:ss')

    $('<span>')
      .append $dateEl
      .append ' '
      .append $timeEl
