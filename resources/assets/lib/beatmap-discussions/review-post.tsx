// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { PersistedBeatmapDiscussionReview } from 'interfaces/beatmap-discussion-review';
import * as React from 'react';
import * as ReactMarkdown from 'react-markdown';
import { autolinkPlugin } from './autolink-plugin';
import { disableTokenizersPlugin } from './disable-tokenizers-plugin';
import { ReviewPostEmbed } from './review-post-embed';
import { timestampPlugin } from './timestamp-plugin';

interface Props {
  message: string;
}

export class ReviewPost extends React.Component<Props> {
  embed(id: number) {
    return (
      <div className='beatmap-discussion-review-post__block' key={osu.uuid()}>
        <ReviewPostEmbed data={{discussion_id: id}} />
      </div>
    );
  }

  paragraph(source: string) {
    return (
        <ReactMarkdown
          plugins={[
            [
              disableTokenizersPlugin,
              {
                allowedBlocks: ['paragraph'],
                allowedInlines: ['emphasis', 'strong'],
              },
            ],
            autolinkPlugin,
            timestampPlugin,
          ]}
          key={osu.uuid()}
          source={source}
          unwrapDisallowed={true}
          renderers={{
            link: (props) => <a rel='nofollow' {...props}/>,
            paragraph: (props) => {
              return <div className='beatmap-discussion-review-post__block'>
                <div className='beatmapset-discussion-message' {...props}/>
              </div>;
            },
            timestamp: (props) => <a className='beatmap-discussion-timestamp-decoration' {...props}/>,
          }}
        />
    );
  }

  render() {
    const docBlocks: JSX.Element[] = [];

    try {
      const doc: PersistedBeatmapDiscussionReview = JSON.parse(this.props.message);

      doc.forEach((block) => {
        switch (block.type) {
          case 'paragraph':
            const content = block.text.trim() === '' ? '&nbsp;' : block.text;
            docBlocks.push(this.paragraph(content));
            break;
          case 'embed':
            if (block.discussion_id) {
              docBlocks.push(this.embed(block.discussion_id));
            }
            break;
        }
      });
    } catch (e) {
      docBlocks.push(<div key={osu.uuid()}>[error parsing review]</div>);
    }

    return (
      <div className='beatmap-discussion-review-post'>
        {docBlocks}
      </div>
    );
  }
}
