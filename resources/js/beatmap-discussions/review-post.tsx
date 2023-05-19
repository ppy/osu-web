// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { PersistedBeatmapDiscussionReview } from 'interfaces/beatmap-discussion-review';
import { BeatmapsetDiscussionMessagePostJson } from 'interfaces/beatmapset-discussion-post-json';
import * as React from 'react';
import DiscussionMessage from './discussion-message';
import { ReviewPostEmbed } from './review-post-embed';

interface Props {
  post: BeatmapsetDiscussionMessagePostJson;
}

export class ReviewPost extends React.Component<Props> {
  render() {
    const docBlocks: JSX.Element[] = [];

    try {
      const doc = JSON.parse(this.props.post.message) as PersistedBeatmapDiscussionReview;

      doc.forEach((block, index) => {
        switch (block.type) {
          case 'paragraph': {
            const content = block.text.trim() === '' ? '&nbsp;' : block.text;
            docBlocks.push(<DiscussionMessage key={index} markdown={content} type='reviews' />);
            break;
          }
          case 'embed':
            if (block.discussion_id) {
              docBlocks.push(<ReviewPostEmbed key={index} data={{ discussion_id: block.discussion_id }} />);
            }
            break;
        }
      });
    } catch (e) {
      docBlocks.push(<div key={null}>[error parsing review]</div>);
    }

    return (
      <div className='beatmap-discussion-review-post'>
        {docBlocks}
      </div>
    );
  }
}
