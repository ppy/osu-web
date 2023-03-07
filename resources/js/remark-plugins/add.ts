// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Extension as MdastExtension } from 'mdast-util-from-markdown';
import { Extension as MicromarkExtension } from 'micromark-util-types';
import { PluggableList, Processor } from 'unified';

type SupportedExtension = 'fromMarkdownExtensions' | 'micromarkExtensions';

export default function add(processor: Processor, key: SupportedExtension, extensions: (MicromarkExtension | MdastExtension)[]) {
  const data = processor.data(key) as (PluggableList | undefined) ?? [];

  processor.data(key, [...data, ...extensions]);
}
