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

    commentBundle = @props.comments ? osu.parseJson("json-comments-#{@props.commentableType}-#{@props.commentableId}")

    @id = "comments-#{osu.uuid()}"

    @state =
      comments: commentBundle.comments
      users: commentBundle.users
      topLevelCount: commentBundle.top_level_count


  componentDidMount: =>
    $.subscribe "comments:added.#{@id}", @appendBundle
    $.subscribe "comment:updated.#{@id}", @update


  componentWillUnmount: =>
    $.unsubscribe ".#{@id}"


  render: =>
    # When implementing other type of order, don't forget to take care
    # how replying and show more interacts. It's currently fine* because
    # it's ordered by created_at descending which means the reply will
    # always be at the top and doesn't affect loading older posts.
    # Also handling new replies will need to be fixed as well for newest
    # first because it currently just doesn't.
    commentsByParentId = _(@state.comments ? [])
      .uniqBy('id')
      .orderBy(['created_at', 'id'], ['desc', 'desc'])
      .groupBy('parent_id')
      .value()
    usersById = _.keyBy(@state.users ? [], 'id')

    comments = commentsByParentId[null]


    div className: osu.classWithModifiers('comments', @props.modifiers),
      h2 className: 'comments__title', osu.trans('comments.title')
      div className: 'comments__new',
        el CommentEditor,
          commentableType: @props.commentableType
          commentableId: @props.commentableId
          focus: false
          modifiers: @props.modifiers
      if comments?
        div className: 'comments__items',
          for comment in comments
            el Comment,
              key: comment.id
              comment: comment
              commentsByParentId: commentsByParentId
              usersById: usersById
              depth: 0
              modifiers: @props.modifiers
          if comments.length < @state.topLevelCount
            lastCommentId = _.last(comments)?.id
            el CommentShowMore,
              key: "show-more:#{lastCommentId}"
              commentableType: @props.commentableType
              commentableId: @props.commentableId
              after: lastCommentId
              modifiers: _.concat 'top', @props.modifiers
      else
        div
          className: 'comments__items comments__items--empty'
          osu.trans('comments.empty')


  appendBundle: (_event, {comments}) =>
    @setState
      comments: osu.updateCollection @state.comments, comments.comments
      users: osu.updateCollection @state.users, comments.users


  update: (_event, {comment}) =>
    @setState
      comments: osu.updateCollection @state.comments, [comment]
      users: osu.updateCollection @state.users, [comment.user, comment.editor]
