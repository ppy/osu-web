// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BaseEditor, BaseElement } from 'slate';
import { HistoryEditor } from 'slate-history';
import { ReactEditor } from 'slate-react';

interface EmbedElement extends BaseElement {
  beatmapId: number;
  discussionId?: number;
  discussionType: string;
  type: 'embed';
}

interface ParagraphElement extends BaseElement {
  type: 'paragraph';
}

type CustomEditor = BaseEditor & ReactEditor & HistoryEditor;
type CustomElement = EmbedElement | ParagraphElement;

declare module 'slate' {
  interface CustomTypes {
    Editor: CustomEditor;
    Element: CustomElement;
  }
}
