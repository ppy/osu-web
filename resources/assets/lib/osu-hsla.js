/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
 */

// `number` function is taken from: https://github.com/less/less.js/blob/master/lib/less/functions/color.js
module.exports = {
  install: function(less, pluginManager, functions) {
    const getNumber = (n) => {
      if (n instanceof less.tree.Dimension) {
        return parseFloat(n.unit.is('%') ? n.value / 100 : n.value);
      } else if (typeof n === 'number') {
        return n;
      } else {
        throw new Error(`unsupported number: ${n}`);
      }
    };

    const osuHsla = (colour, alpha) => {
      if (colour instanceof less.tree.Color) {
        colour.alpha = getNumber(alpha);
      } else if (colour instanceof less.tree.Call) {
        if (colour.name === 'hsl') {
          colour.name = 'hsla';
          colour.args.push(alpha);
        } else {
          throw new Error(`unsupported colour function: ${colour.name}`);
        }
      } else {
        throw new Error(`unsupported colour parameter: ${colour}`);
      }

      return colour;
    };

    functions.add('osu-hsla', osuHsla);
  },
};
