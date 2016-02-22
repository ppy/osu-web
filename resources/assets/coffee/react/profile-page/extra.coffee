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
{div, h2, span} = React.DOM
el = React.createElement

class ProfilePage.Extra extends React.Component
  constructor: (props) ->
    super props

    @state =
      tabsSticky: false
      profileOrder: @props.user.profileOrder


  componentDidMount: =>
    @_removeListeners()
    $.subscribe 'stickyHeader.profileContentsExtra', @_tabsStick
    osu.pageChange()

    $(@refs.pages).sortable
      cursor: 'move'
      handle: '.js-profile-page-extra--sortable-handle'
      revert: 150
      scrollSpeed: 10
      update: =>
        @updateOrder @refs.pages

    $(@refs.tabs).sortable
      cursor: 'move'
      disabled: !@props.withEdit
      revert: 150
      scrollSpeed: 0
      update: =>
        @updateOrder @refs.tabs



  componentWillUnmount: =>
    @_removeListeners()
    $(@refs.pages).sortable 'destroy'


  componentWillReceiveProps: (newProps) =>
    @setState profileOrder: newProps.user.profileOrder
    osu.pageChange()


  _removeListeners: ->
    $.unsubscribe '.profileContentsExtra'
    $(window).off '.profileContentsExtra'


  _tabsStick: (_e, target) =>
    newState = (target == 'profile-extra-tabs')
    @setState(tabsSticky: newState) if newState != @state.tabsSticky

  updateOrder: (elems) =>
    $elems = $(elems)

    newOrder = $elems.sortable('toArray', attribute: 'data-page-id')

    osu.showLoadingOverlay()

    $elems.sortable('cancel')

    @setState profileOrder: newOrder, =>
      $.ajax Url.updateProfileAccount,
        method: 'PUT'
        dataType: 'JSON'
        data:
          order: @state.profileOrder

      .done (userData) =>
        $.publish 'user:update', userData.data

      .fail (xhr) =>
        osu.ajaxError xhr

        @setState profileOrder: @props.user.profileOrder

      .always osu.hideLoadingOverlay


  render: =>
    withMePage = @props.userPage.html != '' || @props.withEdit

    tabsContainerClasses = 'hidden-xs profile-extra-tabs__container js-fixed-element'
    tabsClasses = 'profile-extra-tabs__items'
    if @state.tabsSticky
      tabsContainerClasses += ' profile-extra-tabs__container--fixed js-sticky-header--active'
      tabsClasses += ' profile-extra-tabs__items--fixed'

    div className: 'osu-layout__section osu-layout__section--extra',
      div
        className: 'profile-extra-tabs js-sticky-header js-profile-page--scrollspy-offset'
        'data-sticky-header-target': 'profile-extra-tabs'
        div
          className: tabsContainerClasses
          div className: 'osu-layout__row',
            div
              className: tabsClasses
              'data-sticky-header-id': 'profile-extra-tabs'
              ref: 'tabs'
              @state.profileOrder.map (m) =>
                return if m == 'me' && !withMePage

                el ProfilePage.ExtraTab, key: m, page: m, currentPage: @props.currentPage, currentMode: @props.currentMode

      div className: 'osu-layout__row', ref: 'pages',
        @state.profileOrder.map (m) =>
          topClassName = 'js-profile-page--scrollspy js-profile-page--page'

          elem =
            switch m
              when 'me'
                topClassName += ' hidden' unless withMePage
                props = userPage: @props.userPage, withEdit: @props.withEdit, user: @props.user
                ProfilePage.UserPage

              when 'recent_activities'
                props = recentActivities: @props.recentActivities
                ProfilePage.RecentActivities

              when 'kudosu'
                props = user: @props.user, recentlyReceivedKudosu: @props.recentlyReceivedKudosu
                ProfilePage.Kudosu

              when 'top_ranks'
                props = user: @props.user, scoresBest: @props.scoresBest, scoresFirst: @props.scoresFirst
                ProfilePage.TopRanks

              when 'beatmaps'
                props =
                  favouriteBeatmapSets: @props.favouriteBeatmapSets
                  rankedAndApprovedBeatmapSets: @props.rankedAndApprovedBeatmapSets
                ProfilePage.Beatmaps

              when 'medals'
                props = achievements: @props.achievements, allAchievements: @props.allAchievements
                ProfilePage.Medals

              when 'historical'
                props =
                  beatmapPlaycounts: @props.beatmapPlaycounts
                  rankHistories: @props.rankHistories
                  scores: @props.scores
                ProfilePage.Historical

              when 'performance'
                props = rankHistories: @props.rankHistories
                ProfilePage.Performance

          props.header =
            div
              key: 'header'
              h2 className: 'profile-extra__title', Lang.get("users.show.extra.#{m}.title")
              if @props.withEdit
                span className: 'profile-extra__dragdrop-toggle js-profile-page-extra--sortable-handle',
                  el Icon, name: 'bars'

          div
            key: m
            'data-page-id': m
            className: topClassName
            el elem, props
