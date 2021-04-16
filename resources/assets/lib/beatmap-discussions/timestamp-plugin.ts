// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import OsuUrlHelper from 'osu-url-helper';
import { Eat } from 'remark-parse';
import { Processor } from 'unified';

// plugin to tokenize timestamps
export function timestampPlugin(this: Processor) {
  function locator(value: string, fromIndex: number) {
    const match = value.substr(fromIndex).search(/[0-9]{2}:/);

    return match < 0 ? match : match + fromIndex;
  }

  function inlineTokenizer(eat: Eat, value: string, silent?: true) {
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
