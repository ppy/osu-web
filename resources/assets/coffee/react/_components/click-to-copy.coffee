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

el = React.createElement
{span, i, a} = ReactDOMFactories

bn = 'click-to-copy'

class @ClickToCopy extends React.Component
  constructor: (props) ->
    super props

    @state =
      timer: null


  componentWillUnmount: =>
    clearTimeout @state.timer if @state.timer?


  clearLinkClicked: =>
    @setState timer: null


  click: (e) =>
    e.preventDefault()

    # copy url to clipboard
    clipboard.writeText @props.value

    # show feedback
    timer = Timeout.set 1000, @clearLinkClicked

    @setState timer: timer


  render: =>
    return span() if !@props.value

    if @state.timer?
      span
        className: bn
        osu.trans('common.buttons.click_to_copy_copied')
    else
      span
        className: bn
        onClick: @click
        a
          href: '#'
          className: "#{bn}__link"
          "#{@props.label ? @props.value}"
        i
          className: "fas fa-paste #{bn}__icon"
          title: osu.trans('common.buttons.click_to_copy')
