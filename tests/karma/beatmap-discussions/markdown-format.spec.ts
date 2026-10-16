// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { applyMarkdownFormat } from 'beatmap-discussions/markdown-format';

describe('beatmap-discussions/markdown-format', () => {
  describe('.applyMarkdownFormat', () => {
    it('places the cursor inside the markers when nothing is selected', () => {
      expect(applyMarkdownFormat('hi', 1, 1, 'bold')).toEqual({
        replaceEnd: 1,
        replaceStart: 1,
        selectionLength: 0,
        selectionStart: 3,
        text: '****',
      });
    });

    it('selects the url placeholder when an image is inserted with nothing selected', () => {
      expect(applyMarkdownFormat('hi', 1, 1, 'image')).toEqual({
        replaceEnd: 1,
        replaceStart: 1,
        selectionLength: 4,
        selectionStart: 6,
        text: '\n![](LINK)\n',
      });
    });

    it('does not prefix an image with a newline at the start of a line', () => {
      expect(applyMarkdownFormat('hi', 0, 0, 'image')).toEqual({
        replaceEnd: 0,
        replaceStart: 0,
        selectionLength: 4,
        selectionStart: 4,
        text: '![](LINK)\n',
      });

      expect(applyMarkdownFormat('a\nb', 2, 2, 'image')).toEqual({
        replaceEnd: 2,
        replaceStart: 2,
        selectionLength: 4,
        selectionStart: 6,
        text: '![](LINK)\n',
      });
    });

    it('wraps a selection', () => {
      expect(applyMarkdownFormat('  hi  ', 0, 6, 'bold')).toEqual({
        replaceEnd: 4,
        replaceStart: 2,
        selectionLength: 6,
        selectionStart: 2,
        text: '**hi**',
      });
    });

    it('selects the url placeholder for links and images', () => {
      expect(applyMarkdownFormat('hello world', 6, 11, 'link')).toEqual({
        replaceEnd: 11,
        replaceStart: 6,
        selectionLength: 4,
        selectionStart: 14,
        text: '[world](LINK)',
      });

      expect(applyMarkdownFormat('hello world', 6, 11, 'image')).toEqual({
        replaceEnd: 11,
        replaceStart: 6,
        selectionLength: 4,
        selectionStart: 16,
        text: '\n![world](LINK)\n',
      });
    });

    it('applies blockquote and code block to full lines', () => {
      expect(applyMarkdownFormat('one\ntwo', 0, 7, 'blockquote')).toEqual({
        replaceEnd: 7,
        replaceStart: 0,
        selectionLength: 0,
        selectionStart: 11,
        text: '> one\n> two',
      });

      expect(applyMarkdownFormat('say hello there', 4, 9, 'blockquote')).toEqual({
        replaceEnd: 15,
        replaceStart: 0,
        selectionLength: 0,
        selectionStart: 17,
        text: '> say hello there',
      });

      expect(applyMarkdownFormat('say hello there', 4, 9, 'code_block')).toEqual({
        replaceEnd: 15,
        replaceStart: 0,
        selectionLength: 0,
        selectionStart: 23,
        text: '```\nsay hello there\n```',
      });
    });
  });
});
