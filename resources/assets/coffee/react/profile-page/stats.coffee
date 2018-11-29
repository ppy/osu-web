###
#    Copyright 2015-2018 ppy Pty. Ltd.
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

{div, dd, dl, dt} = ReactDOMFactories
el = React.createElement


class ProfilePage.Stats extends React.PureComponent
  defaultValueFormatter = (val) -> val.toLocaleString()


  render: =>
    div className: 'profile-stats',
      @renderSimpleEntry 'ranked_score'
      @renderSimpleEntry 'hit_accuracy', (val) -> "#{val.toFixed(2)}%"
      @renderSimpleEntry 'play_count'
      @renderSimpleEntry 'total_score'
      @renderSimpleEntry 'total_hits'
      @renderSimpleEntry 'maximum_combo'
      @renderSimpleEntry 'replays_watched_by_others'


  renderSimpleEntry: (key, valueFormatter = defaultValueFormatter) =>
    dl className: 'profile-stats__entry',
      dt className: 'profile-stats__key', osu.trans("users.show.stats.#{key}")
      dd className: 'profile-stats__value', valueFormatter(@props.stats[key])
