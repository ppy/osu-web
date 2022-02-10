# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import StringWithComponent from 'components/string-with-component'
import { snakeCase, size } from 'lodash'
import * as React from 'react'
import { a, div, li, span, ul } from 'react-dom-factories'

el = React.createElement

export class ModeSwitcher extends React.PureComponent
  selectedClassName: 'page-mode-link--is-active'

  constructor: (props) ->
    super props

    @scrollerRef = React.createRef()

  componentDidMount: =>
    @scrollModeSwitcher()

  componentDidUpdate: =>
    @scrollModeSwitcher()

  render: =>
    modes = ['reviews', 'generalAll', 'general', 'timeline', 'events']

    [
      div
        className: 'page-extra-tabs-before'
        key: 'page-extra-tabs-before'

      div
        className: 'page-extra-tabs'
        key: 'page-extra-tabs'
        ref: @props.innerRef

        div className: 'osu-page osu-page--small',
          ul
            className: 'page-mode page-mode--page-extra-tabs',
            ref: @scrollerRef

            for mode in modes
              li
                key: mode
                className: 'page-mode__item'
                a
                  className: "page-mode-link #{if @props.mode == mode then @selectedClassName else ''}"
                  onClick: @switch
                  href: BeatmapDiscussionHelper.url
                    mode: mode
                    beatmapId: @props.currentBeatmap.id
                    beatmapsetId: @props.beatmapset.id
                  'data-mode': mode
                  div null,
                    if mode == 'general'
                      el StringWithComponent,
                        pattern: osu.trans('beatmaps.discussions.mode.general'),
                        mappings:
                          scope:
                            span
                              className: 'page-mode-link__subtitle'
                              "(#{@props.currentBeatmap.version})"

                    else if mode == 'generalAll'
                      el StringWithComponent,
                        pattern: osu.trans('beatmaps.discussions.mode.general'),
                        mappings:
                          scope:
                            span
                              className: 'page-mode-link__subtitle'
                              "(#{osu.trans('beatmaps.discussions.mode.scopes.generalAll')})"

                    else
                      osu.trans("beatmaps.discussions.mode.#{snakeCase mode}")

                  if mode != 'events'
                    span className: 'page-mode-link__badge',
                      size(@props.currentDiscussions.byFilter[@props.currentFilter][mode])
                  span className: 'page-mode-link__stripe'
    ]

  scrollModeSwitcher: =>
    return if !@scrollerRef.current?

    # on mobile, ModeSwitcher becomes horizontally scrollable - scrollTo ensures that the selected tab is made visible
    $(@scrollerRef.current).scrollTo(".#{@selectedClassName}", 0, {over: {left: -1}})

  switch: (e) =>
    e.preventDefault()

    $.publish 'beatmapsetDiscussions:update', mode: e.currentTarget.dataset.mode
