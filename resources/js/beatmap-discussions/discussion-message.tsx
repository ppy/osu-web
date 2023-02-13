// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import React from 'react';
import ReactMarkdown from 'react-markdown';
import ImageLink from './image-link';
import autolink from './plugins/autolink';
import disableConstructs from './plugins/disable-constructs';
import { emphasisRenderer, linkRenderer, paragraphRenderer, strongRenderer, transformLinkUri } from './renderers';

interface Props {
  markdown: string;
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
            img: ImageLink,
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
}
