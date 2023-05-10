// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import type Constructs from 'micromark-core-commonmark';
import type { Processor } from 'unified';
import add from './add';

export type DisabledType = 'chat' | 'chatPlain' | 'default' | 'editor' | 'reviews';

interface Options {
  type?: DisabledType;
}

type Construct = keyof typeof Constructs;

const allDisabledList: Construct[] = [
  // 'characterEscape', // escaping things is always useful
  // 'content', // not sure what this is

  'attention',
  'autolink',
  'blankLine',
  'blockQuote',
  'characterReference',
  'codeFenced',
  'codeIndented',
  'codeText',
  'definition',
  'hardBreakEscape',
  'headingAtx',
  'htmlFlow',
  'htmlText',
  'labelEnd',
  'labelStartImage',
  'labelStartLink',
  'lineEnding',
  'list',
  'setextUnderline',
  'thematicBreak',
];

function makeDisabledListFromAllowList(allowList: Construct[]): Construct[] {
  return allDisabledList.filter((item) => !allowList.includes(item));
}

const defaultDisabled: Construct[] = [
  'autolink',
  'definition',
  'hardBreakEscape',
  'headingAtx',
  'htmlFlow',
  'htmlText',
  'setextUnderline',
  'thematicBreak',
];

const reviewsDisabled: Construct[] = [
  ...defaultDisabled,
  'blockQuote',
  'codeFenced',
  'codeIndented',
  'codeText',
  'list',
];

// list of constructs to disable
const disabled: Record<DisabledType, Construct[]> = {
  chat: [
    'definition',
    'htmlFlow',
    'htmlText',
    'labelStartImage',
    'setextUnderline',
  ],
  chatPlain: makeDisabledListFromAllowList([
    'autolink',
    'labelEnd',
    'labelStartLink',
  ]),
  default: defaultDisabled,
  // Editor has to disable nearly everything to show mostly text.
  editor: [
    ...reviewsDisabled,
    'codeFenced',
    'codeIndented',
    'codeText',
    'labelEnd',
    'labelStartImage',
    'labelStartLink',
  ],
  // code blocks (any multiline construct in general) may cause review editing to break.
  reviews: reviewsDisabled,
};

export default function disableConstructs(this: Processor, options?: Options) {
  add(
    this,
    'micromarkExtensions',
    [{ disable: { null: disabled[options?.type ?? 'default'] } }],
  );
}
