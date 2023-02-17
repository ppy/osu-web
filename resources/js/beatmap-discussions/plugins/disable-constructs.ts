// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import type Constructs from 'micromark-core-commonmark';
import type { Processor } from 'unified';
import add from './add';

type DisabledType = 'chat' | 'default';

export interface Options {
  type?: DisabledType;
}

type Construct = keyof typeof Constructs;

// list of constructs to disable
const disabled: Record<DisabledType, Construct[]> = {
  chat: [
    'definition',
    'htmlFlow',
    'htmlText',
    'labelStartImage',
    'setextUnderline',
  ],
  default: [
    'autolink',
    'blockQuote',
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
    'list',
    'setextUnderline',
    'thematicBreak',
  ],
};

export default function disableConstructs(this: Processor, options?: Options) {
  add(
    this,
    'micromarkExtensions',
    [{ disable: { null: disabled[options?.type ?? 'default'] } }],
  );
}
