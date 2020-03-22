// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
