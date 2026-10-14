// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { applyMarkdownFormat } from 'beatmap-discussions/markdown-format';

describe('beatmap-discussions/markdown-format', () => {
  describe('.applyMarkdownFormat', () => {
    it('places the cursor inside the markers when nothing is selected', () => {
      expect(applyMarkdownFormat('hi', 1, 1, 'bold')).toEqual({
        end: 1,
        selectionEnd: 3,
        selectionStart: 3,
        start: 1,
        text: '****',
      });
    });

    it('selects the url placeholder when an image is inserted with nothing selected', () => {
      expect(applyMarkdownFormat('hi', 1, 1, 'image')).toEqual({
        end: 1,
        selectionEnd: 10,
        selectionStart: 6,
        start: 1,
        text: '\n![](LINK)\n',
      });
    });

    it('does not prefix an image with a newline at the start of a line', () => {
      expect(applyMarkdownFormat('hi', 0, 0, 'image')).toEqual({
        end: 0,
        selectionEnd: 8,
        selectionStart: 4,
        start: 0,
        text: '![](LINK)\n',
      });

      expect(applyMarkdownFormat('a\nb', 2, 2, 'image')).toEqual({
        end: 2,
        selectionEnd: 10,
        selectionStart: 6,
        start: 2,
        text: '![](LINK)\n',
      });
    });

    it('wraps a selection', () => {
      expect(applyMarkdownFormat('  hi  ', 0, 6, 'bold')).toEqual({
        end: 4,
        selectionEnd: 8,
        selectionStart: 2,
        start: 2,
        text: '**hi**',
      });
    });

    it('selects the url placeholder for links and images', () => {
      expect(applyMarkdownFormat('hello world', 6, 11, 'link')).toEqual({
        end: 11,
        selectionEnd: 18,
        selectionStart: 14,
        start: 6,
        text: '[world](LINK)',
      });

      expect(applyMarkdownFormat('hello world', 6, 11, 'image')).toEqual({
        end: 11,
        selectionEnd: 20,
        selectionStart: 16,
        start: 6,
        text: '\n![world](LINK)\n',
      });
    });

    it('applies blockquote and code block to full lines', () => {
      expect(applyMarkdownFormat('one\ntwo', 0, 7, 'blockquote')).toEqual({
        end: 7,
        selectionEnd: 11,
        selectionStart: 11,
        start: 0,
        text: '> one\n> two',
      });

      expect(applyMarkdownFormat('say hello there', 4, 9, 'blockquote')).toEqual({
        end: 15,
        selectionEnd: 17,
        selectionStart: 17,
        start: 0,
        text: '> say hello there',
      });

      expect(applyMarkdownFormat('say hello there', 4, 9, 'code_block')).toEqual({
        end: 15,
        selectionEnd: 23,
        selectionStart: 23,
        start: 0,
        text: '```\nsay hello there\n```',
      });
    });
  });
});
