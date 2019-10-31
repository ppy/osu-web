import * as remarkParse from 'remark-parse';

function embedTokenizer() {
  function locator(value: string, fromIndex: number) {
    return value.indexOf('%[', fromIndex);
  }

  function inlineTokenizer(eat: remarkParse.Eat, value: string, silent: true): boolean | void {
    // Custom Markdown to Embed a Discussion
    // e.g. given a discussion_id of 123: %[](#123)
    const regex = new RegExp(/%\[\]\(#(\d+)\)\n*/);
    const result = regex.exec(value);

    if (silent) {
      return silent;
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

  const Parser = this.Parser;
  const inlineTokenizers = Parser.prototype.inlineTokenizers;
  const inlineMethods = Parser.prototype.inlineMethods;

  // Inject inlineTokenizer
  inlineTokenizer.locator = locator;
  inlineTokenizers.embed = inlineTokenizer;
  inlineMethods.splice(0, 0, 'embed');
}

module.exports = embedTokenizer;
