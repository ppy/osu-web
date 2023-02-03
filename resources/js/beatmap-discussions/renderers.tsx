// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { uriTransformer } from 'react-markdown';
import { ReactMarkdownProps } from 'react-markdown/lib/complex-types';
import { propsFromHref } from 'utils/beatmapset-discussion-helper';
import { openBeatmapEditor } from 'utils/url';

export function linkRenderer(astProps: ReactMarkdownProps & React.DetailedHTMLProps<React.AnchorHTMLAttributes<HTMLAnchorElement>, HTMLAnchorElement>) {
  const props = propsFromHref(astProps.href ?? '');

  return <a href={astProps.href} {...props}>{astProps.children}</a>;
}

function paragraphDecorator(reactNode: React.ReactNode) {
  if (typeof reactNode === 'string') {
    const matches = [...reactNode.matchAll(/\b(((\d{2,}):([0-5]\d)[:.](\d{3}))(\s\((?:\d+[,|])*\d+\))?)/g)];

    if (matches.length > 0) {
      let cursor = 0;
      const nodes: React.ReactNode[] = [];

      for (const match of matches) {
        // insert any preceding text
        const index = match.index ?? 0;
        const textFragment = reactNode.substring(cursor, index);
        nodes.push(textFragment);

        // decorate the timestamp as a link
        const timestamp = match[0];
        nodes.push((
          <a key={`timestamp-${index}`} className='beatmap-discussion-timestamp-decoration' href={openBeatmapEditor(timestamp)}>{timestamp}</a>
        ));

        cursor = index + match[0].length;
      }

      // add any remaining text
      nodes.push(reactNode.substring(cursor, reactNode.length));

      return nodes;
    }
  }

  return reactNode;
}

export function paragraphRenderer(astProps: ReactMarkdownProps & React.DetailedHTMLProps<React.HTMLAttributes<HTMLParagraphElement>, HTMLParagraphElement>) {
  return <div className='beatmapset-discussion-message'>{astProps.children.map(paragraphDecorator)}</div>;
}

export function transformLinkUri(uri: string) {
  if (uri.startsWith('osu://edit/')) {
    // TODO: sanitize timestamp?
    return uri;
  }

  return uriTransformer(uri);
}
