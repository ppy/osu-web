// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import React from 'react';
import ReactMarkdown from 'react-markdown';
import { ReactMarkdownProps } from 'react-markdown/lib/complex-types';
import rehypeTruncate from 'rehype-truncate';
import autolink from 'remark-plugins/autolink';
import disableConstructs, { DisabledType } from 'remark-plugins/disable-constructs';
import { maxMessagePreviewLength, propsFromHref } from 'utils/beatmapset-discussion-helper';
import { presence } from 'utils/string';
import { timestampDecorator, transformLinkUri } from './renderers';

interface Props {
  markdown: string;
  maxLength?: number;
  type?: DisabledType;
}

function imageRenderer(astProps: ReactMarkdownProps & React.DetailedHTMLProps<React.ImgHTMLAttributes<HTMLImageElement>, HTMLImageElement>) {
  // render something besides image url.
  return <>{presence(astProps.alt) ?? '[image]'}</>;
}

export function linkRenderer(astProps: ReactMarkdownProps & React.DetailedHTMLProps<React.AnchorHTMLAttributes<HTMLAnchorElement>, HTMLAnchorElement>) {
  const { sameHost, ...props } = propsFromHref(astProps.href ?? '', true);

  return sameHost ? <a href={astProps.href} {...props} /> : <>{props.children}</>;
}

function textRenderer(astProps: ReactMarkdownProps & React.DetailedHTMLProps<React.HTMLAttributes<HTMLElement>, HTMLElement>) {
  return <>{astProps.children.map(timestampDecorator)}</>;
}

export default class PlainTextPreview extends React.Component<Props> {
  render() {
    return (
      <ReactMarkdown
        className='plain-text-preview'
        components={{
          a: linkRenderer,
          code: textRenderer,
          em: textRenderer,
          img: imageRenderer,
          p: textRenderer,
          pre: textRenderer,
          strong: textRenderer,
        }}
        rehypePlugins={[[rehypeTruncate, { maxChars: this.props.maxLength ?? maxMessagePreviewLength }]]}
        remarkPlugins={[autolink, [disableConstructs, { type: this.props.type }]]}
        transformLinkUri={transformLinkUri}
        unwrapDisallowed
      >
        {this.props.markdown}
      </ReactMarkdown>
    );
  }
}
