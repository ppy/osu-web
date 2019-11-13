import { Eat } from 'remark-parse';
import { Node } from 'unist';

function embedTokenizer() {
  function locator(value: string, fromIndex: number) {
    return value.indexOf('%[', fromIndex);
  }

  function inlineTokenizer(eat: Eat, value: string, silent?: true): Node | boolean | void {
    // Custom Markdown to Embed a Discussion
    // e.g. given a discussion_id of 123: %[](#123)
    const regex = new RegExp(/%\[\]\(#(\d+)\)\n*/);
    const result = regex.exec(value);

    if (silent) {
      return true;
    }

    if (!result || result.index !== 0) {
      return;
    }

    const [matched, embed, reference] = result;

    return eat(matched)({
      children: [
        {type: 'text', value: embed},
      ],
      data: {
        discussion_id: embed,
      },
      reference,
      type: 'embed',
    });
  }

  // Ideally 'Parser' here should be typed like Parser from 'remark-parse', but the provided types appear wonky --
  // they causes issues with the inlineTokenizer definition below, so we're gonna leave it as an implicit 'any' for now.
  const Parser = this.Parser;
  const inlineTokenizers = Parser.prototype.inlineTokenizers;
  const inlineMethods = Parser.prototype.inlineMethods;

  // Inject inlineTokenizer
  inlineTokenizer.locator = locator;
  inlineTokenizers.embed = inlineTokenizer;
  inlineMethods.unshift('embed');
}

module.exports = embedTokenizer;
