###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

import * as React from 'react'
import { a, div, li, span, ul } from 'react-dom-factories'
el = React.createElement

export class ModeSwitcher extends React.PureComponent
  constructor: (props) ->
    super props


  render: =>
    [
      div
        className: 'page-extra-tabs-before'
        key: 'page-extra-tabs-before'

      div
        className: 'page-extra-tabs'
        key: 'page-extra-tabs'
        ref: @props.innerRef

        div className: 'osu-page',
          ul className: 'page-mode page-mode--page-extra-tabs',
            for mode in ['generalAll', 'general', 'timeline', 'events']
              li
                key: mode
                className: 'page-mode__item'
                a
                  className: "page-mode-link #{if @props.mode == mode then 'page-mode-link--is-active' else ''}"
                  onClick: @switch
                  href: BeatmapDiscussionHelper.url
                    mode: mode
                    beatmapId: @props.currentBeatmap.id
                    beatmapsetId: @props.beatmapset.id
                  'data-mode': mode
                  div
                    dangerouslySetInnerHTML:
                      __html:
                        if _.startsWith(mode, 'general')
                          osu.trans "beatmaps.discussions.mode.general",
                            scope: "<span class='page-mode-link__subtitle'>(#{osu.trans("beatmaps.discussions.mode.scopes.#{mode}")})</span>"
                        else
                          osu.trans("beatmaps.discussions.mode.#{_.snakeCase mode}")
                  if mode != 'events'
                    span className: 'page-mode-link__badge',
                      _.size(@props.currentDiscussions.byFilter[@props.currentFilter][mode])
                  span className: 'page-mode-link__stripe'
    ]


  switch: (e) =>
    e.preventDefault()

    $.publish 'beatmapsetDiscussions:update', mode: e.currentTarget.dataset.mode
