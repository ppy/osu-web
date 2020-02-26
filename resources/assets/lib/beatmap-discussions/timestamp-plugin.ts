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

import OsuUrlHelper from 'osu-url-helper';
import { Eat } from 'remark-parse';
import { Node } from 'unist';

// plugin to tokenize timestamps
export function timestampPlugin() {
  function locator(value: string, fromIndex: number) {
    const match = value.substr(fromIndex).search(/[0-9]{2}:/);

    return match < 0 ? match : match + fromIndex;
  }

  function inlineTokenizer(eat: Eat, value: string, silent?: true): Node | boolean | void {
    const regex = new RegExp(/^((\d{2,}:[0-5]\d[:.]\d{3})( \((?:\d[,|])*\d\))?)/);
    const result = regex.exec(value);

    if (!result) {
      return;
    }

    if (silent) {
      return true;
    }

    const [matched, timestamp] = result;

    return eat(matched)({
      children: [
        {type: 'text', value: timestamp},
      ],
      href: OsuUrlHelper.openBeatmapEditor(timestamp),
      type: 'timestamp',
    });
  }

  // Ideally 'Parser' here should be typed like Parser from 'remark-parse', but the provided types appear wonky --
  // they causes issues with the inlineTokenizer definition below, so we're gonna leave it as an implicit 'any' for now.
  const Parser = this.Parser;
  const inlineTokenizers = Parser.prototype.inlineTokenizers;
  const inlineMethods = Parser.prototype.inlineMethods;

  // Inject inlineTokenizer
  inlineTokenizer.locator = locator;
  inlineTokenizers.timestamp = inlineTokenizer;
  inlineMethods.unshift('timestamp');
}
