// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { uriTransformer } from 'react-markdown';
import { propsFromHref, timestampRegexGlobal } from 'utils/beatmapset-discussion-helper';
import { openBeatmapEditor, safeReactMarkdownUrl } from 'utils/url';

export const LinkContext = React.createContext({ inLink: false });

export function createRenderer(ElementType: React.ElementType) {
  return function defaultRenderer(astProps: { children: React.ReactNode }) {
    return <ElementType>{timestampDecorator(astProps.children)}</ElementType>;
  };
}

export function linkRenderer(astProps: JSX.IntrinsicElements['a']) {
  const props = propsFromHref(astProps.href);
  const href = safeReactMarkdownUrl(props.href);

  const useLinkText = props.children == null
    || astProps.children instanceof Array
      && astProps.children.length > 0
      && astProps.children[0] !== astProps.href;

  const content = useLinkText
    ? astProps.children
    : props.children;

  return (
    <LinkContext.Consumer>
      {({ inLink }) => (
        <LinkContext.Provider value={{ inLink: true }}>
          {inLink ? content : <a {...props} href={href}>{content}</a>}
        </LinkContext.Provider>
      )}
    </LinkContext.Consumer>
  );
}

export function timestampDecorator(reactNode: React.ReactNode): React.ReactNode {
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
  } else if (Array.isArray(reactNode)) {
    return reactNode.map(timestampDecorator);
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
