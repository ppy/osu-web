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

{button, div, span} = ReactDOMFactories

el = React.createElement

bn = 'comment-show-more'

class @CommentShowMore extends React.PureComponent
  constructor: (props) ->
    super props

    @state =
      loading: false


  render: =>
    blockClass = osu.classWithModifiers bn, @props.modifiers

    div className: blockClass,
      if @state.loading
        el Spinner
      else
        button
          className: "#{bn}__link"
          onClick: @load
          @props.label ? osu.trans('common.buttons.show_more')


  load: =>
    @setState loading: true

    params =
      commentable_type: @props.parent?.commentable_type ? @props.commentableType
      commentable_id: @props.parent?.commentable_id ? @props.commentableId
      parent_id: @props.parent?.id ? ''
      after: @props.after ? ''

    $.get laroute.route('comments.index', params)
    .done (data) =>
      $.publish 'comments:added', comments: data
    .fail =>
      @setState loading: false
