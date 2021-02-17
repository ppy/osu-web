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
            link: this.link,
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

  // not sure if any additional props besides href and children are included.
  private link(props: Readonly<ReactMarkdown.ReactMarkdownProps> & { href: string }) {
    // TODO: should probably context this so it's not reparsed every link
    const currentUrl = new URL(window.location.href);
    const currentBeatmapsetDiscussions = BeatmapDiscussionHelper.urlParse(currentUrl.href);

    const extraProps: React.AnchorHTMLAttributes<HTMLAnchorElement> = {
      target: '_blank',
    };

    const targetUrl = new URL(props.href);
    let linkText = props.href;

    if (targetUrl.host === currentUrl.host) {
      const targetBeatmapsetDiscussions = BeatmapDiscussionHelper.urlParse(targetUrl.href, null, { forceDiscussionId: true });
      if (targetBeatmapsetDiscussions?.discussionId != null) {
        if (currentBeatmapsetDiscussions?.beatmapsetId === targetBeatmapsetDiscussions.beatmapsetId) {
          // same beatmapset, format: #123
          linkText = `#${targetBeatmapsetDiscussions.discussionId}`;
          extraProps.className = 'js-beatmap-discussion--jump';
          extraProps.target = undefined;
        } else {
          // different beatmapset, format: 1234#567
          linkText = `${targetBeatmapsetDiscussions.beatmapsetId}#${targetBeatmapsetDiscussions.discussionId}`;
        }
      }
    }

    return <a rel='nofollow noreferrer' {...props} {...extraProps}>{linkText}</a>;
  }
}
