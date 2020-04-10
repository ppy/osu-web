// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ReactNode, useEffect, useRef } from 'react';
import * as React from 'react';
import { createPortal } from 'react-dom';
import { Editor, Range, Text, Transforms } from 'slate';
import { ReactEditor, useSlate } from 'slate-react';

export const EditorToolbar = () => {
  const bn = 'beatmap-discussion-editor-toolbar';
  const ref = useRef({} as HTMLDivElement);
  const editor = useSlate();

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
        className={`${bn}__popup`}
        ref={ref}
      >
        <ToolbarButton format='bold' />
        <ToolbarButton format='italic' />
        <div className={`${bn}__popup-tail`} />
      </div>
    </Portal>
  );
};

const Portal = ({children}: { children: ReactNode }) => createPortal(children, document.body);

const ToolbarButton = ({ format }: { format: string }) => {
  const bn = 'beatmap-discussion-editor-toolbar__button';
  const editor = useSlate();

  return (
    <button
      className={osu.classWithModifiers(bn, [isFormatActive(editor, format) ? 'active' : ''])}
      onMouseDown={(event) => {
        event.preventDefault();
        toggleFormat(editor, format);
      }}
    >
      <span className='btn-circle__content'>
          <i className={`fas fa-${format}`}/>
      </span>
    </button>
  );
};

const toggleFormat = (editor: Editor, format: string) => {
  const isActive = isFormatActive(editor, format);
  Transforms.setNodes(
    editor,
    { [format]: isActive ? null : true },
    { match: Text.isText, split: true },
  );
};

const isFormatActive = (editor: Editor, format: string) => {
  const [match] = Editor.nodes(editor, {
    match: (n) => n[format] === true,
    mode: 'all',
  });
  return !!match;
};
