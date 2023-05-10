// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { renderToStaticMarkup } from 'react-dom/server';
import ReactMarkdown from 'react-markdown';
import legacyLink from 'remark-plugins/legacy-link';

const tests: Partial<Record<string, [string, string]>> = {
  // this is different from client: in client, \] can finish the syntax but
  // here the backslash must be escaped otherwise it'll consider the backslash
  // to escape the text and thus the syntax never finishes.
  backslashesInside: [
    'This is a [https://osu.ppy.sh link \\ with \\ backslashes \\\\].',
    '<p>This is a <a href="https://osu.ppy.sh">link \\ with \\ backslashes \\</a>.</p>',
  ],
  basic: [
    'This is a [https://osu.ppy.sh simple test].',
    '<p>This is a <a href="https://osu.ppy.sh">simple test</a>.</p>',
  ],
  escapedAndBalancedBrackets: [
    'This is a [https://osu.ppy.sh [link [with \\] too many brackets \\[ ]]].',
    '<p>This is a <a href="https://osu.ppy.sh">[link [with ] too many brackets [ ]]</a>.</p>',
  ],
  escapedBrackets: [
    'This is a [https://osu.ppy.sh nasty link with escaped brackets: \\] and \\[].',
    '<p>This is a <a href="https://osu.ppy.sh">nasty link with escaped brackets: ] and [</a>.</p>',
  ],
  invalidUrl: [
    'This is not a [https:osu.ppy.sh link].',
    '<p>This is not a [https:osu.ppy.sh link].</p>',
  ],
};

describe('legacyLink renders legacy link', () => {
  for (const name of Object.keys(tests)) {
    const test = tests[name];
    if (test == null) continue;
    const [source, result] = test;

    it(`renders correctly: ${name}`, () => {
      const out = renderToStaticMarkup(
        <ReactMarkdown remarkPlugins={[legacyLink]}>
          {source}
        </ReactMarkdown>,
      );

      expect(out).toBe(result);
    });
  }
});
