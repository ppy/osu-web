// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import type { Processor } from 'unified';
import add from './add';

// list of constructs to disable
// from micromark-core-commonmark.
// only 'attention' is left enabled.
const disabled = [
  'autolink',
  'blockQuote',
  'characterEscape',
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

// Limit the types allowed for reviews.
export default function disableConstructs(this: Processor) {
  add(this, 'micromarkExtensions', [{ disable: { null: disabled } }]);
}
