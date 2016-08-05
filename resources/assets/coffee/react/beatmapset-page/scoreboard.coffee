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
{div, p} = React.DOM
el = React.createElement

class BeatmapsetPage.Scoreboard extends React.Component
  constructor: (props) ->
    super props

    @state =
      loading: false

  setLoading: (_e, isLoading) =>
    @setState loading: isLoading

  componentDidMount: ->
    $.subscribe 'beatmapset:scoreboard:loading.beatmapsetPageScoreboard', @setLoading

  componentWillUnmount: ->
    $.unsubscribe '.beatmapsetPageScoreboard'

  render: ->
    div className: 'osu-layout__row osu-layout__row--page-beatmapset beatmapset-scoreboard',
      div className: 'page-tabs',
        for type in ['global', 'country', 'friend']
          el BeatmapsetPage.ScoreboardTab,
            key: type
            type: type
            active: @props.currentType == type

      div className: 'beatmapset-scoreboard__main',
        if @props.scores.length > 0

        else if currentUser.isSupporter || @props.currentType == 'global'
          translationKey = if @state.loading then 'loading' else @props.currentType

          p
            className: "beatmapset-scoreboard__notice beatmapset-scoreboard__notice--no-scores beatmapset-scoreboard__notice--#{'guest' if !currentUser.id?}"
            osu.trans "beatmaps.beatmapset.show.scoreboard.no-scores.#{translationKey}"

        else
          div className: 'beatmapset-scoreboard__notice',
            p className: 'beatmapset-scoreboard__supporter-text', osu.trans 'beatmaps.beatmapset.show.scoreboard.supporter-only'

            p
              className: 'beatmapset-scoreboard__supporter-text beatmapset-scoreboard__supporter-text--small'
              dangerouslySetInnerHTML:
                __html: osu.trans 'beatmaps.beatmapset.show.scoreboard.supporter-link', link: laroute.route 'support-the-game'
