// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Portal } from 'portal';
import { useEffect, useRef } from 'react';
import * as React from 'react';
import { Editor, Range } from 'slate';
import { ReactEditor, useSlate } from 'slate-react';
import { isFormatActive, toggleFormat } from './editor-formatting';

const bn = 'beatmap-discussion-editor-toolbar';

export const EditorToolbar = () => {
  const ref = useRef({} as HTMLDivElement);
  const editor = useSlate();

  const ToolbarButton = ({ format }: { format: string }) => (
    <button
      className={osu.classWithModifiers(`${bn}__button`, [isFormatActive(editor, format) ? 'active' : ''])}
      // we use onMouseDown instead of onClick here so the popup remains visible after clicking
      // tslint:disable-next-line:jsx-no-lambda
      onMouseDown={(event) => {
        event.preventDefault();
        toggleFormat(editor, format);
      }}
    >
      <i className={`fas fa-${format}`} />
    </button>
  );

  useEffect(() => {
    const el = ref.current;
    const { selection } = editor;

    if (!el) {
      return;
    }

    if (
      !selection ||
      !ReactEditor.isFocused(editor) ||
      Range.isCollapsed(selection) ||
      Editor.string(editor, selection) === ''
    ) {
      el.style.display = 'none';
      return;
    }

    const domSelection = window.getSelection();
    const domRange = domSelection?.getRangeAt(0);

    if (domRange) {
      const rect = domRange.getBoundingClientRect();
      el.style.display = 'block';
      el.style.top = `${rect.top + window.pageYOffset - el.offsetHeight - 10}px`;
      el.style.left = `${rect.left + ((window.pageXOffset - el.offsetWidth) / 2) + (rect.width / 2)}px`;
    }
  });

  return (
    <Portal>
      <div
        className={bn}
        ref={ref}
      >
        <ToolbarButton format='bold' />
        <ToolbarButton format='italic' />
        <div className={`${bn}__popup-tail`} />
      </div>
    </Portal>
  );
};
