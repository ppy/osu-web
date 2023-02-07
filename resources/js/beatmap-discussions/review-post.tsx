// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { PersistedBeatmapDiscussionReview } from 'interfaces/beatmap-discussion-review';
import * as React from 'react';
import ReactMarkdown from 'react-markdown';
import { uuid } from 'utils/seq';
import autolink from './plugins/autolink';
import disableConstructs from './plugins/disable-constructs';
import { emphasisRenderer, linkRenderer, paragraphRenderer, strongRenderer, transformLinkUri } from './renderers';
import { ReviewPostEmbed } from './review-post-embed';

interface Props {
  message: string;
}

export class ReviewPost extends React.Component<Props> {
  embed(id: number) {
    return (
      <div key={uuid()} className='beatmapset-discussion-message'>
        <ReviewPostEmbed data={{ discussion_id: id }} />
      </div>
    );
  }

  paragraph(source: string) {
    return (
      <ReactMarkdown
        key={uuid()}
        className='beatmapset-discussion-message'
        components={{
          a: linkRenderer,
          em: emphasisRenderer,
          p: paragraphRenderer,
          strong: strongRenderer,
        }}
        remarkPlugins={[autolink, disableConstructs]}
        transformLinkUri={transformLinkUri}
        unwrapDisallowed
      >
        {source}
      </ReactMarkdown>
    );
  }

  render() {
    const docBlocks: JSX.Element[] = [];

    try {
      const doc = JSON.parse(this.props.message) as PersistedBeatmapDiscussionReview;

      doc.forEach((block) => {
        switch (block.type) {
          case 'paragraph': {
            const content = block.text.trim() === '' ? '&nbsp;' : block.text;
            docBlocks.push(this.paragraph(content));
            break;
          }
          case 'embed':
            if (block.discussion_id) {
              docBlocks.push(this.embed(block.discussion_id));
            }
            break;
        }
      });
    } catch (e) {
      docBlocks.push(<div key={uuid()}>[error parsing review]</div>);
    }

    return (
      <div className='beatmap-discussion-review-post'>
        {docBlocks}
      </div>
    );
  }
}
