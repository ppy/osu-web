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

{button, div, input, label, p, span} = ReactDOMFactories
el = React.createElement

bn = 'beatmap-discussion-new'

class BeatmapDiscussions.NewDiscussion extends React.PureComponent
  constructor: (props) ->
    super props

    @throttledPost = _.throttle @post, 1000
    @cache = {}

    @state =
      message: ''
      timestamp: null
      timestampConfirmed: false
      posting: null
      stickable: false
      sticky: false


  componentDidMount: =>
    $.subscribe 'stickyHeader.newDiscussion', @checkStickability


  componentWillUpdate: =>
    @cache = {}


  componentWillUnmount: =>
    @postXhr?.abort()
    @throttledPost.cancel()
    $.unsubscribe '.newDiscussion'


  render: =>
    topClass = 'beatmap-discussion-new-float js-sync-height--target'
    topClass += ' beatmap-discussion-new-float--floating' if @isSticky()

    div
      className: topClass
      'data-sync-height-id': 'new-discussion-box'
      div className: 'beatmap-discussion-new-float__floatable',
        div
          className: 'js-sync-height--target beatmap-discussion-new-float__spacer'
          'data-sync-height-id': 'page-extra-tabs'
        div
          className: 'js-new-discussion js-sync-height--reference beatmap-discussion-new-float__content'
          'data-sync-height-target': 'new-discussion-box'
          @renderBox()

  renderBox: =>
    canHype =
      @props.beatmapset.current_user_attributes?.can_hype &&
      @props.beatmapset.can_be_hyped &&
      @props.mode == 'generalAll'

    div
      className: 'osu-page osu-page--small'
      div
        className: bn
        div className: "page-title",
          osu.trans('beatmaps.discussions.new.title')

          span className: 'page-title__button',
            span
              className: "btn-circle #{'btn-circle--activated' if @state.sticky}"
              onClick: @toggleSticky
              span className: 'btn-circle__content',
                el Icon, name: 'thumb-tack'

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
                  value: @state.message
                  onChange: @setMessage
                  onKeyDown: @handleEnter
                  onFocus: @setSticky
                  placeholder:
                    if @canPost()
                      osu.trans 'beatmaps.discussions.message_placeholder'
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
            if @props.currentUser.id == @props.beatmapset.user_id
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
                  el Icon, name: 'check'

              osu.trans('beatmap_discussions.nearby_posts.confirm')


  canPost: =>
    !@props.currentBeatmap.deleted_at?


  checkStickability: (_e, target) =>
    # depends on ModeSwitcher
    newState = (target == 'page-extra-tabs')
    @setState(stickable: newState) if newState != @state.stickable


  handleEnter: (e) =>
    return if e.keyCode != 13 || e.shiftKey

    e.preventDefault()


  isSticky: =>
    @state.stickable && @state.sticky


  nearbyDiscussions: =>
    return [] if !@state.timestamp?

    if !@cache.nearbyDiscussions? || @cache.nearbyDiscussions.timestamp != @state.timestamp
      discussions = []

      for discussion in @props.currentDiscussions.timeline
        continue if discussion.message_type not in ['suggestion', 'problem']
        continue if Math.abs(discussion.timestamp - @state.timestamp) > 5000

        if discussion.user_id == @props.currentUser.id
          continue if moment(discussion.updated_at).diff(moment(), 'hour') > -24

        discussions.push discussion

      @cache.nearbyDiscussions =
        timestamp: @state.timestamp
        discussions: discussions

    @cache.nearbyDiscussions.discussions


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

    if @props.beatmapset.status == 'pending' && type == 'problem' && @props.beatmapset.nominations.current > 0 && userCanResetNominations
      return unless confirm(osu.trans('beatmaps.nominations.reset_confirm'))

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


  setMessage: (e) =>
    message = e.currentTarget.value
    timestamp = @parseTimestamp(message) if @props.mode == 'timeline'

    @setState {message, timestamp}


  setSticky: =>
    @setState sticky: true if !@state.sticky


  setTimestamp: (e) =>
    @setState timestamp: e.currentTarget.value


  submitButton: (type, extraProps) =>
    icon =
      if @state.posting == type
        # for some reason the spinner wobbles
        'ellipsis-h'
      else
        BeatmapDiscussionHelper.messageType.icon[_.camelCase(type)]

    el BigButton,
      modifiers: ['beatmap-discussion']
      icon: icon
      text: osu.trans("beatmaps.discussions.message_type.#{type}")
      key: type
      props: _.merge
          disabled: !@validPost() || @state.posting?
          'data-type': type
          onClick: @post
          extraProps


  toggleSticky: =>
    @setState sticky: !@state.sticky


  toggleTimestampConfirmation: =>
    @setState timestampConfirmed: !@state.timestampConfirmed


  validPost: =>
    return false if !BeatmapDiscussionHelper.validMessageLength(@state.message)

    if @props.mode == 'timeline'
      @state.timestamp? && (@nearbyDiscussions().length == 0 || @state.timestampConfirmed)
    else
      true
