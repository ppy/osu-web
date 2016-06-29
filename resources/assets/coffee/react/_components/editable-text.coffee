###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License version 3
# as published by the Free Software Foundation.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
el = React.createElement


class @EditableText extends React.Component
  #Goal: a text box that is editable, with a little icon, that calls a callback to save.
  constructor: (props) ->
    super props
    
    @state =
      hovering: false
      editing: false
  hoveron: =>
    @setState hovering: true
  hoveroff: =>
    @setState hovering: false
  change: (e) =>
    e.stopPropagation()
    @setState editing: true, text: @props.text
  saveChanges: =>

    #callback should edit text prop otherwise change will not save
    if @props.callBack?
      @props.callBack @state.text

    @setState editing: false, hovering: false
  navigate: =>
    if @props.href?
      window.location = @props.href
    
  render: =>
    tag = @props.tag or 'dd'
    tagclassname = @props.css or "profile-info__data-value"
    
    return el 'span' unless @props.text
    el 'div', {},
      if not @state.editing
        el tag,
          className: tagclassname
          onMouseEnter: @hoveron
          onMouseLeave: @hoveroff
          onClick: @navigate
          @props.text
          if @state.hovering and @props.withEdit
            el 'i', className: 'fa fa-pencil', onClick: @change, id: 'edit'
      if @state.editing and @props.withEdit
        el 'textarea',
          onBlur: @saveChanges
          value: @state.text
          className: 'form-control editable-text__input'
          style:
            height: @state.textHeight or 'inherit'
          onChange: (ev) => @setState text: ev.target.value, textHeight: ev.target.scrollHeight


