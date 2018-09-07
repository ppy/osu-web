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

{button, div, h2} = ReactDOMFactories

el = React.createElement

class @Comments extends React.PureComponent
  constructor: (props) ->
    super props

    comments = @props.comments ? osu.parseJson("json-comments-#{@props.commentableType}-#{@props.commentableId}")

    @id = "comments-#{osu.uuid()}"

    @state = {comments}


  componentDidMount: =>
    $.subscribe "comment:added.#{@id}", @append
    $.subscribe "comment:updated.#{@id}", @update


  componentWillUnmount: =>
    $.unsubscribe ".#{@id}"


  render: =>
    commentsByParentId = _.groupBy(@state.comments ? [], 'parent_id')
    # comments sorting goes here. Or somewhere to account for children. Idk.

    comments = commentsByParentId[null]

    items =
      if comments?
        for comment in comments
          el Comment,
            key: comment.id
            comment: comment
            commentsByParentId: commentsByParentId
            depth: 0
            modifiers: @props.modifiers
      else
        osu.trans('comments.empty')

    div className: osu.classWithModifiers('comments', @props.modifiers),
      h2 className: 'comments__title', osu.trans('comments.title')
      div className: 'comments__new',
        el CommentEditor,
          commentableType: @props.commentableType
          commentableId: @props.commentableId
          focus: false
          modifiers: @props.modifiers
      div className: 'comments__items', items


  append: (_event, {comment}) =>
    return if comment.commentable_type != @props.commentableType || comment.commentable_id != @props.commentableId

    @setState comments: @state.comments.concat comment


  update: (_event, {comment}) =>
    return if comment.commentable_type != @props.commentableType || comment.commentable_id != @props.commentableId

    newComments = osu.jsonClone(@state.comments)
    replacementIndex = _.findIndex newComments, (c) -> c.id == comment.id
    newComments[replacementIndex] = comment if replacementIndex != -1

    @setState comments: newComments
