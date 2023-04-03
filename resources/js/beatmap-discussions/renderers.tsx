// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { uriTransformer } from 'react-markdown';
import { ReactMarkdownProps } from 'react-markdown/lib/complex-types';
import { propsFromHref, timestampRegexGlobal } from 'utils/beatmapset-discussion-helper';
import { openBeatmapEditor } from 'utils/url';
import ImageLink from './image-link';

interface ImageNodeWithMarkdownProps extends React.ReactElement {
  props: ReactMarkdownProps & React.DetailedHTMLProps<React.ImgHTMLAttributes<HTMLImageElement>, HTMLImageElement>;
}

export function emphasisRenderer(astProps: ReactMarkdownProps & React.DetailedHTMLProps<React.HTMLAttributes<HTMLElement>, HTMLElement>) {
  return <em>{astProps.children.map(timestampDecorator)}</em>;
}

function isImageLink(node: React.ReactNode): node is ImageNodeWithMarkdownProps {
  return node != null && typeof node === 'object' && 'props' in node && node.type === ImageLink;
}

export function linkRenderer(astProps: ReactMarkdownProps & React.DetailedHTMLProps<React.AnchorHTMLAttributes<HTMLAnchorElement>, HTMLAnchorElement>) {
  const props = propsFromHref(astProps.href);

  // unwrap ImageLink because <a> in <a> is not valid.
  return <a {...props}>{props.children ?? astProps.children.map(unwrapImageLink)}</a>;
}

export function paragraphRenderer(astProps: ReactMarkdownProps & React.DetailedHTMLProps<React.HTMLAttributes<HTMLParagraphElement>, HTMLParagraphElement>) {
  return <p>{astProps.children.map(timestampDecorator)}</p>;
}

export function strongRenderer(astProps: ReactMarkdownProps & React.DetailedHTMLProps<React.HTMLAttributes<HTMLElement>, HTMLElement>) {
  return <strong>{astProps.children.map(timestampDecorator)}</strong>;
}

export function timestampDecorator(reactNode: React.ReactNode) {
  if (typeof reactNode === 'string') {
    const matches = [...reactNode.matchAll(timestampRegexGlobal)];

    if (matches.length > 0) {
      let cursor = 0;
      const nodes: React.ReactNode[] = [];

      for (const match of matches) {
        // insert any preceding text
        const index = match.index ?? 0;
        const textFragment = reactNode.substring(cursor, index);
        nodes.push(textFragment);

        // decorate the timestamp as a link
        const [,,, m, s, ms, range] = match;
        const timestamp = `${m}:${s}:${ms}${range ?? ''}`;

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

export function transformLinkUri(uri: string) {
  if (uri.startsWith('osu://edit/')) {
    // TODO: sanitize timestamp?
    return uri;
  }

  return uriTransformer(uri);
}

function unwrapImageLink(node: React.ReactNode) {
  if (!isImageLink(node)) return node;

  // remove the ReactMarkdown node prop; we're not using the other options, so they're not included.
  const { node: _propsNode, ...props } = node.props;
  return <img key={node.key} {...props} />;
}
