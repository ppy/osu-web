// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { SwitchError } from 'utils/switch-never';

export type MarkdownFormat = 'blockquote' | 'bold' | 'code_block' | 'code_inline' | 'image' | 'italic' | 'link';

export function applyMarkdownFormat(value: string, start: number, end: number, format: MarkdownFormat) {
  switch (format) {
    case 'blockquote':
      return quote(value, start, end);
    case 'code_block':
      return codeBlock(value, start, end);
    case 'bold':
      return wrap(value, start, end, '**', '**');
    case 'code_inline':
      return wrap(value, start, end, '`', '`');
    case 'italic':
      return wrap(value, start, end, '*', '*');
    case 'link':
      return wrap(value, start, end, '[', '](LINK)');
    case 'image':
      return wrap(value, start, end, '\n![', '](LINK)\n');
    default:
      throw new SwitchError(format);
  }
}

function codeBlock(value: string, start: number, end: number) {
  const { from, to } = lineRange(value, start, end);
  const inner = value.slice(from, to);
  const text = '```\n' + inner + '\n```';
  const caret = inner === ''
    ? from + '```\n'.length
    : from + text.length;

  return { end: to, selectionEnd: caret, selectionStart: caret, start: from, text };
}

function lineRange(value: string, start: number, end: number) {
  const from = value.lastIndexOf('\n', start - 1) + 1;
  const lineEnd = value.indexOf('\n', value[end - 1] === '\n' ? end - 1 : end);
  const to = lineEnd === -1 ? value.length : lineEnd;

  return { from, to };
}

function quote(value: string, start: number, end: number) {
  const { from, to } = lineRange(value, start, end);
  const text = value.slice(from, to).split('\n').map((line) => `> ${line}`).join('\n');
  const caret = from + text.length;

  return { end: to, selectionEnd: caret, selectionStart: caret, start: from, text };
}

function wrap(value: string, start: number, end: number, open: string, close: string) {
  const raw = value.slice(start, end);
  const selected = raw.trim();
  const from = start + raw.length - raw.trimStart().length;
  const prefix = open.startsWith('\n') && (from === 0 || value[from - 1] === '\n')
    ? open.slice(1)
    : open;
  const text = prefix + selected + close;
  if (selected === '') {
    // an empty image should still select LINK so the url can be typed immediately.
    const caret = from + prefix.length + (prefix.includes('![') ? close.indexOf('LINK') : 0);

    return {
      end: from,
      selectionEnd: prefix.includes('![') ? caret + 'LINK'.length : caret,
      selectionStart: caret,
      start: from,
      text,
    };
  }

  const urlAt = close.indexOf('LINK');
  const selectionStart = urlAt === -1 ? from : from + prefix.length + selected.length + urlAt;
  const selectionEnd = urlAt === -1 ? from + text.length : selectionStart + 'LINK'.length;

  return {
    end: from + selected.length,
    selectionEnd,
    selectionStart,
    start: from,
    text,
  };
}
