###*
*    Copyright 2015 ppy Pty. Ltd.
*
*    This file is part of osu!web. osu!web is distributed with the hope of
*    attracting more community contributions to the core ecosystem of osu!.
*
*    osu!web is free software: you can redistribute it and/or modify
*    it under the terms of the Affero GNU General Public License version 3
*    as published by the Free Software Foundation.
*
*    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
*    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*    See the GNU Affero General Public License for more details.
*
*    You should have received a copy of the GNU Affero General Public License
*    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
*
###
propsFunction = (target) ->
  data = osu.parseJson target.dataset.src

  return {
    contest: data.contest
    selected: data.userVotes
    options:
      showPreview: data.contest['type'] == 'music'
  }

reactTurbolinks.register 'contestArtList', Contest.Voting.ArtEntryList, propsFunction
reactTurbolinks.register 'contestList', Contest.Voting.EntryList, propsFunction
