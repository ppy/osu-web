// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import type { Link } from 'mdast';
import type { CompileContext, Extension, Token } from 'mdast-util-from-markdown';

function enterLegacyLink(this: CompileContext, token: Token) {
  this.enter({
    children: [],
    type: 'link',
    url: '',
  }, token);
}

function enterLegacyLinkTitle(this: CompileContext) {
  this.buffer();
}

function exitLegacyLinkTitle(this: CompileContext) {
  const title = this.resume();
  (top(this.stack) as Link).children = [{
    type: 'text',
    value: title,
  }];
}

function exitLegacyLinkUrl(this: CompileContext, token: Token) {
  (top(this.stack) as Link).url = this.sliceSerialize(token);
}

function exitLegacyLink(this: CompileContext, token: Token) {
  this.exit(token);
}

function top(stack: CompileContext['stack']) {
  return stack[stack.length - 1];
}

const fromMarkdown: Extension = {
  enter: {
    legacyLink: enterLegacyLink,
    legacyLinkTitle: enterLegacyLinkTitle,
  },
  exit: {
    legacyLink: exitLegacyLink,
    legacyLinkTitle: exitLegacyLinkTitle,
    legacyLinkUrl: exitLegacyLinkUrl,
  },
};
export default fromMarkdown;
