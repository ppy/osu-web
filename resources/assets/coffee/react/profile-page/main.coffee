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

class ProfilePage.Main extends React.Component
  constructor: (props) ->
    super props

    optionsHash = ProfilePageHash.parse location.hash
    @modes = ['osu', 'taiko', 'fruits', 'mania']

    @initialPage = optionsHash.page
    @timeouts = {}

    @state =
      currentMode: @validMode(optionsHash.mode ? props.user.playmode)
      user: props.user
      userPage:
        html: props.userPage.html
        initialRaw: props.userPage.raw
        raw: props.userPage.raw
        editing: false
        selection: [0, 0]
      isCoverUpdating: false


  coverUploadState: (_e, state) =>
    @setState isCoverUpdating: state


  setCurrentMode: (_e, mode) =>
    return if @state.currentMode == mode
    @setState currentMode: @validMode(mode), @setHash


  setCurrentPage: (_e, page, extraCallback) =>
    callback = =>
      extraCallback?()
      @setHash()

    if @state.currentPage == page
      callback()

    @setState currentPage: page, callback


  setHash: =>
    osu.setHash ProfilePageHash.generate(page: @state.currentPage, mode: @state.currentMode)


  userUpdate: (_e, user) =>
    return if !user?
    @setState user: user


  userPageUpdate: (_e, newUserPage) =>
    currentUserPage = _.cloneDeep @state.userPage
    @setState userPage: _.extend(currentUserPage, newUserPage)


  pages: document.getElementsByClassName('js-profile-page--scrollspy')
  pagesOffset: document.getElementsByClassName('js-profile-page--scrollspy-offset')

  pageScan: =>
    return if @scrolling
    return if @pages.length == 0

    anchorHeight = @pagesOffset[0].getBoundingClientRect().height

    if osu.bottomPage()
      @setCurrentPage null, _.last(@pages).dataset.pageId
      return

    for page in @pages
      pageDims = page.getBoundingClientRect()
      pageBottom = pageDims.bottom - Math.min(pageDims.height * 0.75, 200)
      continue unless pageBottom > anchorHeight

      @setCurrentPage null, page.dataset.pageId
      return

    @setCurrentPage null, page.dataset.pageId


  pageJump: (_e, page) =>
    if page == 'main'
      @setCurrentPage null, page
      return

    target = $(".js-profile-page--page[data-page-id='#{page}']")

    # if invalid page is specified, scan current position
    if target.length == 0
      @pageScan()
      return

    # Don't bother scanning the current position.
    # The result will be wrong when target page is too short anyway.
    @scrolling = true
    clearTimeout @timeouts.scrolling

    $(window).stop().scrollTo target, 500,
      onAfter: =>
        # Manually set the mode to avoid confusion (wrong highlight).
        # Scrolling will obviously break it but that's unfortunate result
        # from having the scrollspy marker at middle of page.
        @setCurrentPage null, page, =>
          # Doesn't work:
          # - part of state (callback, part of mode setting)
          # - simple variable in callback
          # Both still change the switch too soon.
          @timeouts.scrolling = setTimeout (=> @scrolling = false), 100
      # count for the tabs height
      offset: @pagesOffset[0].getBoundingClientRect().height * -1


  componentDidMount: =>
    @removeListeners()
    $.subscribe 'user:update.profilePage', @userUpdate
    $.subscribe 'user:cover:upload:state.profilePage', @coverUploadState
    $.subscribe 'user:page:update.profilePage', @userPageUpdate
    $.subscribe 'profile:mode:set.profilePage', @setCurrentMode
    $.subscribe 'profile:page:jump.profilePage', @pageJump
    $(window).on 'throttled-scroll.profilePage', @pageScan

    @pageJump null, @initialPage


  componentWillUnmount: =>
    for own _name, timeout of @timeouts
      clearTimeout timeout

    $(window).stop()
    @removeListeners()


  removeListeners: =>
    $.unsubscribe '.profilePage'
    $(window).off '.profilePage'

  render: =>
    rankHistories = @props.userRankHistories[@state.currentMode]?.data
    stats = @props.userStats[@state.currentMode].data
    scores = @props.userScores[@state.currentMode].data
    scoresBest = @props.userScoresBest[@state.currentMode].data
    scoresFirst = @props.userScoresFirst[@state.currentMode].data

    div className: 'osu-layout__section',
      el ProfilePage.Header,
        user: @state.user
        stats: stats
        currentMode: @state.currentMode
        withEdit: @props.withEdit
        isCoverUpdating: @state.isCoverUpdating

      el ProfilePage.Contents,
        user: @state.user
        stats: stats
        currentMode: @state.currentMode
        currentPage: @state.currentPage
        achievements: @props.userAchievements
        achievementData: @props.achievementData
        modes: @modes

      el ProfilePage.Extra,
        achievements: @props.userAchievements
        achievementData: @props.achievementData
        beatmapPlaycounts: @props.beatmapPlaycounts
        favouriteBeatmapSets: @props.favouriteBeatmapSets
        rankedAndApprovedBeatmapSets: @props.rankedAndApprovedBeatmapSets
        recentActivities: @props.recentActivities
        recentlyReceivedKudosu: @props.recentlyReceivedKudosu
        favouriteBeatmapSets: @props.favouriteBeatmapSets
        rankHistories: rankHistories
        rankedAndApprovedBeatmapSets: @props.rankedAndApprovedBeatmapSets
        user: @state.user
        scores: scores
        scoresBest: scoresBest
        scoresFirst: scoresFirst
        withEdit: @props.withEdit
        userPage: @state.userPage
        currentPage: @state.currentPage
        currentMode: @state.currentMode


  validMode: (mode) =>
    if _.includes(@modes, mode)
      mode
    else
      @modes[0]
