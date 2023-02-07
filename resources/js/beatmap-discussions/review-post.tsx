// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { PersistedBeatmapDiscussionReview } from 'interfaces/beatmap-discussion-review';
import * as React from 'react';
import { uuid } from 'utils/seq';
import DiscussionMessage from './discussion-message';
import { ReviewPostEmbed } from './review-post-embed';

interface Props {
  message: string;
}

export class ReviewPost extends React.Component<Props> {
  embed(id: number) {
    return (
      <ReviewPostEmbed key={uuid()} data={{ discussion_id: id }} />
    );
  }

  paragraph(source: string) {
    return (
      <DiscussionMessage key={uuid()} markdown={source} />
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
