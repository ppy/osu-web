###
# Copyright 2015-2016 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License version 3
# as published by the Free Software Foundation.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###

{a, div, li, span, ul} = React.DOM
el = React.createElement

BeatmapDiscussions.ModeSwitcher = React.createClass
  mixins: [StickyTabsMixin]


  componentDidMount: ->
    $.subscribe 'stickyHeader.beatmapDiscussionsMode', @_tabsStick


  componentWillUnmount: ->
    $.unsubscribe '.beatmapDiscussionsMode'


  getInitialState: ->
    tabsSticky: false


  render: ->
    div null,
      div
        className: "beatmap-discussions-mode #{'beatmap-discussions-mode--floating' if @state.tabsSticky}"

        div
          className: 'js-sticky-header'
          'data-sticky-header-target': 'page-extra-tabs'

        div
          className: 'beatmap-discussions-mode__padding js-sync-height--target'
          'data-sync-height-id': 'beatmap-discussions-mode'
          'data-sticky-header-target': 'page-extra-tabs'

        div
          className: 'beatmap-discussions-mode__floatable js-sync-height--reference js-mode-switcher'
          'data-sync-height-target': 'beatmap-discussions-mode'
          div className: 'osu-page',
            ul className: 'page-mode page-mode--beatmap-discussions-mode',
              for mode in ['general', 'timeline']
                li
                  key: mode
                  className: 'page-mode__item'
                  a
                    className: "page-mode-link #{'page-mode-link--is-active' if @props.mode == mode}"
                    onClick: @switch
                    href: '#'
                    'data-mode': mode
                    osu.trans("beatmaps.discussions.mode.#{mode}")
                    span className: 'page-mode-link__stripe'


  switch: (e) ->
    e.preventDefault()

    $.publish 'beatmapDiscussion:setMode', e.currentTarget.dataset.mode
