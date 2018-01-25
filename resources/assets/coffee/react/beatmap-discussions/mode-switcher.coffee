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

{a, div, li, span, ul} = ReactDOMFactories
el = React.createElement

class BeatmapDiscussions.ModeSwitcher extends React.PureComponent
  constructor: (props) ->
    super props

    @state =
      tabsSticky: false


  componentDidMount: =>
    $.subscribe 'stickyHeader.beatmapDiscussionsMode', @tabsStick
    osu.pageChange()


  componentWillUnmount: =>
    $.unsubscribe '.beatmapDiscussionsMode'


  render: =>
    div
      className: "page-extra-tabs #{'page-extra-tabs--floating' if @state.tabsSticky}"

      div
        className: 'js-sticky-header'
        'data-sticky-header-target': 'page-extra-tabs'

      div
        className: 'page-extra-tabs__padding js-sync-height--target'
        'data-sync-height-id': 'page-extra-tabs'
        'data-sticky-header-target': 'page-extra-tabs'

      div
        className: 'page-extra-tabs__floatable js-sync-height--reference js-mode-switcher'
        'data-sync-height-target': 'page-extra-tabs'
        div className: 'osu-page',
          ul className: 'page-mode page-mode--page-extra-tabs',
            for mode in ['generalAll', 'general', 'timeline', 'events']
              li
                key: mode
                className: 'page-mode__item'
                a
                  className: "page-mode-link #{'page-mode-link--is-active' if @props.mode == mode}"
                  onClick: @switch
                  href: BeatmapDiscussionHelper.url
                    mode: mode
                    beatmapId: @props.currentBeatmap.id
                    beatmapsetId: @props.beatmapset.id
                  'data-mode': mode
                  osu.trans("beatmaps.discussions.mode.#{_.snakeCase mode}")
                  if mode != 'events'
                    span className: 'page-mode-link__badge',
                      _.size(@props.currentDiscussions.byFilter[@props.currentFilter][mode])
                  span className: 'page-mode-link__stripe'


  tabsStick: (_e, target) =>
    newState = (target == 'page-extra-tabs')
    @setState(tabsSticky: newState) if newState != @state.tabsSticky


  switch: (e) =>
    e.preventDefault()

    $.publish 'beatmapsetDiscussions:update', mode: e.currentTarget.dataset.mode
