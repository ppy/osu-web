// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { EmbedElement, ParagraphElement } from 'editor';
import {
  BeatmapDiscussionReview,
  DocumentIssueEmbed,
} from 'interfaces/beatmap-discussion-review';
import { Editor, Element as SlateElement, Node as SlateNode, Range as SlateRange, Text, Transforms } from 'slate';
import { parseTimestamp } from 'utils/beatmapset-discussion-helper';

export const blockCount = (input: SlateElement[]) => input.length;

export const slateDocumentIsEmpty = (doc: SlateElement[]) => doc.length === 0 || (
  doc.length === 1 &&
      doc[0].type === 'paragraph' &&
      doc[0].children.length === 1 &&
      doc[0].children[0].text === ''
);

export const insideEmbed = (editor: Editor) => {
  const node = getCurrentNode(editor);
  if (node == null) return false;

  return 'type' in node && node.type === 'embed';
};

export const insideEmptyNode = (editor: Editor) => {
  const parent = getCurrentNode(editor);
  if (parent == null) return false;

  if ('type' in parent) {
    return Editor.isEmpty(editor, parent);
  }

  return false;
};

export const isFormatActive = (editor: Editor, format: 'bold' | 'italic') => {
  const [match] = Editor.nodes(editor, {
    match: (node) => Text.isText(node) && node[format] === true,
    mode: 'all',
  });
  return !!match;
};

const getCurrentNode = (editor: Editor) => {
  if (editor.selection) {
    return SlateNode.parent(editor, SlateRange.start(editor.selection).path);
  }
};

export const toggleFormat = (editor: Editor, format: 'bold' | 'italic') => {
  Transforms.setNodes(
    editor,
    { [format]: isFormatActive(editor, format) ? null : true },
    { match: (node) => Text.isText(node), split: true },
  );
};

// TODO: check typing
function serializeEmbed(node: EmbedElement): DocumentIssueEmbed {
  if (node.discussionId != null) {
    return {
      discussion_id: node.discussionId,
      type: 'embed',
    };
  } else {
    return {
      beatmap_id: node.beatmapId ?? null,
      discussion_type: node.discussionType,
      text: node.children[0].text,
      timestamp: node.timestamp ? parseTimestamp(node.timestamp) : null,
      type: 'embed',
    };
  }
}

function serializeParagraph(node: ParagraphElement) {
  const childOutput: string[] = [];
  const currentMarks = {
    bold: false,
    italic: false,
  };

  node.children.forEach((child) => {
    if (child.text !== '') {
      if (currentMarks.bold !== (child.bold ?? false)) {
        currentMarks.bold = (child.bold as boolean) ?? false;
        childOutput.push('**');
      }

      if (currentMarks.italic !== (child.italic ?? false)) {
        currentMarks.italic = (child.italic as boolean) ?? false;
        childOutput.push('*');
      }
    }

    childOutput.push((child.text).replace('*', '\\*'));
  });

  // ensure closing of open tags
  if (currentMarks.bold) {
    childOutput.push('**');
  }
  if (currentMarks.italic) {
    childOutput.push('*');
  }

  return childOutput.join('');
}

export const slateDocumentContainsNewProblem = (input: SlateElement[]) =>
  input.some((node) => node.type === 'embed' && node.discussionType === 'problem' && !node.discussionId);

export const serializeSlateDocument = (input: SlateElement[]) => {
  const review: BeatmapDiscussionReview = [];

  input.forEach((node) => {
    switch (node.type) {
      case 'paragraph':
        review.push({
          text: serializeParagraph(node),
          type: 'paragraph',
        });
        break;

      case 'embed':
        review.push(serializeEmbed(node));
        break;
    }
  });

  // strip last block if it's empty (i.e. the placeholder that allows easier insertion at the end of a document)
  const lastBlock = review[review.length - 1];
  if (lastBlock.type === 'paragraph' && !osu.present(lastBlock.text)) {
    review.pop();
  }

  return JSON.stringify(review);
};
