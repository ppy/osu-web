###
#    Copyright 2015-2018 ppy Pty. Ltd.
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
{button, div, i, span} = ReactDOMFactories

bn = 'textual-button'

class @BlockButton extends React.PureComponent
  constructor: (props) ->
    super props

    @eventId = "blockButton-#{@props.user_id}-#{osu.uuid()}"
    @state =
      block: _.find(currentUser.blocks, target_id: props.user_id)


  updateBlocks: (data) =>
    @setState block: _.find(data, target_id: @props.user_id), ->
      currentUser.blocks = _.filter data, relation_type: 'block'
      currentUser.friends = _.filter data, relation_type: 'friend'
      $.publish 'user:update', currentUser
      $.publish 'blockButton:refresh'
      $.publish 'friendButton:refresh'


  refresh: (e) =>
    @setState block: _.find(currentUser.blocks, target_id: @props.user_id)


  clicked: (e) =>
    return if !confirm osu.trans('common.confirmation')

    @setState loading: true, =>
      if @state.block
        #un-blocking
        @xhr = $.ajax
          type: 'DELETE'
          url: laroute.route 'blocks.destroy', block: @props.user_id
      else
        #blocking
        @xhr = $.ajax
          type: 'POST'
          url: laroute.route 'blocks.store', target: @props.user_id

      @xhr
      .always =>
        @setState loading: false
      .fail osu.emitAjaxError(@button)
      .done @updateBlocks


  setButton: (element) =>
    @button = element


  componentDidMount: =>
    $.subscribe "blockButton:refresh.#{@eventId}", @refresh


  componentWillUnmount: =>
    $.unsubscribe ".#{@eventId}"
    @xhr?.abort()


  render: =>
    return null unless @isVisible()

    button
      type: 'button'
      className: "#{bn} #{bn}--block"
      onClick: @clicked
      ref: @setButton
      disabled: @state.loading
      span {},
        if @state.loading
          span className: "#{bn}__icon fa-fw", el Spinner
        else
          i className: "#{bn}__icon fas fa-ban fa-fw"

        if @state.block then " #{osu.trans 'users.blocks.button.unblock'}" else " #{osu.trans 'users.blocks.button.block'}"

  isVisible: =>
    # - not a guest
    # - not viewing own profile
    currentUser.id? &&
      _.isFinite(@props.user_id) &&
      @props.user_id != currentUser.id
