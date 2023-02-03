// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { PersistedBeatmapDiscussionReview } from 'interfaces/beatmap-discussion-review';
import * as React from 'react';
import ReactMarkdown, { uriTransformer } from 'react-markdown';
import { ReactMarkdownProps } from 'react-markdown/lib/complex-types';
import { propsFromHref } from 'utils/beatmapset-discussion-helper';
import { uuid } from 'utils/seq';
import { openBeatmapEditor } from 'utils/url';
import { ReviewPostEmbed } from './review-post-embed';

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
    const props = propsFromHref(astProps.href ?? '');

    return <a {...props}>{astProps.children}</a>;
  };

  private paragraphDecorator = (reactNode: React.ReactNode) => {
    if (typeof reactNode === 'string') {
      const matches = [...reactNode.matchAll(/\b(((\d{2,}):([0-5]\d)[:.](\d{3}))(\s\((?:\d+[,|])*\d+\))?)/g)];

      if (matches.length > 0) {
        let cursor = 0;
        const nodes: React.ReactNode[] = [];

        for (const match of matches) {
          // insert any preceding text
          const index = match.index ?? 0;
          const textFragment = reactNode.substring(cursor, index);
          nodes.push(textFragment);

          // decorate the timestamp as a link
          const timestamp = match[0];
          nodes.push((
            <a key={`timestamp-${index}`} className='beatmap-discussion-timestamp-decoration' href={openBeatmapEditor(timestamp)}>{timestamp}</a>
          ));

          cursor = index + match[0].length;
        }

        // add any remaining text
        nodes.push(reactNode.substring(cursor, reactNode.length));

        return nodes;
      }
    }

    return reactNode;
  };

  private paragraphRenderer = (astProps: ReactMarkdownProps & React.DetailedHTMLProps<React.HTMLAttributes<HTMLParagraphElement>, HTMLParagraphElement>) => (
    <div className='beatmap-discussion-review-post__block'>
      <div className='beatmapset-discussion-message'>{astProps.children.map(this.paragraphDecorator)}</div>
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
