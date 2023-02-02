// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { PersistedBeatmapDiscussionReview } from 'interfaces/beatmap-discussion-review';
import * as React from 'react';
import ReactMarkdown, { uriTransformer } from 'react-markdown';
import { ReactMarkdownProps } from 'react-markdown/lib/complex-types';
import { propsFromHref, timestampRegex } from 'utils/beatmapset-discussion-helper';
import { uuid } from 'utils/seq';
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
      <div key={uuid()} className='beatmap-discussion-review-post__block'>
        <ReviewPostEmbed data={{ discussion_id: id }} />
      </div>
    );
  }

  paragraph(source: string) {
    return (
      <ReactMarkdown
        key={uuid()}
        components={{
          a: this.linkRenderer,
          p: this.paragraphRenderer,
        }}
        remarkPlugins={[
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
        transformLinkUri={this.transformLinkUri}
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

  private linkRenderer = (astProps: ReactMarkdownProps & React.DetailedHTMLProps<React.AnchorHTMLAttributes<HTMLAnchorElement>, HTMLAnchorElement>) => {
    // format as timestamp if link text matches.
    if (typeof astProps.children[0] === 'string') {
      if (timestampRegex.exec(astProps.children[0]) != null) {
        return <a className='beatmap-discussion-timestamp-decoration' href={astProps.href}>{astProps.children}</a>;
      }
    }

    const props = propsFromHref(astProps.href ?? '');

    return <a {...props}>{astProps.children}</a>;
  };

  private paragraphRenderer = (astProps: ReactMarkdownProps & React.DetailedHTMLProps<React.HTMLAttributes<HTMLParagraphElement>, HTMLParagraphElement>) => (
    <div className='beatmap-discussion-review-post__block'>
      <div className='beatmapset-discussion-message'>{astProps.children}</div>
    </div>
  );

  private transformLinkUri = (uri: string) => {
    if (uri.startsWith('osu://edit/')) {
      // TODO: sanitize timestamp?
      return uri;
    }

    return uriTransformer(uri);
  };
}
