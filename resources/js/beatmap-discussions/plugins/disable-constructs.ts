// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import type Constructs from 'micromark-core-commonmark';
import type { Processor } from 'unified';
import add from './add';

export interface Options {
  type?: 'reviews'; // only option :D
}

type Construct = keyof typeof Constructs;

// list of constructs to disable
const disabled: Construct[] = [
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

// code blocks (any multiline construct in general) may cause review editing to break.
const disabledReviews: Construct[] = [
  ...disabled,
  'codeFenced',
  'codeIndented',
  'codeText',
];

// Limit the types allowed for reviews.
export default function disableConstructs(this: Processor, options?: Options) {
  add(
    this,
    'micromarkExtensions',
    [{ disable: { null: options?.type === 'reviews' ? disabledReviews : disabled } }],
  );
}
