// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { SwitchError } from 'utils/switch-never';

export const formats = ['bold', 'italic', 'code_inline', 'link', 'image', 'blockquote', 'code_block'] as const;
export type MarkdownFormat = (typeof formats)[number];

export const icons: Record<MarkdownFormat, string> = {
  blockquote: 'fas fa-quote-left',
  bold: 'fas fa-bold',
  code_block: 'fas fa-file-code',
  code_inline: 'fas fa-code',
  image: 'fas fa-image',
  italic: 'fas fa-italic',
  link: 'fas fa-link',
};

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
  const { blockEnd, blockStart } = lineRange(value, start, end);
  const inner = value.slice(blockStart, blockEnd);
  const text = '```\n' + inner + '\n```';
  const selectionStart = inner === ''
    ? blockStart + '```\n'.length
    : blockStart + text.length;

  return {
    replaceEnd: blockEnd,
    replaceStart: blockStart,
    selectionLength: 0,
    selectionStart,
    text,
  };
}

function lineRange(value: string, start: number, end: number) {
  const blockStart = value.lastIndexOf('\n', start - 1) + 1;
  const newlineAt = value.indexOf('\n', end - 1);
  const blockEnd = newlineAt === -1 ? value.length : newlineAt;

  return { blockEnd, blockStart };
}

function quote(value: string, start: number, end: number) {
  const { blockEnd, blockStart } = lineRange(value, start, end);
  const text = value.slice(blockStart, blockEnd).replace(/(^|\n)/g, '$1> ');

  return {
    replaceEnd: blockEnd,
    replaceStart: blockStart,
    selectionLength: 0,
    selectionStart: blockStart + text.length,
    text,
  };
}

function wrap(value: string, start: number, end: number, open: string, close: string) {
  const raw = value.slice(start, end);
  const selected = raw.trim();
  start += raw.length - raw.trimStart().length;
  end = start + selected.length;
  if (open.startsWith('\n') && (start === 0 || value[start - 1] === '\n')) {
    open = open.slice(1);
  }

  const text = open + selected + close;
  let selectionStart: number;
  let selectionLength: number;
  if (selected === '') {
    // image should always select LINK so the url can be typed immediately.
    [selectionStart, selectionLength] = open.includes('![')
      ? [start + open.length + close.indexOf('LINK'), 'LINK'.length]
      : [start + open.length, 0];
  } else {
    const urlAt = close.indexOf('LINK');
    [selectionStart, selectionLength] = urlAt === -1
      ? [start, text.length]
      : [start + open.length + selected.length + urlAt, 'LINK'.length];
  }

  return {
    replaceEnd: end,
    replaceStart: start,
    selectionLength,
    selectionStart,
    text,
  };
}
