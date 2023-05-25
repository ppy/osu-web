// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { renderToStaticMarkup } from 'react-dom/server';
import ReactMarkdown from 'react-markdown';
import oldLink from 'remark-plugins/old-link';

const tests: Partial<Record<string, [string, string]>> = {
  // this is different from client: in client, \) can finish the syntax but
  // here the backslash must be escaped otherwise it'll consider the backslash
  // to escape the text and thus the syntax never finishes.
  backslashes: [
    'This link (should end with a backslash \\\\)[https://osu.ppy.sh].',
    '<p>This link <a href="https://osu.ppy.sh">should end with a backslash \\</a>.</p>',
  ],
  balancedBrackets: [
    'This is a (tricky (one))[https://osu.ppy.sh]!',
    '<p>This is a <a href="https://osu.ppy.sh">tricky (one)</a>!</p>',
  ],
  basic: [
    'This is a (simple test)[https://osu.ppy.sh] of links.',
    '<p>This is a <a href="https://osu.ppy.sh">simple test</a> of links.</p>',
  ],
  escapedAndBalancedBrackets: [
    'This is a (\\)super\\(\\( tricky (one))[https://osu.ppy.sh]!',
    '<p>This is a <a href="https://osu.ppy.sh">)super(( tricky (one)</a>!</p>',
  ],
  escapedBrackets: [
    'This is (another loose bracket \\))[https://osu.ppy.sh].',
    '<p>This is <a href="https://osu.ppy.sh">another loose bracket )</a>.</p>',
  ],
  invalidUrl: [
    'This is not a (link)[https:osu.ppy.sh].',
    '<p>This is not a (link)[https:osu.ppy.sh].</p>',
  ],
  missingLabel: [
    'This is not a ()[https://osu.ppy.sh].',
    '<p>This is not a ()[https://osu.ppy.sh].</p>',
  ],
};

describe('oldLink renders old link', () => {
  for (const name of Object.keys(tests)) {
    const test = tests[name];
    if (test == null) continue;
    const [source, result] = test;

    it(`renders correctly: ${name}`, () => {
      const out = renderToStaticMarkup(
        <ReactMarkdown remarkPlugins={[oldLink]}>
          {source}
        </ReactMarkdown>,
      );

      expect(out).toBe(result);
    });
  }
});
