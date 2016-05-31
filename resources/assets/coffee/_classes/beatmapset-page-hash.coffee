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

class @BeatmapsetPageHash
  @noMode: (page) ->
    ['description'].indexOf(page) != -1

  @parse: (hash) ->
    hash = hash[1..]
    if @noMode hash
      page: hash
    else
      split = hash.split '/'
      beatmapId: parseInt split[0], 10
      page: split[1] || 'main'

  @generate: ({page, beatmapId}) ->
    if @noMode(page)
      "##{page}"
    else
      hash = "##{beatmapId}"
      hash += "/#{page}" if page != 'main'
      hash
