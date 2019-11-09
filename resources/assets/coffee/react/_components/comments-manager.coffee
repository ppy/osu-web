###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

import { runInAction } from 'mobx'
import { Observer } from 'mobx-react'
import core from 'osu-core-singleton'

uiState = core.dataStore.uiState

el = React.createElement

export class CommentsManager extends React.PureComponent
  SORTS: ['new', 'old', 'top']


  constructor: (props) ->
    super props

    if props.commentableType? && props.commentableId?
      # FIXME no initialization from component?
      json = osu.parseJson("json-comments-#{props.commentableType}-#{props.commentableId}", true)
      if json?
        core.dataStore.updateWithCommentBundleJSON(json)
        uiState.initializeWithCommentBundleJSON(json)

      state = osu.parseJson @jsonStorageId()
      uiState.importCommentsUIState(state) if state?

    @id = "comments-#{osu.uuid()}"


  componentDidMount: =>
    $.subscribe "comments:added.#{@id}", @handleCommentsAdded
    $.subscribe "comments:new.#{@id}", @handleCommentsNew
    $.subscribe "comments:sort.#{@id}", @updateSort
    $.subscribe "comments:toggle-show-deleted.#{@id}", @toggleShowDeleted
    $.subscribe "comments:toggle-follow.#{@id}", @toggleFollow
    $.subscribe "comment:updated.#{@id}", @handleCommentUpdated
    $(document).on "turbolinks:before-cache.#{@id}", @saveState


  componentWillUnmount: =>
    $.unsubscribe ".#{@id}"


  render: =>
    el Observer, null, () =>
      componentProps = _.assign {}, @props.componentProps
      componentProps.commentableId = @props.commentableId
      componentProps.commentableType = @props.commentableType

      el @props.component, componentProps


  handleCommentsAdded: (_event, commentBundle) =>
    runInAction () ->
      core.dataStore.updateWithCommentBundleJSON commentBundle
      uiState.updateFromCommentsAdded commentBundle


  handleCommentsNew: (_event, commentBundle) =>
    runInAction () ->
      core.dataStore.updateWithCommentBundleJSON commentBundle
      uiState.updateFromCommentsNew commentBundle


  handleCommentUpdated: (_event, commentBundle) =>
    runInAction () ->
      core.dataStore.updateWithCommentBundleJSON commentBundle


  jsonStorageId: =>
    "json-comments-manager-state-#{@props.commentableType}-#{@props.commentableId}"


  saveState: =>
    if @props.commentableType? && @props.commentableId?
      osu.storeJson @jsonStorageId(), uiState.exportCommentsUIState()


  toggleShowDeleted: =>
    runInAction () ->
      uiState.comments.isShowDeleted = !uiState.comments.isShowDeleted


  toggleFollow: =>
    params = follow:
      notifiable_type: @props.commentableType
      notifiable_id: @props.commentableId
      subtype: 'comment'

    return if uiState.comments.loadingFollow

    uiState.comments.loadingFollow = true

    $.ajax laroute.route('follows.store'),
      data: params
      dataType: 'json'
      method: if uiState.comments.userFollow then 'DELETE' else 'POST'
    .always =>
      uiState.comments.loadingFollow = false
    .done =>
      uiState.comments.userFollow = !uiState.comments.userFollow
    .fail (xhr, status) =>
      return if status == 'abort'

      osu.ajaxError xhr


  updateSort: (_event, {sort}) =>
    return unless @props.commentableType && @props.commentableId

    return unless sort in @SORTS

    runInAction () ->
      uiState.comments.loadingSort = sort

    params =
      commentable_type: @props.commentableType
      commentable_id: @props.commentableId
      sort: sort
      parent_id: 0

    $.ajax laroute.route('comments.index'),
      data: params
      dataType: 'json'
    .done (data) =>
      $.ajax laroute.route('account.options'),
        method: 'PUT'
        data: user_profile_customization: comments_sort: sort

      runInAction () ->
        core.dataStore.commentStore.flushStore()
        core.dataStore.updateWithCommentBundleJSON data
        uiState.initializeWithCommentBundleJSON data
    .always =>
      runInAction () ->
        uiState.comments.loadingSort = null

