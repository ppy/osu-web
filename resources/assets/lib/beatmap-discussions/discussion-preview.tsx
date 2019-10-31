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
import { useContext } from 'react';
import * as ReactMarkdown from 'react-markdown';
import { BeatmapIcon } from '../beatmap-icon';
import { BeatmapsContext } from './beatmaps-context';
import { DiscussionsContext } from './discussions-context';

interface EmbedProps {
  data: {
    discussion_id: number;
  };
}

export class DiscussionPreview extends React.Component<any> {
  embed = (props: EmbedProps) => {
    const discussions = useContext(DiscussionsContext);
    const beatmaps = useContext(BeatmapsContext);

    const discussion: BeatmapDiscussion = discussions[props.data.discussion_id];
    const icons: {[type: string]: string} = {
      hype: 'fas fa-bullhorn',
      mapperNote: 'far fa-sticky-note',
      praise: 'fas fa-heart',
      problem: 'fas fa-exclamation-circle',
      suggestion: 'far fa-circle',
    };

    return (
      <div className='beatmap-discussion beatmap-discussion--preview'>
        <div className='beatmap-discussion__discussion'>
            <div className='beatmap-discussion-post beatmap-discussion-post--reply'>
                <div className='beatmap-discussion-post__content'>
                    <div className='beatmap-discussion-newer__dropdown'>
                      {discussion.beatmap_id &&
                        <BeatmapIcon
                          beatmap={beatmaps[discussion.beatmap_id]}
                        />
                      }
                    </div>
                    <div className='beatmap-discussion-post__user-container'>
                      <div className='beatmap-discussion-timestamp__icons-container' style={{marginRight: '10px'}}>
                        <div className='beatmap-discussion-timestamp__icon'>
                          <span className={`beatmap-discussion-message-type beatmap-discussion-message-type--${discussion.message_type}`}><i className={icons[discussion.message_type]} /></span>
                        </div>
                        <div className='beatmap-discussion-timestamp__text'>{discussion.timestamp || '00:00.000'}</div>
                      </div>
                      <div style={{backgroundColor: 'hsl(var(--base-hue), 10%, 15%)'}} className='beatmap-discussion-post__user-stripe'/>
                    </div>
                    <div className='beatmap-discussion-post__message-container undefined'>
                        <div className='beatmapset-discussion-message'>{discussion.posts[0].message}</div>
                        <div className='beatmap-discussion-post__actions'>
                            <div className='beatmap-discussion-post__actions-group'>
                                <a className='beatmap-discussion-post__action beatmap-discussion-post__action--button' href='#'>&nbsp;</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    );
  }

  render() {
    return (
      <ReactMarkdown
        allowedTypes={[
          'text',
          'emphasis',
          'strong',
          'paragraph',
        ]}
        plugins={[
          require('./markdown-embed-tokenizer'),
        ]}
        source={this.props.message}
        renderers={{
          embed: this.embed,
          paragraph: (props) => <div style={{marginBottom: '10px'}} {...props}/>,
        }}
      />
    );
  }
}
