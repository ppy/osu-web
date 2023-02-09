// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import React from 'react';
import ReactMarkdown from 'react-markdown';
import autolink from './plugins/autolink';
import disableConstructs from './plugins/disable-constructs';
import { emphasisRenderer, imageRenderer, linkRenderer, paragraphRenderer, strongRenderer, transformLinkUri } from './renderers';

interface Props {
  markdown: string;
  type?: 'reviews';
}

const DiscussionMessage = (props: Props) => (
  <div className='beatmapset-discussion-message'>
    <ReactMarkdown
      className='osu-md osu-md--discussions'
      components={{
        a: linkRenderer,
        em: emphasisRenderer,
        img: imageRenderer,
        p: paragraphRenderer,
        strong: strongRenderer,
      }}
      remarkPlugins={[autolink, [disableConstructs, { type: props.type }]]}
      transformLinkUri={transformLinkUri}
      unwrapDisallowed
    >
      {props.markdown}
    </ReactMarkdown>
  </div>
);

export default DiscussionMessage;
