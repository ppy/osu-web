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

{div,a,i,span} = React.DOM
el = React.createElement

class @BeatmapsetPanel extends React.PureComponent
  constructor: (props) ->
    super props

    @eventId = "beatmapsetPanel-#{props.beatmap.beatmapset_id}-#{osu.generateId()}"

    @state =
      preview: 'ended'
      previewDuration: 0


  componentDidMount: =>
    $.subscribe "osuAudio:initializing.#{@eventId}", @previewInitializing
    $.subscribe "osuAudio:playing.#{@eventId}", @previewStart
    $.subscribe "osuAudio:ended.#{@eventId}", @previewStop
    $(document).on "turbolinks:before-cache.#{@eventId}", @componentWillUnmount


  componentWillUnmount: =>
    $.unsubscribe ".#{@eventId}"
    $(document).off ".#{@eventId}"


  render: =>
    # this is actually "beatmapset"
    beatmapset = @props.beatmap

    # arbitrary number
    maxDisplayedDifficulty = 10

    difficulties = beatmapset.beatmaps[..maxDisplayedDifficulty - 1].map (b) =>
      div
        className: 'beatmapset-panel__difficulty-icon'
        key: b.id
        el BeatmapIcon, beatmap: b

    if beatmapset.beatmaps.length > maxDisplayedDifficulty
      difficulties.push span key: 'over', "+#{(beatmapset.beatmaps.length - maxDisplayedDifficulty)}"

    div
      className: "beatmapset-panel #{'beatmapset-panel--previewing' if @state.preview != 'ended'}"
      div className: 'beatmapset-panel__panel',
        div className: 'beatmapset-panel__header',
          a
            href: laroute.route('beatmapsets.show', beatmapset: beatmapset.id)
            className: 'beatmapset-panel__thumb'
            style:
              backgroundImage: "url(#{beatmapset.covers.card})"

            div className: 'beatmapset-panel__title-artist-box',
              div className: 'u-ellipsis-overflow beatmapset-panel__header-text beatmapset-panel__header-text--title',
                beatmapset.title
              div className: 'beatmapset-panel__header-text',
                beatmapset.artist

            div className: 'beatmapset-panel__counts-box',
              div className: 'beatmapset-panel__count',
                span className: 'beatmapset-panel__count-number', beatmapset.play_count
                el Icon, name: 'play-circle', modifiers: ['fw']

              div className: 'beatmapset-panel__count',
                span className: 'beatmapset-panel__count-number', beatmapset.favourite_count
                el Icon, name: 'heart', modifiers: ['fw']

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
                    osu.trans 'beatmaps.listing.mapped-by',
                      mapper:
                        laroute.link_to_route 'users.show',
                          beatmapset.creator
                          user: beatmapset.user_id
              div
                className: 'u-ellipsis-overflow'
                beatmapset.source

            div className: 'beatmapset-panel__icons-box',
              a
                href: Url.beatmapDownload(beatmapset.id)
                className: 'beatmapset-panel__icon'
                el Icon, name: 'download'

          div className: 'beatmapset-panel__difficulties', difficulties
      a
        href: '#'
        className: 'beatmapset-panel__play js-audio--play'
        'data-audio-url': beatmapset.previewUrl
        el Icon, name: if @state.preview == 'ended' then 'play' else 'stop'
      div className: 'beatmapset-panel__shadow'


  previewInitializing: (_e, {url, player}) =>
    if url != @props.beatmap.previewUrl
      return @previewStop()

    @setState
      preview: 'initializing'
      previewDuration: 0


  previewStart: (_e, {url, player}) =>
    if url != @props.beatmap.previewUrl
      return @previewStop()

    @setState
      preview: 'playing'
      previewDuration: player.duration


  previewStop: =>
    return if @state.preview == 'ended'

    @setState
      preview: 'ended'
      previewDuration: 0
