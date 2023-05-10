// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import add from 'remark-plugins/add';
import type { Processor } from 'unified';
import fromMarkdown from './from-markdown';
import micromark from './micromark';

export default function legacyLink(this: Processor) {
  add(this, 'micromarkExtensions', [micromark]);
  add(this, 'fromMarkdownExtensions', [fromMarkdown]);
}
