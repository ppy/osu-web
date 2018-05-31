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
{button, div, i, span} = ReactDOMFactories

bn = 'block-button'

class @BlockButton extends React.PureComponent
  constructor: (props) ->
    super props

    @eventId = "blockButton-#{@props.user_id}-#{osu.uuid()}"
    @state =
      block: _.find(currentUser.blocks, target_id: props.user_id)


  requestDone: =>
    @setState loading: false


  updateBlocks: (data) =>
    @setState block: _.find(data, (o) => o.target_id == @props.user_id), ->
      currentUser.blocks = _.filter data, relation_type: 'block'
      currentUser.friends = _.filter data, relation_type: 'friend'
      $.publish 'user:update', currentUser
      $.publish 'blockButton:refresh'
      $.publish 'friendButton:refresh'
      $.publish 'user:page:update'


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
      .done @updateBlocks
      .fail osu.emitAjaxError(@button)
      .always @requestDone


  refresh: (e) =>
    @setState block: _.find(currentUser.blocks, target_id: @props.user_id), =>
      @forceUpdate()


  componentDidMount: =>
    $.subscribe "blockButton:refresh.#{@eventId}", @refresh


  componentWillUnmount: =>
    $.unsubscribe ".#{@eventId}"
    @xhr?.abort()


  render: =>
    if @isVisible()
      @props.container?.classList.remove 'hidden'
    else
      @props.container?.classList.add 'hidden'

      return null

    blockClass = bn

    button
      type: 'button'
      className: blockClass
      onClick: @clicked
      ref: (el) => @button = el
      disabled: @state.loading
      if @state.loading
        i className: "#{bn}__icon fas fa-sync fa-spin"
      else
        if @state.block
          span {},
            i className: "#{bn}__icon fas fa-ban"
            " #{osu.trans 'users.blocks.button.unblock'}"
        else
          span {},
            i className: "#{bn}__icon fas fa-ban"
            " #{osu.trans 'users.blocks.button.block'}"

  isVisible: =>
    # - not a guest
    # - not viewing own card
    # - already blocked or can add more blocks
    currentUser.id? &&
      _.isFinite(@props.user_id) &&
      @props.user_id != currentUser.id &&
      (@state.block || currentUser.blocks.length < currentUser.max_blocks)
