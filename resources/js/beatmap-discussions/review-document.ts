// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetDiscussionJsonForBundle, BeatmapsetDiscussionJsonForShow } from 'interfaces/beatmapset-discussion-json';
import * as markdown from 'remark-parse';
import { Element, Text } from 'slate';
import * as unified from 'unified';
import type { Parent, Node as UnistNode } from 'unist';
import { formatTimestamp, startingPost } from 'utils/beatmapset-discussion-helper';
import { present } from 'utils/string';
import { BeatmapDiscussionReview, isBeatmapReviewDiscussionType, PersistedDocumentIssueEmbed } from '../interfaces/beatmap-discussion-review';
import { disableTokenizersPlugin } from './disable-tokenizers-plugin';

interface ParsedDocumentNode extends UnistNode {
  children: UnistNode[];
  // position: we don't care about position
  type: 'root';
}

interface TextNode extends UnistNode {
  type: 'text';
  value: string;
}

function isParentNode(node: UnistNode): node is Parent {
  return Array.isArray(node.children);
}

function isText(node: UnistNode): node is TextNode {
  return node.type === 'text';
}

export function parseFromJson(json: string, discussions: Partial<Record<number, BeatmapsetDiscussionJsonForBundle | BeatmapsetDiscussionJsonForShow>>) {
  let srcDoc: BeatmapDiscussionReview;

  try {
    srcDoc = JSON.parse(json) as BeatmapDiscussionReview;
  } catch {
    console.error('error parsing srcDoc');

    return [];
  }

  const processor = unified()
    .use(markdown)
    .use(disableTokenizersPlugin,
      {
        allowedBlocks: ['paragraph'],
        allowedInlines: ['emphasis', 'strong'],
      });

  const doc: Element[] = [];
  srcDoc.forEach((block) => {
    switch (block.type) {
      // paragraph
      case 'paragraph': {
        if (!present(block.text.trim())) {
          // empty block (aka newline)
          doc.push({
            children: [{
              text: '',
            }],
            type: 'paragraph',
          });
        } else {
          const parsed = processor.parse(block.text) as ParsedDocumentNode;

          if (parsed.children == null || parsed.children.length < 1) {
            console.error('children missing... ?');
            break;
          }

          doc.push({
            children: squash(parsed.children),
            type: 'paragraph',
          });
        }
        break;
      }
      case 'embed': {
        // embed
        const existingEmbedBlock = block as PersistedDocumentIssueEmbed;
        const discussion = discussions[existingEmbedBlock.discussion_id];
        if (discussion == null) {
          console.error('unknown/external discussion referenced', existingEmbedBlock.discussion_id);
          break;
        }

        if (!isBeatmapReviewDiscussionType(discussion.message_type)) {
          console.error('unsupported embed type', discussion.message_type);
          break;
        }

        const post = startingPost(discussion);
        if (post.system) {
          console.error('embed should not have system starting post', existingEmbedBlock.discussion_id);
          break;
        }

        doc.push({
          beatmapId: discussion.beatmap_id,
          children: [{
            text: post.message,
          }],
          discussionId: discussion.id,
          discussionType: discussion.message_type,
          timestamp: discussion.timestamp != null ? formatTimestamp(discussion.timestamp) : undefined,
          type: 'embed',
        });
        break;
      }
      default:
        console.error('unknown block encountered', block);
    }
  });

  return doc;
}

//
// This function recursively 'squashes' a tree, moving all nested children up to the top-most level and removes nodes
// that were used for marks, instead adding them as properties on nodes (as slate expects).
//
// e.g.:
// paragraph -> strong -> emphasis -> text
//   becomes:
// paragraph -> text (with bold and italic properties set)
//
function squash(items: (UnistNode | Parent)[], currentMarks?: { bold: boolean; italic: boolean }) {
  let flat: Text[] = [];
  const marks = currentMarks ?? {
    bold: false,
    italic: false,
  };

  items.forEach((item) => {
    const newMarks = {
      bold: marks.bold || item.type === 'strong',
      italic: marks.italic || item.type === 'emphasis',
    };

    if (isParentNode(item)) {
      flat = flat.concat(squash(item.children, newMarks));
    } else if (isText(item)) {
      flat.push({
        bold: newMarks.bold,
        italic: newMarks.italic,
        text: item.value,
      });
    }
  });

  return flat;
}
