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

import OsuUrlHelper from 'osu-url-helper';
import { Node, Parent } from 'unist';
import * as visit from 'unist-util-visit';

interface NodeWithValue extends Node {
  value: string;
}

export function timestampPlugin() {
  const regexPattern = /((\d{2,}:[0-5]\d[:.]\d{3})( \((?:\d[,|])*\d\))?)/g;

  return transformer;

  function transformer(tree: Node) {
    visit(tree, 'text', visitor);
  }

  function visitor(node: NodeWithValue, position: number, parent: Parent) {
    const nodes = [];
    let lastIndex = 0;

    const regex = new RegExp(regexPattern);
    let match = regex.exec(node.value);

    // early abort if no timestamps are found
    if (match === null) {
      return;
    }

    // iterate over matches and create nodes for each timestamp
    while (match !== null) {
      const [timestamp] = match;

      // node for text between matches (including before first match)
      if (match.index !== lastIndex) {
        nodes.push(
          addPosition(node.value, lastIndex, match.index),
        );
      }

      nodes.push({
        children: [
          {type: 'text', value: timestamp},
        ],
        href: OsuUrlHelper.openBeatmapEditor(timestamp),
        type: 'timestamp',
      });

      lastIndex = match.index + timestamp.length;

      match = regex.exec(node.value);
    }

    // node for text after last match
    if (lastIndex !== node.value.length) {
      nodes.push(
        addPosition(node.value, lastIndex, node.value.length),
      );
    }

    parent.children = nodes;
  }

  function addPosition(str: string, start: number, end: number) {
    const startLine = str.slice(0, start).split('\n');
    const endLine = str.slice(0, end).split('\n');

    return {
      position: {
        end: {
          column: endLine[endLine.length - 1].length + 1,
          line: endLine.length,
        },
        start: {
          column: startLine[startLine.length - 1].length + 1,
          line: startLine.length,
        },
      },
      type: 'text',
      value: str.slice(start, end),
    };
  }
}
