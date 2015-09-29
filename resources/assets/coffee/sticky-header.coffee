class @StickyHeader
  stickMarker: document.getElementsByClassName('js-sticky-header')

  constructor: ->
    $(window).on 'scroll', @stickOrUnstick
    $(document).on 'ready page:load osu:page:change', @stickOrUnstick

  stickOrUnstick: =>
    return if @stickMarker.length == 0

    for marker in @stickMarker by -1
      if marker.getBoundingClientRect().top < 0
        $.publish 'stickyHeader', marker.getAttribute('data-sticky-header-target')
        return

    $.publish 'stickyHeader'
