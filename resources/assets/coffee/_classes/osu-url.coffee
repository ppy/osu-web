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
class @OsuUrl
  @users:
    show: (id) => "/u/#{id}"

    showHash:
      noMode: ['kudosu', 'me', 'medals']
      parse: (hash) =>
        hash = hash.slice 1
        if OsuUrl.users.showHash.noMode.indexOf(hash) != -1
          page: hash
        else
          split = hash.split '/'
          mode: split[0]
          page: split[1] || 'main'

      generate: (options) =>
        if OsuUrl.users.showHash.noMode.indexOf(options.page) != -1
          "##{options.page}"
        else
          hash = "##{options.mode}"
          hash += "/#{options.page}" if options.page != 'main'
          hash
