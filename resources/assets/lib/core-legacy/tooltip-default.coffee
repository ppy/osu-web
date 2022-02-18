# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

export default class TooltipDefault
  constructor: ->
    $(document).on 'mouseover touchstart', '[title]:not(iframe)', @onMouseOver
    $(document).on 'mouseenter touchstart', '.u-ellipsis-overflow, .u-ellipsis-overflow-desktop, .u-ellipsis-pre-overflow', @autoAddTooltip
    $(document).on 'turbolinks:load', @rollback


  onMouseOver: (event) =>
    el = event.currentTarget

    title = el.getAttribute 'title'
    el.removeAttribute 'title'
    htmlTitle = osu.presence(el.dataset.htmlTitle)

    return if _.size(title) == 0 && !htmlTitle?

    isTime = el.classList.contains('js-timeago') || el.classList.contains('js-tooltip-time')

    $content =
      if isTime
        @timeagoTip el, title
      else
        htmlTitle ? $('<span>').text(title)

    if el._tooltip
      $(el).qtip 'set', 'content.text': $content
      return

    el._tooltip = true

    at = el.dataset.tooltipPosition ? 'top center'

    my = switch at
      when 'top center' then 'bottom center'
      when 'left center' then 'right center'
      when 'right center' then 'left center'
      when 'bottom center' then 'top center'

    classes = 'qtip tooltip-default'
    if el.dataset.tooltipFloat == 'fixed'
      classes += ' tooltip-default--fixed'
    if el.dataset.tooltipModifiers?
      classes += " tooltip-default--#{el.dataset.tooltipModifiers}"

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
        event: 'click mouseleave'
      style:
        classes: classes
        tip:
          width: 10
          height: 8

    if event.type == 'touchstart'
      options.hide =
        inactive: 3000
        event: 'unfocus'

    # if enabled, prevents tooltip from changing position
    if el.dataset.tooltipPinPosition
      options.position.effect = false

    if el.dataset.tooltipHideEvents
      options.hide.event = el.dataset.tooltipHideEvents

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
        $target.trigger(e.type) # immediately trigger qtip magic
    else
      api?.disable()


  remove: (el) ->
    return unless el._tooltip

    $(el).qtip('destroy', true)
    el._tooltip = false
    if (!el.getAttribute('title')?)
      el.setAttribute 'title', el.dataset.origTitle

    delete el.dataset.origTitle


  rollback: =>
    $('.qtip').remove()

    for el in document.querySelectorAll('[data-orig-title]')
      el.setAttribute 'title', el.dataset.origTitle


  timeagoTip: (el, title) =>
    timeString = el.getAttribute('datetime') ? title ? el.textContent

    time = moment(timeString)

    $dateEl = $('<strong>')
      .text time.format('LL')
    $timeEl = $('<span>')
      .addClass 'tooltip-default__time'
      .text "#{time.format('LTS')} #{@tzString(time)}"

    $('<span>')
      .append $dateEl
      .append ' '
      .append $timeEl


  tzString: (time) ->
    offset = time.utcOffset()

    offsetString =
      if offset % 60 == 0
        "#{if offset >= 0 then '+' else ''}#{offset / 60}"
      else
        time.format('Z')

    "UTC#{offsetString}"
