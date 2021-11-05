# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { MessageLengthCounter } from './message-length-counter'
import { discussionTypeIcons } from 'beatmap-discussions/discussion-type'
import BigButton from 'big-button'
import * as React from 'react'
import TextareaAutosize from 'react-autosize-textarea'
import { button, div, input, label, p, i, span } from 'react-dom-factories'
import StringWithComponent from 'string-with-component'
import TimeWithTooltip from 'time-with-tooltip'
import UserAvatar from 'user-avatar'
import { nominationsCount } from 'utils/beatmapset-helper'
import { hideLoadingOverlay, showLoadingOverlay } from 'utils/loading-overlay'
el = React.createElement

bn = 'beatmap-discussion-new'

export class NewDiscussion extends React.PureComponent
  constructor: (props) ->
    super props

    @inputBox = React.createRef()
    @throttledPost = _.throttle @post, 1000
    @handleKeyDown = InputHandler.textarea @handleKeyDownCallback

    # FIXME: should save state on navigation?
    @state =
      cssTop: null
      message: ''
      timestampConfirmed: false
      posting: null


  componentDidMount: =>
    @setTop()
    $(window).on 'resize', @setTop
    @inputBox.current?.focus() if @props.autoFocus


  componentWillUnmount: =>
    $(window).off 'resize', @setTop
    @postXhr?.abort()
    @throttledPost.cancel()


  render: =>
    cssClasses = 'beatmap-discussion-new-float'
    cssClasses += ' beatmap-discussion-new-float--pinned' if @props.pinned

    div
      className: cssClasses
      style:
        top: @state.cssTop
      div className: 'beatmap-discussion-new-float__floatable',
        div
          className: 'beatmap-discussion-new-float__content'
          ref: @props.innerRef

          @renderBox()


  renderBox: =>
    canHype =
      @props.beatmapset.current_user_attributes?.can_hype &&
      @props.beatmapset.can_be_hyped &&
      @props.mode == 'generalAll'

    canPostNote =
      @props.currentUser.id == @props.beatmapset.user_id ||
      (@props.currentUser.id == @props.currentBeatmap.user_id && @props.mode in ['general', 'timeline']) ||
      @props.currentUser.is_bng ||
      BeatmapDiscussionHelper.canModeratePosts(@props.currentUser)

    buttonCssClasses = 'btn-circle'
    buttonCssClasses += ' btn-circle--activated' if @props.pinned

    div
      className: 'osu-page osu-page--small'
      div
        className: bn
        div className: "page-title",
          osu.trans('beatmaps.discussions.new.title')

          span className: 'page-title__button',
            span
              className: buttonCssClasses
              onClick: @toggleSticky
              title: osu.trans("beatmaps.discussions.new.#{if @props.pinned then 'unpin' else 'pin'}")

              span className: 'btn-circle__content',
                i className: 'fas fa-thumbtack'

        div className: "#{bn}__content",
          div
            className: "#{bn}__avatar"
            el UserAvatar, user: @props.currentUser, modifiers: ['full-rounded']

          div className: "#{bn}__message", id: 'new',
            if @props.currentUser.id?
              [
                el TextareaAutosize,
                  key: 'input'
                  disabled: @state.posting? || !@canPost()
                  className: "#{bn}__message-area js-hype--input"
                  value: if @canPost() then @state.message else ''
                  onChange: @setMessage
                  onKeyDown: @handleKeyDown
                  onFocus: @onFocus
                  ref: @inputBox
                  placeholder: @messagePlaceholder()

                el MessageLengthCounter,
                  key: 'counter'
                  message: @state.message
                  isTimeline: @isTimeline()
              ]
            else
              osu.trans('beatmaps.discussions.require-login')

        div className: "#{bn}__footer",
          div
            className: "#{bn}__footer-content js-hype--explanation js-flash-border"
            style:
              opacity: 0 if @props.mode != 'timeline' && !(@props.mode == 'generalAll' && @props.beatmapset.can_be_hyped)
            div
              key: 'label'
              className: "#{bn}__timestamp-col #{bn}__timestamp-col--label"
              if @props.mode == 'timeline'
                osu.trans 'beatmaps.discussions.new.timestamp'
              else # mode == 'generalAll'
                osu.trans 'beatmaps.hype.title'
            div
              key: 'timestamp'
              className: "#{bn}__timestamp-col"
              if @props.mode == 'timeline'
                if @timestamp()?
                  BeatmapDiscussionHelper.formatTimestamp @timestamp()
                else
                  osu.trans 'beatmaps.discussions.new.timestamp_missing'
              else if @props.beatmapset.can_be_hyped # mode == 'generalAll'
                if @props.currentUser.id?
                  el React.Fragment, null,
                    if @props.beatmapset.current_user_attributes.can_hype
                      osu.trans 'beatmaps.hype.explanation'
                    else
                      @props.beatmapset.current_user_attributes.can_hype_reason

                    if @props.beatmapset.current_user_attributes.can_hype || @props.beatmapset.current_user_attributes.remaining_hype <= 0
                      el React.Fragment, null,
                        el StringWithComponent,
                          mappings:
                            remaining: @props.beatmapset.current_user_attributes.remaining_hype
                          pattern: " #{osu.trans 'beatmaps.hype.remaining'}"
                        if @props.beatmapset.current_user_attributes.new_hype_time?
                          el StringWithComponent,
                            mappings:
                              new_time: el TimeWithTooltip,
                                dateTime: @props.beatmapset.current_user_attributes.new_hype_time
                                relative: true
                            pattern: " #{osu.trans 'beatmaps.hype.new_time'}"
                else
                  osu.trans 'beatmaps.hype.explanation_guest'
          div
            className: "#{bn}__footer-content #{bn}__footer-content--right"
            if canHype
              @submitButton 'hype'
            if canPostNote
              @submitButton 'mapper_note'
            @submitButton 'praise'
            @submitButton 'suggestion'
            @submitButton 'problem'

        if @nearbyDiscussions().length > 0
          currentTimestamp = BeatmapDiscussionHelper.formatTimestamp @timestamp()
          timestamps =
            for discussion in @nearbyDiscussions()
              osu.link BeatmapDiscussionHelper.url(discussion: discussion),
                BeatmapDiscussionHelper.formatTimestamp(discussion.timestamp)
                classNames: ['js-beatmap-discussion--jump']
          timestampsString = osu.transArray(timestamps)

          div className: "#{bn}__notice",
            div
              className: "#{bn}__notice-text"
              dangerouslySetInnerHTML:
                __html: osu.trans 'beatmap_discussions.nearby_posts.notice',
                  timestamp: currentTimestamp
                  existing_timestamps: timestampsString

            label className: "#{bn}__notice-checkbox",
              div className: 'osu-switch-v2',
                input
                  className: 'osu-switch-v2__input'
                  type: 'checkbox'
                  checked: @state.timestampConfirmed
                  onChange: @toggleTimestampConfirmation
                span className: 'osu-switch-v2__content'

              osu.trans('beatmap_discussions.nearby_posts.confirm')


  canPost: =>
    !@props.currentUser.is_silenced &&
    (!@props.beatmapset.discussion_locked || BeatmapDiscussionHelper.canModeratePosts(@props.currentUser)) &&
    (!@props.currentBeatmap.deleted_at? || @props.mode == 'generalAll')


  cssTop: (sticky) =>
    return if !sticky || !@props.stickTo?.current?
    window.stickyHeader.headerHeight() + @props.stickTo.current.getBoundingClientRect().height


  handleKeyDownCallback: (type, event) =>
    # Ignores SUBMIT, requiring shift-enter to add new line.
    switch type
      when InputHandler.CANCEL
        @setSticky(false)


  isTimeline: =>
    @props.mode == 'timeline'


  messagePlaceholder: =>
    if @canPost()
      osu.trans "beatmaps.discussions.message_placeholder.#{@props.mode}", version: @props.currentBeatmap.version
    else
      if @props.currentUser.is_silenced
        osu.trans 'beatmaps.discussions.message_placeholder_silenced'
      else if @props.beatmapset.discussion_locked
        osu.trans 'beatmaps.discussions.message_placeholder_locked'
      else
        osu.trans 'beatmaps.discussions.message_placeholder_deleted_beatmap'


  nearbyDiscussions: =>
    return [] if !@timestamp()?

    if !@nearbyDiscussionsCache? || (@nearbyDiscussionsCache.beatmap != @props.currentBeatmap || @nearbyDiscussionsCache.timestamp != @timestamp())
      @nearbyDiscussionsCache =
        beatmap: @props.currentBeatmap
        timestamp: @timestamp()
        discussions: BeatmapDiscussionHelper.nearbyDiscussions(@props.currentDiscussions.timelineAllUsers, @timestamp())

    @nearbyDiscussionsCache.discussions


  onFocus: =>
    @setSticky true


  post: (e) =>
    return unless @validPost()

    type = e.currentTarget.dataset.type

    if type == 'problem'
      problemType = @problemType()

      if problemType != 'problem'
        return unless confirm(osu.trans("beatmaps.nominations.reset_confirm.#{problemType}"))

    if type == 'hype'
      return unless confirm(osu.trans('beatmaps.hype.confirm', n: @props.beatmapset.current_user_attributes.remaining_hype))

    @postXhr?.abort()
    showLoadingOverlay()
    @setState posting: type

    data =
      beatmapset_id: @props.currentBeatmap.beatmapset_id
      beatmap_discussion:
        message_type: type
        timestamp: @timestamp()
        beatmap_id: @props.currentBeatmap.id unless @props.mode == 'generalAll'
      beatmap_discussion_post:
        message: @state.message

    @postXhr = $.ajax laroute.route('beatmapsets.discussions.posts.store'),
      method: 'POST'
      data: data

    .done (data) =>
      @setState
        message: ''
        timestampConfirmed: false

      $.publish 'beatmapDiscussionPost:markRead', id: data.beatmap_discussion_post_id
      $.publish 'beatmapsetDiscussions:update', beatmapset: data.beatmapset

    .fail osu.ajaxError

    .always =>
      hideLoadingOverlay()
      @setState posting: null


  problemType: =>
    canDisqualify = currentUser.is_admin || currentUser.is_moderator || currentUser.is_full_bn
    willDisqualify = @props.beatmapset.status == 'qualified'

    return 'disqualify' if canDisqualify && willDisqualify

    canReset = currentUser.is_admin || currentUser.is_nat || currentUser.is_bng
    currentNominations = nominationsCount(@props.beatmapset.nominations, 'current')
    willReset = @props.beatmapset.status == 'pending' && currentNominations > 0

    return 'nomination_reset' if canReset && willReset

    'problem'


  setMessage: (e) =>
    @setState message: e.currentTarget.value


  # TODO: to whoever refactors this - this 'sticky' behaviour was ported to new-review.tsx, so remember to refactor that too
  setSticky: (sticky = true) =>
    @setState
      cssTop: @cssTop(sticky)

    @props.setPinned?(sticky)


  setTop: =>
    @setState
      cssTop: @cssTop(@props.pinned)


  submitButton: (type, extraProps) =>
    typeText = if type == 'problem' then @problemType() else type

    el BigButton,
      key: type
      disabled: !@validPost() || @state.posting? || !@canPost()
      icon: discussionTypeIcons[type]
      isBusy: @state.posting == type
      modifiers: 'beatmap-discussion-new'
      text: osu.trans("beatmaps.discussions.message_type.#{typeText}")
      props: _.merge
        'data-type': type
        onClick: @post
        extraProps


  timestamp: =>
    return unless @props.mode == 'timeline'

    if @timestampCache?.message != @state.message
      @timestampCache = null

    if !@timestampCache?
      @timestampCache =
        message: @state.message
        timestamp: BeatmapDiscussionHelper.parseTimestamp(@state.message)

    @timestampCache.timestamp


  toggleSticky: =>
    @setSticky(!@props.pinned)


  toggleTimestampConfirmation: =>
    @setState timestampConfirmed: !@state.timestampConfirmed


  validPost: =>
    return false if !BeatmapDiscussionHelper.validMessageLength(@state.message, @isTimeline())

    if @isTimeline()
      @timestamp()? && (@nearbyDiscussions().length == 0 || @state.timestampConfirmed)
    else
      true
