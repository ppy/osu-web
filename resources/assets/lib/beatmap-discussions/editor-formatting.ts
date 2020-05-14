// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Editor, Text, Transforms } from 'slate';
import { ReactEditor } from 'slate-react';

export const isFormatActive = (editor: ReactEditor, format: string) => {
  const [match] = Editor.nodes(editor, {
    match: (n) => n[format] === true,
    mode: 'all',
  });
  return !!match;
};

export const toggleFormat = (editor: ReactEditor, format: string) => {
  Transforms.setNodes(
    editor,
    { [format]: isFormatActive(editor, format) ? null : true },
    { match: Text.isText, split: true },
  );
};
