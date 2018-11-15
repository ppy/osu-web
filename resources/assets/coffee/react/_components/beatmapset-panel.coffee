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

{div,a,i,span} = ReactDOMFactories
el = React.createElement

class @BeatmapsetPanel extends React.PureComponent
  constructor: (props) ->
    super props

    @eventId = "beatmapsetPanel-#{props.beatmap.beatmapset_id}-#{osu.uuid()}"

    @state =
      preview: 'ended'
      previewDuration: 0


  componentDidMount: =>
    $.subscribe "osuAudio:initializing.#{@eventId}", @previewInitializing
    $.subscribe "osuAudio:playing.#{@eventId}", @previewStart
    $.subscribe "osuAudio:ended.#{@eventId}", @previewStop
    $(document).on "turbolinks:before-cache.#{@eventId}", @componentWillUnmount


  componentWillUnmount: =>
    @previewStop()
    $.unsubscribe ".#{@eventId}"
    $(document).off ".#{@eventId}"


  hideImage: (e) ->
    # hides img elements that have errored (hides native browser broken-image icons)
    e.currentTarget.style.display = 'none'


  render: =>
    # this is actually "beatmapset"
    beatmapset = @props.beatmap

    showHypeCounts = _.includes ['wip', 'pending', 'graveyard'], beatmapset.status
    if showHypeCounts
      currentHype = beatmapset.hype.current.toLocaleString()
      requiredHype = beatmapset.hype.required.toLocaleString()
      currentNominations = beatmapset.nominations.current.toLocaleString()
      requiredNominations = beatmapset.nominations.required.toLocaleString()

    # arbitrary number
    maxDisplayedDifficulty = 10

    condenseDifficulties = beatmapset.beatmaps.length > maxDisplayedDifficulty

    groupedBeatmaps = BeatmapHelper.group beatmapset.beatmaps

    difficulties =
      for mode in BeatmapHelper.modes
        beatmaps = groupedBeatmaps[mode]

        continue unless beatmaps?

        if condenseDifficulties
          [
            el BeatmapIcon, key: "#{mode}-icon", beatmap: _.last(beatmaps), showTitle: false
            span
              className: 'beatmapset-panel__difficulty-count'
              key: "#{mode}-count", beatmaps.length
          ]
        else
          for b in beatmaps
            div
              className: 'beatmapset-panel__difficulty-icon'
              key: b.id
              el BeatmapIcon, beatmap: b

    div
      className: "beatmapset-panel#{if @state.preview != 'ended' then ' beatmapset-panel--previewing' else ''}"
      div className: 'beatmapset-panel__panel',
        a
          href: laroute.route('beatmapsets.show', beatmapset: beatmapset.id)
          className: 'beatmapset-panel__header',
          el Img2x,
            className: 'beatmapset-panel__image'
            onError: @hideImage
            src: beatmapset.covers.card
          div className: 'beatmapset-panel__image-overlay'
          div className: 'beatmapset-panel__status-container',
            if beatmapset.video or beatmapset.storyboard
              div className: 'beatmapset-panel__video-icon',
                i className: 'fas fa-film fa-fw'
            div className: 'beatmapset-status', beatmapset.status

          div className: 'beatmapset-panel__title-artist-box',
            div className: 'u-ellipsis-overflow beatmapset-panel__header-text beatmapset-panel__header-text--title',
              beatmapset.title
            div className: 'beatmapset-panel__header-text',
              beatmapset.artist

          div className: 'beatmapset-panel__counts-box',
            if showHypeCounts
              div null,
                div className: 'beatmapset-panel__count', title: osu.trans('beatmaps.hype.required_text', {current: currentHype, required: requiredHype}),
                  span className: 'beatmapset-panel__count-number', currentHype
                  i className: 'fas fa-bullhorn fa-fw'
                div className: 'beatmapset-panel__count', title: osu.trans('beatmaps.nominations.required_text', {current: currentNominations, required: requiredNominations}),
                  span className: 'beatmapset-panel__count-number', currentNominations
                  i className: 'fas fa-thumbs-up fa-fw'
            else
              div className: 'beatmapset-panel__count',
                span className: 'beatmapset-panel__count-number', beatmapset.play_count.toLocaleString()
                i className: 'fas fa-fw fa-play-circle'

            div className: 'beatmapset-panel__count',
              span className: 'beatmapset-panel__count-number', beatmapset.favourite_count.toLocaleString()
              i className: 'fas fa-fw fa-heart'

          div
            className: 'beatmapset-panel__preview-bar'
            style:
              transitionDuration: "#{@state.previewDuration}s"
              width: "#{if @state.preview == 'playing' then '100%' else 0}"

        div className: 'beatmapset-panel__content',
          div className: 'beatmapset-panel__row',
            div className: 'beatmapset-panel__mapper-source-box',
              div
                className: 'u-ellipsis-overflow'
                dangerouslySetInnerHTML:
                  __html:
                    osu.trans 'beatmapsets.show.details.mapped_by',
                      mapper:
                        laroute.link_to_route 'users.show',
                            beatmapset.creator,
                            user: beatmapset.user_id,
                              'class': 'js-usercard'
                              'data-user-id': beatmapset.user_id
              div
                className: 'u-ellipsis-overflow'
                if beatmapset.status in ['graveyard', 'wip', 'pending']
                  span dangerouslySetInnerHTML: __html:
                    osu.trans 'beatmapsets.show.details.updated_timeago',
                      timeago: osu.timeago(beatmapset.last_updated)
                else
                  beatmapset.source

            div className: 'beatmapset-panel__icons-box',
              if currentUser?.id
                a
                  href: laroute.route 'beatmapsets.download', beatmapset: beatmapset.id
                  className: 'beatmapset-panel__icon js-beatmapset-download-link'
                  'data-turbolinks': 'false'
                  i className: 'fas fa-download'

          div className: 'beatmapset-panel__difficulties', difficulties
      a
        href: '#'
        className: 'beatmapset-panel__play js-audio--play'
        'data-audio-url': beatmapset.preview_url
        i className: "fas fa-#{if @state.preview == 'ended' then 'play' else 'stop'}"
      div className: 'beatmapset-panel__shadow'


  previewInitializing: (_e, {url, player}) =>
    if url != @props.beatmap.preview_url
      return @previewStop()

    @setState
      preview: 'initializing'
      previewDuration: 0


  previewStart: (_e, {url, player}) =>
    if url != @props.beatmap.preview_url
      return @previewStop()

    @setState
      preview: 'playing'
      previewDuration: player.duration


  previewStop: =>
    return if @state.preview == 'ended'

    @setState
      preview: 'ended'
      previewDuration: 0
