# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class @BeatmapsetPageHash
  @parse: (hash) ->
    [mode, id] = hash[1..].split '/'

    playmode: if mode != '' then mode
    beatmapId: if id? then parseInt(id, 10)

  @generate: ({beatmap, mode}) ->
    if beatmap?
      "##{beatmap.mode}/#{beatmap.id}"
    else
      "##{mode}"
