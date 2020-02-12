import OsuUrlHelper from 'osu-url-helper';
import { Eat } from 'remark-parse';
import { Node } from 'unist';

// Tokenizer for beatmap timestamps
export function timestampTokenizer() {
  function locator(value: string, fromIndex: number) {
    return value.indexOf('(', fromIndex);
  }

  function inlineTokenizer(eat: Eat, value: string, silent?: true): Node | boolean | void {
    const regex = new RegExp(/((\d{2,}:[0-5]\d[:.]\d{3})( \((?:\d[,|])*\d\))?)/g);
    const result = regex.exec(value);

    if (silent) {
      return true;
    }

    if (!result || result.index !== 0) {
      return;
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
