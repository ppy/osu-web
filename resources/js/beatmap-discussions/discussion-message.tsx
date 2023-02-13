// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetDiscussionMessagePostJson } from 'interfaces/beatmapset-discussion-post-json';
import React from 'react';
import ReactMarkdown from 'react-markdown';
import { ReactMarkdownProps } from 'react-markdown/lib/complex-types';
import autolink from './plugins/autolink';
import disableConstructs from './plugins/disable-constructs';
import { emphasisRenderer, linkRenderer, paragraphRenderer, strongRenderer, transformLinkUri } from './renderers';

interface Props {
  markdown: string;
  post: BeatmapsetDiscussionMessagePostJson; // this is currently only for the media lookup
  type?: 'reviews';
}

export default class DiscussionMessage extends React.Component<Props> {
  render() {
    return (
      <div className='beatmapset-discussion-message'>
        <ReactMarkdown
          className='osu-md osu-md--discussions'
          components={{
            a: linkRenderer,
            em: emphasisRenderer,
            img: this.imageRenderer,
            p: paragraphRenderer,
            strong: strongRenderer,
          }}
          remarkPlugins={[autolink, [disableConstructs, { type: this.props.type }]]}
          transformLinkUri={transformLinkUri}
          unwrapDisallowed
        >
          {this.props.markdown}
        </ReactMarkdown>
      </div>
    );
  }

  private imageRenderer = (astProps: ReactMarkdownProps & React.DetailedHTMLProps<React.ImgHTMLAttributes<HTMLImageElement>, HTMLImageElement>) => {
    // TODO: don't render if not available proxied or fallback?
    const url = this.props.post.media_urls?.[astProps.src ?? ''];

    return (
      <a href={url} rel='nofollow noreferrer' target='_blank'>
        <img {...astProps.node.properties} src={url} />
      </a>
    );
  };
}
