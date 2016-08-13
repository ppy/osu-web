###
# Copyright 2015-2016 ppy Pty. Ltd.
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
class @ModsHelper
  @ids:
    NF: 0
    EZ: 1
    HD: 3
    HR: 4
    SD: 5
    DT: 6
    Relax: 7
    HT: 8
    NC: 9
    FL: 10
    SO: 12
    AP: 13
    PF: 14
    '4K': 15
    '5K': 16
    '6K': 17
    '7K': 18
    '8K': 19
    FI: 20
    '9K': 24

  @getId: (mod) -> @ids[mod]

  @getBit: (mod) -> 1 << @ids[mod]
