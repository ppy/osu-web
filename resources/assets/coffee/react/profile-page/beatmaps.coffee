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

{div, h2, h3, ul, li, a, p, pre, span} = ReactDOMFactories
el = React.createElement

class ProfilePage.Beatmaps extends React.PureComponent
  constructor: (props) ->
    super props

    @state =
      visible_favourite: 6
      visible_ranked_and_approved: 6


  render: =>
    allBeatmapsets =
      favourite: @props.favouriteBeatmapsets
      ranked_and_approved: @props.rankedAndApprovedBeatmapsets

    div
      className: 'page-extra'
      el ProfilePage.ExtraHeader, name: @props.name, withEdit: @props.withEdit
      for own section, beatmapsets of allBeatmapsets
        div
          key: section
          h3
            className: 'page-extra__title page-extra__title--small'
            osu.trans("users.show.extra.beatmaps.#{section}.title", count: beatmapsets.length)

          if beatmapsets.length > 0
            div className: 'osu-layout__col-container osu-layout__col-container--with-gutter',
              for beatmapset in beatmapsets.slice(0, @state["visible_#{section}"])
                div
                  key: beatmapset.id
                  className: 'osu-layout__col osu-layout__col--sm-4'
                  el BeatmapsetPanel, beatmap: beatmapset

              if beatmapsets.length > @state["visible_#{section}"]
                div
                  className: 'osu-layout__col text-center',
                  a
                    href: '#'
                    onClick: @_showMore
                    'data-section': section
                    osu.trans('common.buttons.show_more')
          else
            p className: 'page-extra-entries', osu.trans('users.show.extra.beatmaps.none')


  _showMore: (e) =>
    e.preventDefault()

    key = e.currentTarget.dataset.section
    @setState "visible_#{key}": (@state["visible_#{key}"] + 10)
