// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import { applyMarkdownFormat } from './markdown-format';
import type { MarkdownFormat } from './markdown-format';

const formats: { format: MarkdownFormat; icon: string }[] = [
  { format: 'bold', icon: 'fas fa-bold' },
  { format: 'italic', icon: 'fas fa-italic' },
  { format: 'inline_code', icon: 'fas fa-code' },
  { format: 'link', icon: 'fas fa-link' },
  { format: 'image', icon: 'fas fa-image' },
  { format: 'blockquote', icon: 'fas fa-quote-left' },
  { format: 'code_block', icon: 'fas fa-file-code' },
];

interface Props {
  disabled?: boolean;
  textareaRef: React.RefObject<HTMLTextAreaElement>;
}

export function MarkdownSelectionToolbar(props: Props) {
  const handleMouseDown = React.useCallback((event: React.MouseEvent<HTMLButtonElement>) => {
    event.preventDefault();

    const format = event.currentTarget.dataset.format as MarkdownFormat | undefined;
    const textarea = props.textareaRef.current;
    if (format == null || textarea == null) return;

    const edit = applyMarkdownFormat(textarea.value, textarea.selectionStart, textarea.selectionEnd, format);

    textarea.focus();
    textarea.setSelectionRange(edit.start, edit.end);
    document.execCommand('insertText', false, edit.text);
    textarea.setSelectionRange(edit.selectionStart, edit.selectionEnd);
  }, [props.textareaRef]);

  return (
    <div className={classWithModifiers('post-box-toolbar', 'discussion')}>
      {formats.map((button) => (
        <button
          key={button.format}
          className='btn-circle btn-circle--bbcode'
          data-format={button.format}
          disabled={props.disabled}
          onMouseDown={handleMouseDown}
          title={trans(`beatmap_discussions.formatting.${button.format}`)}
          type='button'
        >
          <span className='btn-circle__content'>
            <span className={button.icon} />
          </span>
        </button>
      ))}
    </div>
  );
}
