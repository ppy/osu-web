// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Editor, Text, Transforms } from 'slate';
import { Node as SlateNode } from 'slate';
import { ReactEditor } from 'slate-react';
import { BeatmapDiscussionReview, DocumentIssueEmbed } from '../interfaces/beatmap-discussion-review';

export const slateDocumentIsEmpty = (doc: SlateNode[]): boolean => {
  return doc.length === 0 || (
      doc.length === 1 &&
      doc[0].type === 'paragraph' &&
      doc[0].children.length === 1 &&
      doc[0].children[0].text === ''
    );
};

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

export const slateDocumentContainsProblem = (input: SlateNode[]) =>
  input.some((node) => node.type === 'embed' && node.discussionType === 'problem');

export const serializeSlateDocument = (input: SlateNode[]) => {
  const review: BeatmapDiscussionReview = [];

  input.forEach((node: SlateNode) => {
    switch (node.type) {
      case 'paragraph':
        const childOutput: string[] = [];
        const currentMarks = {
          bold: false,
          italic: false,
        };

        node.children.forEach((child: SlateNode) => {
          if (child.text !== '') {
            if (currentMarks.bold !== (child.bold ?? false)) {
              currentMarks.bold = child.bold ?? false;
              childOutput.push('**');
            }

            if (currentMarks.italic !== (child.italic ?? false)) {
              currentMarks.italic = child.italic ?? false;
              childOutput.push('*');
            }
          }

          childOutput.push(child.text.replace('*', '\\*'));
        });

        // ensure closing of open tags
        if (currentMarks.bold) {
          childOutput.push('**');
        }
        if (currentMarks.italic) {
          childOutput.push('*');
        }

        review.push({
          text: childOutput.join(''),
          type: 'paragraph',
        });

        currentMarks.bold = currentMarks.italic = false;
        break;

      case 'embed':
        const doc: DocumentIssueEmbed = {
          beatmap_id: node.beatmapId,
          discussion_type: node.discussionType,
          text: node.children[0].text,
          timestamp: node.timestamp ? BeatmapDiscussionHelper.parseTimestamp(node.timestamp) : null,
          type: 'embed',
        };

        if (node.discussionId) {
          doc.discussion_id = node.discussionId;
        }

        review.push(doc);
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
