// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import type Constructs from 'micromark-core-commonmark';
import type { Processor } from 'unified';
import add from './add';

export type DisabledType = 'chat' | 'default' | 'editor' | 'reviews';

interface Options {
  type?: DisabledType;
}

type Construct = keyof typeof Constructs;

const defaultDisabled: Construct[] = [
  'autolink',
  'blockQuote',
  'definition',
  'hardBreakEscape',
  'headingAtx',
  'htmlFlow',
  'htmlText',
  'list',
  'setextUnderline',
  'thematicBreak',
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
  default: defaultDisabled,
  // Editor has to disable nearly everything to show mostly text.
  editor: [
    ...defaultDisabled,
    'codeFenced',
    'codeIndented',
    'codeText',
    'labelEnd',
    'labelStartImage',
    'labelStartLink',
  ],
  // code blocks (any multiline construct in general) may cause review editing to break.
  reviews: [
    ...defaultDisabled,
    'codeFenced',
    'codeIndented',
    'codeText',
  ],
};

export default function disableConstructs(this: Processor, options?: Options) {
  add(
    this,
    'micromarkExtensions',
    [{ disable: { null: disabled[options?.type ?? 'default'] } }],
  );
}
