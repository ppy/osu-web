/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import * as React from 'react';
import * as ReactMarkdown from 'react-markdown';
import * as MarkdownEmbedTokenizer from './markdown-embed-tokenizer';
import { ReviewPostEmbed } from './review-post-embed';

interface Props {
  message: string;
}

export class ReviewPost extends React.Component<Props> {
  render() {
    return (
      <div className='beatmap-discussion-review-post'>
        <ReactMarkdown
          allowedTypes={[
            'text',
            'emphasis',
            'strong',
            'paragraph',
          ]}
          plugins={[
            MarkdownEmbedTokenizer,
          ]}
          source={this.props.message}
          renderers={{
            embed: ReviewPostEmbed,
            paragraph: (props) => <div className='beatmap-discussion-review-post__block' {...props}/>,
          }}
        />
      </div>
    );
  }
}
