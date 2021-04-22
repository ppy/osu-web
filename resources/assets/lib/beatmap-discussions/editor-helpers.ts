// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import {
  BeatmapDiscussionReview,
  BeatmapReviewDiscussionType,
  DocumentIssueEmbed,
} from 'interfaces/beatmap-discussion-review';
import { Editor, Element as SlateElement, Node as SlateNode, Range as SlateRange, Text, Transforms } from 'slate';
import { ReactEditor } from 'slate-react';

export const blockCount = (input: SlateElement[]) => input.length;

export const slateDocumentIsEmpty = (doc: SlateElement[]): boolean => doc.length === 0 || (
  doc.length === 1 &&
      doc[0].type === 'paragraph' &&
      doc[0].children.length === 1 &&
      doc[0].children[0].text === ''
);

export const insideEmbed = (editor: ReactEditor) => getCurrentNode(editor)?.type === 'embed';

export const insideEmptyNode = (editor: ReactEditor) => {
  const parent = getCurrentNode(editor);
  if (!parent) {
    return false;
  }

  return Editor.isEmpty(editor, parent);
};

export const isFormatActive = (editor: ReactEditor, format: string) => {
  const [match] = Editor.nodes(editor, {
    match: (n) => n[format] === true,
    mode: 'all',
  });
  return !!match;
};

export const getCurrentNode = (editor: ReactEditor) => {
  if (editor.selection) {
    return SlateNode.parent(editor, SlateRange.start(editor.selection).path);
  }
};

export const toggleFormat = (editor: ReactEditor, format: string) => {
  Transforms.setNodes(
    editor,
    { [format]: isFormatActive(editor, format) ? null : true },
    { match: (node) => Text.isText(node), split: true },
  );
};

// TODO: check typing
function serializeEmbed(node: SlateElement): DocumentIssueEmbed {
  if (node.discussionId) {
    return {
      discussion_id: node.discussionId as number,
      type: 'embed',
    };
  } else {
    return {
      beatmap_id: node.beatmapId as number,
      discussion_type: node.discussionType as BeatmapReviewDiscussionType,
      text: node.children[0].text as string,
      timestamp: node.timestamp ? BeatmapDiscussionHelper.parseTimestamp(node.timestamp as string) : null,
      type: 'embed',
    };
  }
}

function serializeParagraph(node: SlateElement) {
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

    childOutput.push((child.text as string).replace('*', '\\*'));
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
