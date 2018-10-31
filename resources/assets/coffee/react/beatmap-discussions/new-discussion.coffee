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

{button, div, input, label, p, i, span} = ReactDOMFactories
el = React.createElement

bn = 'beatmap-discussion-new'

class BeatmapDiscussions.NewDiscussion extends React.PureComponent
  constructor: (props) ->
    super props

    @throttledPost = _.throttle @post, 1000
    @handleKeyDown = InputHandler.textarea @handleKeyDownCallback
    @cache = {}

    # FIXME: should save state on navigation?
    @state =
      cssTop: null
      message: ''
      timestamp: null
      timestampConfirmed: false
      posting: null


  componentDidMount: =>
    $(window).on 'throttled-resize.new-discussion', @setTop


  componentWillUpdate: =>
    @cache = {}


  componentWillUnmount: =>
    $(window).off '.new-discussion'
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
      @props.currentUser.is_bng ||
      @props.currentUser.is_qat

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
              span className: 'btn-circle__content',
                i className: 'fas fa-thumbtack'

        div className: "#{bn}__content",
          div
            className: "#{bn}__avatar"
            el UserAvatar, user: @props.currentUser, modifiers: ['full-rounded']

          div className: "#{bn}__message",
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
                  placeholder:
                    if @canPost()
                      osu.trans "beatmaps.discussions.message_placeholder.#{@props.mode}", version: @props.currentBeatmap.version
                    else
                      # FIXME: reason should be passed from beatmap state
                      osu.trans 'beatmaps.discussions.message_placeholder_deleted_beatmap'

                el BeatmapDiscussions.MessageLengthCounter,
                  key: 'counter'
                  message: @state.message
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
                if @state.timestamp?
                  BeatmapDiscussionHelper.formatTimestamp @state.timestamp
                else
                  osu.trans 'beatmaps.discussions.new.timestamp_missing'
              else if @props.beatmapset.can_be_hyped # mode == 'generalAll'
                if @props.currentUser.id?
                  message =
                    if @props.beatmapset.current_user_attributes.can_hype
                      osu.trans 'beatmaps.hype.explanation'
                    else
                      @props.beatmapset.current_user_attributes.can_hype_reason

                  if @props.beatmapset.current_user_attributes.can_hype || @props.beatmapset.current_user_attributes.remaining_hype <= 0
                    message += " #{osu.trans 'beatmaps.hype.remaining', remaining: @props.beatmapset.current_user_attributes.remaining_hype}"
                    if @props.beatmapset.current_user_attributes.new_hype_time?
                      message += " #{osu.trans 'beatmaps.hype.new_time', new_time: osu.timeago(@props.beatmapset.current_user_attributes.new_hype_time)}"

                  span dangerouslySetInnerHTML:
                    __html: message
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
          currentTimestamp = BeatmapDiscussionHelper.formatTimestamp @state.timestamp
          timestamps =
            for discussion in @nearbyDiscussions()
              osu.link BeatmapDiscussionHelper.url(discussion: discussion),
                BeatmapDiscussionHelper.formatTimestamp(discussion.timestamp)
                classNames: ['js-beatmap-discussion--jump', "#{bn}__notice-link"]
          timestampsString = osu.transArray(timestamps)

          div className: "#{bn}__notice",
            div
              className: "#{bn}__notice-text"
              dangerouslySetInnerHTML:
                __html: osu.trans 'beatmap_discussions.nearby_posts.notice',
                  timestamp: currentTimestamp
                  existing_timestamps: timestampsString

            label className: "#{bn}__notice-checkbox",
              div className: 'osu-checkbox osu-checkbox--beatmap-discussion',
                input
                  className: 'osu-checkbox__input'
                  type: 'checkbox'
                  checked: @state.timestampConfirmed
                  onChange: @toggleTimestampConfirmation

                span className: 'osu-checkbox__box'
                span className: 'osu-checkbox__tick',
                  i className: 'fas fa-check'

              osu.trans('beatmap_discussions.nearby_posts.confirm')


  canPost: =>
    !@props.currentBeatmap.deleted_at? || @props.mode == 'generalAll'


  cssTop: (sticky) =>
    return if !sticky || !@props.stickTo?.current?
    window.stickyHeader.headerHeight() + @props.stickTo.current.getBoundingClientRect().height


  handleKeyDownCallback: (type, event) =>
    # Ignores SUBMIT, requiring shift-enter to add new line.
    switch type
      when InputHandler.CANCEL
        @setSticky(false)


  nearbyDiscussions: =>
    return [] if !@state.timestamp?

    if !@cache.nearbyDiscussions? || @cache.nearbyDiscussions.timestamp != @state.timestamp
      discussions = {}

      for discussion in @props.currentDiscussions.timelineAllUsers
        continue if discussion.message_type not in ['suggestion', 'problem']

        distance = Math.abs(discussion.timestamp - @state.timestamp)

        continue if distance > 5000

        if discussion.user_id == @props.currentUser.id
          continue if moment(discussion.updated_at).diff(moment(), 'hour') > -24

        category = switch
          when distance == 0 then 'd0'
          when distance < 100 then 'd100'
          when distance < 1000 then 'd1000'
          else 'other'

        discussions[category] ?= []
        discussions[category].push discussion

      shownDiscussions = discussions.d0 ? discussions.d100 ? discussions.d1000 ? discussions.other ? []

      @cache.nearbyDiscussions =
        timestamp: @state.timestamp
        discussions: _.sortBy shownDiscussions, 'timestamp'

    @cache.nearbyDiscussions.discussions


  onFocus: =>
    @setSticky true


  parseTimestamp: (message) =>
    timestampRe = message.match /\b(\d{2,}):([0-5]\d)[:.](\d{3})\b/

    if timestampRe?
      timestamp = timestampRe.slice(1).map (x) => parseInt x, 10

      # this isn't all that smart
      (timestamp[0] * 60 + timestamp[1]) * 1000 + timestamp[2]


  post: (e) =>
    return unless @validPost()

    type = e.currentTarget.dataset.type

    userCanResetNominations = currentUser.is_admin || currentUser.is_qat || currentUser.is_bng

    if type == 'problem'
      problemType = @problemType()

      if problemType != 'problem'
        return unless confirm(osu.trans("beatmaps.nominations.reset_confirm.#{problemType}"))

    if type == 'hype'
      return unless confirm(osu.trans('beatmaps.hype.confirm', n: @props.beatmapset.current_user_attributes.remaining_hype))

    @postXhr?.abort()
    LoadingOverlay.show()
    @setState posting: type

    data =
      beatmapset_id: @props.currentBeatmap.beatmapset_id
      beatmap_discussion:
        message_type: type
        timestamp: @state.timestamp
        beatmap_id: @props.currentBeatmap.id unless @props.mode == 'generalAll'
      beatmap_discussion_post:
        message: @state.message

    @postXhr = $.ajax laroute.route('beatmap-discussion-posts.store'),
      method: 'POST'
      data: data

    .done (data) =>
      @setState
        message: ''
        timestamp: null

      $.publish 'beatmapDiscussionPost:markRead', id: data.beatmap_discussion_post_id
      $.publish 'beatmapsetDiscussions:update', beatmapset: data.beatmapset

    .fail osu.ajaxError

    .always =>
      LoadingOverlay.hide()
      @setState posting: null


  problemType: =>
    canDisqualify = currentUser.is_admin || currentUser.is_qat
    willDisqualify = @props.beatmapset.status == 'qualified'

    return 'disqualify' if canDisqualify && willDisqualify

    canReset = currentUser.is_admin || currentUser.is_qat || currentUser.is_bng
    willReset = @props.beatmapset.status == 'pending' && @props.beatmapset.nominations.current > 0

    return 'nomination_reset' if canReset && willReset

    'problem'


  setMessage: (e) =>
    message = e.currentTarget.value
    timestamp = @parseTimestamp(message) if @props.mode == 'timeline'

    @setState {message, timestamp}


  setSticky: (sticky = true) =>
    @setState
      cssTop: @cssTop(sticky)

    @props.setPinned?(sticky)


  setTop: =>
    @setState
      cssTop: @cssTop(@props.pinned)


  setTimestamp: (e) =>
    @setState timestamp: e.currentTarget.value


  submitButton: (type, extraProps) =>
    icon =
      if @state.posting == type
        # for some reason the spinner wobbles
        '_spinner'
      else
        BeatmapDiscussionHelper.messageType.icon[_.camelCase(type)]

    typeText = if type == 'problem' then @problemType() else type

    el BigButton,
      modifiers: ['beatmap-discussion']
      icon: icon
      text: osu.trans("beatmaps.discussions.message_type.#{typeText}")
      key: type
      props: _.merge
          disabled: !@validPost() || @state.posting? || !@canPost()
          'data-type': type
          onClick: @post
          extraProps


  toggleSticky: =>
    @setSticky(!@props.pinned)


  toggleTimestampConfirmation: =>
    @setState timestampConfirmed: !@state.timestampConfirmed


  validPost: =>
    return false if !BeatmapDiscussionHelper.validMessageLength(@state.message)

    if @props.mode == 'timeline'
      @state.timestamp? && (@nearbyDiscussions().length == 0 || @state.timestampConfirmed)
    else
      true
