// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import { applyMarkdownFormat, formats, icons } from './markdown-format';
import type { MarkdownFormat } from './markdown-format';

interface Props {
  disabled?: boolean;
  textareaRef: React.RefObject<HTMLTextAreaElement>;
}

// prevent the textarea from losing focus
function handleMouseDown(event: React.MouseEvent) {
  event.preventDefault();
}

export default function MarkdownSelectionToolbar(props: Props) {
  const handleClick = React.useCallback((event: React.MouseEvent<HTMLButtonElement>) => {
    const format = event.currentTarget.dataset.format as MarkdownFormat | undefined;
    const textarea = props.textareaRef.current;
    if (format == null || textarea == null) return;

    const edit = applyMarkdownFormat(textarea.value, textarea.selectionStart, textarea.selectionEnd, format);

    textarea.focus();
    textarea.setSelectionRange(edit.replaceStart, edit.replaceEnd);
    document.execCommand('insertText', false, edit.text);
    textarea.setSelectionRange(edit.selectionStart, edit.selectionStart + edit.selectionLength);
  }, [props.textareaRef]);

  return (
    <div className={classWithModifiers('post-box-toolbar', 'discussion')}>
      {formats.map((format) => (
        <button
          key={format}
          className='btn-circle btn-circle--bbcode'
          data-format={format}
          disabled={props.disabled}
          onClick={handleClick}
          onMouseDown={handleMouseDown}
          title={trans(`beatmap_discussions.formatting.${format}`)}
          type='button'
        >
          <span className='btn-circle__content'>
            <span className={icons[format]} />
          </span>
        </button>
      ))}
    </div>
  );
}
