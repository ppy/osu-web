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

{div} = ReactDOMFactories


class ProfilePage.PlayTime extends React.PureComponent
  render: =>
    playTime = moment.duration @props.stats.play_time, 'seconds'

    daysLeftOver = Math.floor playTime.asDays()
    hours = playTime.hours()
    minutes = playTime.minutes()
    seconds = playTime.seconds()

    timeString = ''
    timeString = "#{daysLeftOver.toLocaleString()}d " if daysLeftOver > 0
    timeString += "#{hours}h #{minutes}m #{seconds}s"

    div className: 'value-display',
      div className: 'value-display__label',
        osu.trans('users.show.stats.play_time')
      div className: 'value-display__value',
        timeString
