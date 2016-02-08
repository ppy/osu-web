###
# Copyright 2015 ppy Pty. Ltd.
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
{div} = React.DOM
el = React.createElement

class ProfilePage.Extra extends React.Component
  constructor: (props) ->
    super props

    @state =
      tabsSticky: false


  componentDidMount: =>
    @_removeListeners()
    $.subscribe 'profilePageExtra:tab.profileContentsExtra', @_modeSwitch
    $.subscribe 'stickyHeader.profileContentsExtra', @_tabsStick
    $(window).on 'throttled-scroll.profileContentsExtra', @_modeScan
    osu.pageChange()
    @_modeScan()


  componentWillUnmount: =>
    @_removeListeners()


  componentWillReceiveProps: =>
    osu.pageChange()


  _modeScan: =>
    elements = document.getElementsByClassName('js-profile-page-extra--scrollspy')
    return unless elements.length

    for page in elements by -1
      continue unless page.getBoundingClientRect().top <= 0

      @setState mode: page.getAttribute('id')

      return

    @setState mode: page.getAttribute('id')


  _modeSwitch: (_e, mode) =>
    $.scrollTo "##{mode}", 500,
      onAfter: => @setState mode: mode


  _removeListeners: ->
    $.unsubscribe '.profileContentsExtra'
    $(window).off '.profileContentsExtra'


  _tabsStick: (_e, target) =>
    @setState tabsSticky: (target == 'profile-extra-tabs')


  render: =>
    return if @props.mode == 'me'

    withMePage = @props.userPage.html != '' || @props.withEdit

    pages = ['recent_activities', 'kudosu', 'top_ranks', 'beatmaps', 'medals', 'historical']
    pages.unshift 'me' if withMePage

    tabsContainerClasses = 'profile-extra-tabs__container js-fixed-element'
    tabsClasses = 'profile-extra-tabs__items'
    if @state.tabsSticky
      tabsContainerClasses += ' profile-extra-tabs__container--fixed js-sticky-header--active'
      tabsClasses += ' profile-extra-tabs__items--fixed'

    div className: 'osu-layout__section osu-layout__section--extra',
      div
        className: 'profile-extra-tabs js-sticky-header'
        'data-sticky-header-target': 'profile-extra-tabs'
        div
          className: tabsContainerClasses
          div className: 'osu-layout__row',
            div
              className: tabsClasses
              'data-sticky-header-id': 'profile-extra-tabs'
              pages.map (m) =>
                el ProfilePage.ExtraTab, key: m, mode: m, currentMode: @state.mode

      if withMePage
        div className: 'osu-layout__row',
          el ProfilePage.UserPage, userPage: @props.userPage, withEdit: @props.withEdit, user: @props.user

      div className: 'osu-layout__row',
        el ProfilePage.RecentActivities, recentActivities: @props.recentActivities

      div className: 'osu-layout__row',
        el ProfilePage.Kudosu, user: @props.user, recentlyReceivedKudosu: @props.recentlyReceivedKudosu

      div className: 'osu-layout__row',
        el ProfilePage.TopRanks, user: @props.user, scoresBest: @props.scoresBest, scoresFirst: @props.scoresFirst

      div className: 'osu-layout__row',
        el ProfilePage.Beatmaps,
          favouriteBeatmapSets: @props.favouriteBeatmapSets
          rankedAndApprovedBeatmapSets: @props.rankedAndApprovedBeatmapSets

      div className: 'osu-layout__row',
        el ProfilePage.Medals, achievements: @props.achievements, allAchievements: @props.allAchievements

      div className: 'osu-layout__row',
        el ProfilePage.Historical,
          beatmapPlaycounts: @props.beatmapPlaycounts
          rankHistories: @props.rankHistories
          scores: @props.scores
