// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export type MarkdownFormat = 'blockquote' | 'bold' | 'code_block' | 'image' | 'inline_code' | 'italic' | 'link';

export function applyMarkdownFormat(value: string, start: number, end: number, format: MarkdownFormat) {
  switch (format) {
    case 'blockquote':
      return quote(value, start, end);
    case 'code_block':
      return codeBlock(value, start, end);
    case 'bold':
      return wrap(value, start, end, '**', '**');
    case 'inline_code':
      return wrap(value, start, end, '`', '`');
    case 'italic':
      return wrap(value, start, end, '*', '*');
    case 'link':
      return wrap(value, start, end, '[', '](LINK)');
    case 'image':
      return wrap(value, start, end, '\n![', '](LINK)\n');
  }
}

function codeBlock(value: string, start: number, end: number) {
  let text = '```\n' + value.slice(start, end) + '\n```';
  if (start > 0 && value[start - 1] !== '\n') text = `\n${text}`;
  if (end < value.length && value[end] !== '\n') text = `${text}\n`;

  const caret = start === end
    ? start + text.indexOf('```\n') + '```\n'.length
    : start + text.length;

  return { end, selectionEnd: caret, selectionStart: caret, start, text };
}

function quote(value: string, start: number, end: number) {
  const lineStart = value.lastIndexOf('\n', start - 1) + 1;
  const lineEnd = value.indexOf('\n', value[end - 1] === '\n' ? end - 1 : end);
  const to = lineEnd === -1 ? value.length : lineEnd;
  const text = value.slice(lineStart, to).split('\n').map((line) => `> ${line}`).join('\n');
  const caret = lineStart + text.length;

  return { end: to, selectionEnd: caret, selectionStart: caret, start: lineStart, text };
}

function wrap(value: string, start: number, end: number, open: string, close: string) {
  const raw = value.slice(start, end);
  const selected = raw.trim();
  const from = start + raw.length - raw.trimStart().length;
  const text = open + selected + close;
  if (selected === '') {
    // an empty image should still select LINK so the url can be typed immediately.
    const caret = from + open.length + (open.includes('![') ? close.indexOf('LINK') : 0);

    return {
      end: from,
      selectionEnd: open.includes('![') ? caret + 'LINK'.length : caret,
      selectionStart: caret,
      start: from,
      text,
    };
  }

  const urlAt = close.indexOf('LINK');
  const selectionStart = urlAt === -1 ? from : from + open.length + selected.length + urlAt;
  const selectionEnd = urlAt === -1 ? from + text.length : selectionStart + 'LINK'.length;

  return {
    end: from + selected.length,
    selectionEnd,
    selectionStart,
    start: from,
    text,
  };
}
