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

export function disableTokenizersPlugin({allowedBlocks = [] as string[], allowedInlines = [] as string[]} = {}) {
  this.Parser.prototype.blockMethods
    .filter((key: string) => key !== 'root' && !allowedBlocks.includes(key))
    .forEach((key: string) => {
      this.Parser.prototype.blockMethods[key] = () => true;
    });

  this.Parser.prototype.inlineMethods
    .filter((key: string) => key !== 'text' && !allowedInlines.includes(key))
    .forEach((key: string) => {
      this.Parser.prototype.inlineTokenizers[key] = () => true;
      this.Parser.prototype.inlineTokenizers[key].locator = () => -1;
    });
}
