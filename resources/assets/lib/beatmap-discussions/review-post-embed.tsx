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
import { FunctionComponent } from 'react';
import { BeatmapIcon } from '../beatmap-icon';
import { BeatmapsContext } from './beatmaps-context';
import { DiscussionsContext } from './discussions-context';

interface Props {
  data: {
    discussion_id: number;
  };
}

export const ReviewPostEmbed: FunctionComponent<Props> = ({data}) => {
  const bn = 'beatmap-discussion-review-post-embed';
  const discussions = React.useContext(DiscussionsContext);
  const beatmaps = React.useContext(BeatmapsContext);
  const discussion = discussions[data.discussion_id];

  if (!discussion) {
    // this should never happen, but just in case...
    return (
      <div className={bn}>
        <div className={`${bn}__error`}>[DISCUSSION NOT LOADED]</div>
      </div>
    );
  }

  const additionalClasses = [];
  if (discussion.message_type === 'praise') {
    additionalClasses.push('praise');
  } else if (discussion.resolved) {
    additionalClasses.push('resolved');
  }

  const hasBeatmap = discussion.beatmap_id !== null;
  if (!hasBeatmap) {
    additionalClasses.push('general-all');
  }

  const messageTypeIcon = () => {
    return (
      <div className={`beatmap-discussion-message-type beatmap-discussion-message-type--${discussion.message_type}`}><i className={BeatmapDiscussionHelper.messageType.icon[discussion.message_type]} /></div>
    );
  };

  const timestamp = () => {
    return (
      <div className={`${bn}__timestamp-text`}>
        {
          discussion.timestamp !== null
            ? BeatmapDiscussionHelper.formatTimestamp(discussion.timestamp)
            : osu.trans(`beatmap_discussions.timestamp_display.${hasBeatmap ? 'general' : 'general_all'}`)
        }
      </div>
    );
  };

  return (
    <div className={osu.classWithModifiers(bn, additionalClasses)}>
      <div className={`${bn}__meta`}>
        <div className={`${bn}__icon`}>
          {/* if there's no associated beatmap, show the issue type icon here... otherwise show it below */}
            {discussion.beatmap_id &&
              <BeatmapIcon
                beatmap={beatmaps[discussion.beatmap_id]}
              />
            }
            {!discussion.beatmap_id &&
              messageTypeIcon()
            }
        </div>
        <div>
          {discussion.beatmap_id &&
            messageTypeIcon()
          }
          {timestamp()}
        </div>
      </div>
      <div className={`${bn}__stripe`} />
      <div className={`${bn}__body`} dangerouslySetInnerHTML={{__html: BeatmapDiscussionHelper.format((discussion.starting_post || discussion.posts[0]).message)}} />
      {discussion.parent_id &&
        <div className={`${bn}__link`}>
          <a
              href={BeatmapDiscussionHelper.url({discussion})}
              className={`${bn}__link-text`}
              title={osu.trans('beatmap_discussions.review.go_to_child')}
          >
              <i className='fas fa-external-link-alt'/>
          </a>
        </div>
      }
    </div>
  );
};
