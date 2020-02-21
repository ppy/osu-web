/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import * as _ from 'lodash';
import * as markdown from 'remark-parse';
import { Node as SlateNode } from 'slate';
import * as unified from 'unified';

export function parseFromMarkdown(json: string, discussions: BeatmapDiscussion[]) {
    let srcDoc: any[];

    try {
      srcDoc = JSON.parse(json);
    } catch {
      console.log('failed to parse srcDoc');
      return;
    }

    const doc: SlateNode = [];
    _.each(srcDoc, (block) => {
      switch (block.type) {
        // paragraph
        case 'paragraph':
          if (!osu.presence(block.text)) {
            // empty block (aka newline)
            doc.push({
              children: [{
                text: '',
              }],
              type: 'paragraph',
            });
          } else {
            const processor = unified().use(markdown);
            const parsed = processor.parse(block.text);
            if (!parsed.children || parsed.children.length < 1) {
              break;
            }
            const rootNode = parsed.children[0];

            doc.push({
              children: _.filter(squash(rootNode.children), (i) => i), // filter out null/undefined
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
            discussionType: discussion.message_type,
            timestamp: discussion.timestamp,
            type: 'embed',
          });
          break;
      }
    });

    return doc;
}

function squash(items: SlateNode[], currentMarks?: {bold: boolean, italic: boolean}) {
  const flat: SlateNode[] = [];
  const marks = currentMarks ?? {
    bold: false,
    italic: false,
  };

  items.forEach((item: SlateNode) => {
    const newMarks = {
      bold: marks.bold || item.type === 'strong',
      italic: marks.italic || item.type === 'emphasis',
    };

    if (item.type === 'link') {
      let c = squash(item.children, newMarks);
      if (c.length === 0) {
        c = [{
          text: item.url,
        }];
      }

      flat.push({
        children: c,
        type: 'link',
        url: item.url,
      });
    } else {
      if (Array.isArray(item.children)) {
        flat.push(squash(item.children, newMarks)[0]);
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
    }
  });

  return flat;
}
