###
# Copyright 2016 ppy Pty. Ltd.
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

beatmaps = []
beatmaps[beatmap.id] = beatmap for beatmap in set.beatmaps.data

beatmapsByMode = []
beatmapsByMode[mode] = [] for mode in osu.modes
beatmapsByMode[beatmap.mode].push beatmap for beatmap in set.beatmaps.data

beatmapCount = []
beatmapCount[mode] = 0 for mode in osu.modes
beatmapCount[beatmap.mode]++ for beatmap in set.beatmaps.data

displayedBeatmap = _.last(set.beatmaps.data).id

propsFunction = =>
  set: set
  beatmaps: beatmaps
  beatmapsByMode: beatmapsByMode
  beatmapCount: beatmapCount
  displayedBeatmap: displayedBeatmap

reactTurbolinks.register 'beatmapset-page', BeatmapSetPage.Main, propsFunction
