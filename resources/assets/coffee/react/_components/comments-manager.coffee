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

class @CommentsManager extends React.PureComponent
  @defaultProps =
    additionalComments: []


  constructor: (props) ->
    super props

    @id = "comments-#{osu.uuid()}"

    @state = osu.parseJson @jsonStorageId()

    if !@state?
      commentBundle = osu.jsonClone(@props.commentBundle) ?
        osu.parseJson("json-comments-#{@props.commentableType}-#{@props.commentableId}")

      @state =
        comments: comments ? commentBundle.comments ? []
        userVotes: commentBundle.user_votes
        users: users ? commentBundle.users ? []
        topLevelCount: commentBundle.top_level_count
        commentableMeta: commentBundle.commentable_meta ? []


  componentDidMount: =>
    $.subscribe "comments:added.#{@id}", @appendBundle
    $.subscribe "comment:updated.#{@id}", @update
    $.subscribe "commentVote:added.#{@id}", @addVote
    $.subscribe "commentVote:removed.#{@id}", @removeVote
    $(document).on "turbolinks:before-cache.#{@id}", @saveState


  componentWillUnmount: =>
    $.unsubscribe ".#{@id}"


  render: =>
    componentProps = _.assign {}, @props.componentProps, @state
    componentProps.commentableType = @props.commentableType
    componentProps.commentableId = @props.commentableId
    componentProps.userVotesByCommentId = _.keyBy @state.userVotes
    componentProps.usersById = _.keyBy(@state.users ? [], 'id')
    componentProps.commentableMetaById = _(@state.commentableMeta ? [])
      .filter (item) -> item?
      .keyBy (item) -> "#{item.type ? ''}-#{item.id ? ''}"
      .value()
    componentProps.sortedComments = _(@state.comments ? [])
      .uniqBy('id')
      .orderBy(['created_at', 'id'], ['desc', 'desc'])
      .value()

    el @props.component, componentProps


  appendBundle: (_event, {comments}) =>
    @setState
      comments: osu.updateCollection @state.comments, comments.comments
      users: osu.updateCollection @state.users, comments.users
      commentableMeta: _.concat @state.commentableMeta, comments.commentable_meta


  update: (_event, {comment}) =>
    @setState
      comments: osu.updateCollection @state.comments, [comment]
      users: osu.updateCollection @state.users, [comment.user, comment.editor]
      commentableMeta: _.concat @state.commentableMeta, [comment.commentable_meta]


  addVote: (_event, {id}) =>
    @setState userVotes: _.concat @state.userVotes, id


  removeVote: (_event, {id}) =>
    @setState userVotes: _.filter @state.userVotes, (commentId) -> commentId != id


  jsonStorageId: =>
    "json-comments-manager-state-#{@props.commentableType}-#{@props.commentableId}"


  saveState: =>
    osu.storeJson @jsonStorageId(), @state
