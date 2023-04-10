// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import React from 'react';
import ReactMarkdown from 'react-markdown';
import rehypeTruncate from 'rehype-truncate';
import autolink from 'remark-plugins/autolink';
import disableConstructs, { DisabledType } from 'remark-plugins/disable-constructs';
import { maxMessagePreviewLength, propsFromHref } from 'utils/beatmapset-discussion-helper';
import { presence } from 'utils/string';
import { timestampDecorator, transformLinkUri } from './renderers';

const components = Object.freeze({
  a: linkRenderer,
  code: textRenderer,
  em: textRenderer,
  img: imageRenderer,
  p: textRenderer,
  pre: textRenderer,
  strong: textRenderer,
});

interface Props {
  markdown: string;
  maxLength?: number;
  type?: DisabledType;
}

function imageRenderer(astProps: JSX.IntrinsicElements['img']) {
  // render something besides image url.
  return <>{presence(astProps.alt) ?? '[image]'}</>;
}

export function linkRenderer(astProps: JSX.IntrinsicElements['a']) {
  const props = propsFromHref(astProps.href);

  return props.children != null ? <a {...props} /> : <>{astProps.children}</>;
}

function textRenderer(astProps: JSX.IntrinsicElements[keyof JSX.IntrinsicElements]) {
  return <>{timestampDecorator(astProps.children)}</>;
}

export default class PlainTextPreview extends React.Component<Props> {
  render() {
    return (
      <ReactMarkdown
        className='plain-text-preview'
        components={components}
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
