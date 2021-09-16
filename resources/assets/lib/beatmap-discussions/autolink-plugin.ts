// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Eat } from 'remark-parse';
import { Processor } from 'unified';

export function autolinkPlugin(this: Processor) {
  function locator(value: string, fromIndex: number) {
    return value.indexOf('http', fromIndex);
  }

  function inlineTokenizer(eat: Eat, value: string, silent?: true) {
    const regex = new RegExp(osu.urlRegex);
    const result = regex.exec(value);

    if (!result || result.index !== 0) {
      return;
    }

    if (silent) {
      return true;
    }

    const [matched, , url] = result;

    return eat(matched)({
      children: [
        {type: 'text', value: url},
      ],
      type: 'link',
      url: matched,
    });
  }

  // Ideally 'Parser' here should be typed like Parser from 'remark-parse', but the provided types appear wonky --
  // they causes issues with the inlineTokenizer definition below, so we're gonna leave it as an implicit 'any' for now.
  const Parser = this.Parser;
  const inlineTokenizers = Parser.prototype.inlineTokenizers;
  const inlineMethods = Parser.prototype.inlineMethods;

  // Inject inlineTokenizer
  inlineTokenizer.locator = locator;
  inlineTokenizers.link = inlineTokenizer;
  inlineMethods.unshift('link');
}
