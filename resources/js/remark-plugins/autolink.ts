// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { gfmAutolinkLiteralFromMarkdown } from 'mdast-util-gfm-autolink-literal';
import { gfmAutolinkLiteral } from 'micromark-extension-gfm-autolink-literal';
import type { Processor } from 'unified';
import add from './add';

export default function autolink(this: Processor) {
  add(this, 'micromarkExtensions', [gfmAutolinkLiteral]);
  add(this, 'fromMarkdownExtensions', [gfmAutolinkLiteralFromMarkdown]);
}
