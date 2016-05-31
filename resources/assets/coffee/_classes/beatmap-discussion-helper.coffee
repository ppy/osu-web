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
class @BeatmapDiscussionHelper
  @messageType:
    icon:
      praise: 'heart'
      suggestion: 'circle-o'
      problem: 'exclamation-circle'

    # used for svg since it doesn't seem to have ::before pseudo-element
    iconText:
      praise: '&#xf004;'
      suggestion: '&#xf10c;'
      problem: '&#xf06a;'

  @formatTimestamp: (timestamp) =>
    moment(timestamp).utcOffset(0).format('mm:ss.SSS')
