// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as _ from 'lodash';
import * as markdown from 'remark-parse';
import { Node as SlateNode } from 'slate';
import * as unified from 'unified';
import { Node as UnistNode } from 'unist';
import { disableTokenizersPlugin } from './disable-tokenizers-plugin';

interface ParsedDocumentNode extends UnistNode {
  children: SlateNode[];
}

export function parseFromMarkdown(json: string, discussions: BeatmapDiscussion[]) {
    let srcDoc: any[];

    try {
      srcDoc = JSON.parse(json);
    } catch {
      console.error('error parsing srcDoc');

      return [];
    }

    const doc: ParsedDocumentNode[] = [];
    _.each(srcDoc, (block) => {
      switch (block.type) {
        // paragraph
        case 'paragraph':
          if (!osu.presence(block.text.trim())) {
            // empty block (aka newline)
            doc.push({
              children: [{
                text: '',
              }],
              type: 'paragraph',
            });
          } else {
            const processor = unified()
              .use(markdown)
              .use(disableTokenizersPlugin,
                {
                  allowedBlocks: ['paragraph'],
                  allowedInlines: ['emphasis', 'strong'],
                });
            const parsed = processor.parse(block.text) as ParsedDocumentNode;

            if (!parsed.children || parsed.children.length < 1) {
              console.error('children missing... ?');

              break;
            }

            doc.push({
              children: _.filter<SlateNode>(squash(parsed.children), (i) => i), // filter out null/undefined
              type: 'paragraph',
            });
          }
          break;
        case 'embed':
          // embed
          const discussion = discussions[block.discussion_id];
          if (!discussion) {
            return;
          }
          doc.push({
            beatmapId: discussion.beatmap_id,
            children: [{
              text: (discussion.starting_post || discussion.posts[0]).message,
            }],
            discussionId: discussion.id,
            discussionType: discussion.message_type,
            timestamp: discussion.timestamp,
            type: 'embed',
          });
          break;
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
function squash(items: SlateNode[], currentMarks?: {bold: boolean, italic: boolean}) {
  let flat: SlateNode[] = [];
  const marks = currentMarks ?? {
    bold: false,
    italic: false,
  };

  if (!items) {
    return [{text: ''}];
  }

  items.forEach((item: SlateNode) => {
    const newMarks = {
      bold: marks.bold || item.type === 'strong',
      italic: marks.italic || item.type === 'emphasis',
    };

    if (Array.isArray(item.children)) {
      flat = flat.concat(squash(item.children, newMarks));
    } else {
      const newItem: SlateNode = {
        text: item.value || '',
      };

      if (newMarks.bold) {
        newItem.bold = true;
      }

      if (newMarks.italic) {
        newItem.italic = true;
      }
      flat.push(newItem);
    }

  });

  return flat;
}
