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
{a, div, h2, h3, img, p, small, span} = React.DOM
el = React.createElement

ProfilePage.Historical = React.createClass
  mixins: [React.addons.PureRenderMixin]

  getInitialState: ->
    defaultAmount: 5
    beatmapPlaycounts: []
    allScores: []

  componentDidMount: ->
    #download data for the first time
    return @state.beatmapPlaycounts.push -1 if @state.beatmapPlaycounts.length != 0 || @state.allScores.length != 0  
    @_showMore "beatmapPlaycounts"
    @_showMore "allScores"


  _showMore: (key, e) ->
    e.preventDefault() if e
    @_downloadMoreOf key


  _downloadMoreOf: (key) ->
    url = laroute.route 'users.showinfo', users: @props.user.id
    $.get url, {t: key, o: @state[key].length, l: @state[key].length + @state.defaultAmount}, (data) =>
      if key == "allScores"
        data.allScores = data.allScores.data[@props.currentMode]
     
        @setState "#{key}": (@state[key].concat(data.allScores.data))

  
      
     console.log "state setted"
        

  _beatmapRow: (bm, bmset, key, details = []) ->
    topClasses = 'beatmapset-row'
  
    div
      key: key
      className: topClasses
      div
        className: 'beatmapset-row__cover'
        style:
          backgroundImage: "url('#{bmset.covers.list}')"
      div
        className: 'beatmapset-row__detail'
        div
          className: 'beatmapset-row__detail-row'
          div
            className: 'beatmapset-row__detail-column beatmapset-row__detail-column--full'
            a
              className: 'beatmapset-row__title'
              href: laroute.route 'beatmaps.show', beatmaps: bm.id
              title: "#{bmset.artist} - #{bmset.title} [#{bm.version}] "
              "#{bmset.title} [#{bm.version}] "
              span
                className: 'beatmapset-row__title-small'
                bmset.artist
          div
            className: 'beatmapset-row__detail-column'
            details[0]
        div
          className: 'beatmapset-row__detail-row'
          div
            className: 'beatmapset-row__detail-column beatmapset-row__detail-column--full'
            span dangerouslySetInnerHTML:
                __html: osu.trans 'beatmaps.listing.mapped-by',
                  mapper: laroute.link_to_route 'users.show',
                    bmset.creator
                    { users: bmset.user_id }
                    class: 'beatmapset-row__title-small'
          div
            className: 'beatmapset-row__detail-column'
            details[1]

  render: ->
    console.log(@state)
    div
      className: 'page-extra'

      el ProfilePage.ExtraHeader, name: @props.name, withEdit: @props.withEdit

      h3
        className: 'page-extra__title page-extra__title--small'
        osu.trans('users.show.extra.historical.most_played.title')

      if @state.beatmapPlaycounts.length
        [
          @state.beatmapPlaycounts.map (pc, i) =>
            @_beatmapRow pc.beatmap.data, pc.beatmapset.data, i, [
              [
                span
                  key: 'name'
                  className: 'beatmapset-row__info'
                  osu.trans('users.show.extra.historical.most_played.count')
                span
                  key: 'value'
                  className: 'beatmapset-row__info beatmapset-row__info--large'
                  " #{pc.count.toLocaleString()}"
              ]
            ]

          if true #todo
            a
              key: 'more'
              href: '#'
              className: 'beatmapset-row beatmapset-row--more'
              onClick: @_showMore.bind(@, 'beatmapPlaycounts')
              osu.trans('common.buttons.show_more')
        ]

      else
        p null, osu.trans('users.show.extra.historical.empty')

      h3
        className: 'page-extra__title page-extra__title--small'
        osu.trans('users.show.extra.historical.recent_plays.title')

      if @state.allScores.length
        [
          @state.allScores.map (score, i) =>
            el PlayDetail, key: i, score: score

          if true #todo
            a
              key: 'more'
              href: '#'
              className: 'beatmapset-row beatmapset-row--more'
              onClick: @_showMore.bind(@, 'allScores')
              osu.trans('common.buttons.show_more')
        ]

      else
        p null, osu.trans('users.show.extra.historical.empty')
