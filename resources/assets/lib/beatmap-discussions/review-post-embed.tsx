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
  const discussions = React.useContext(DiscussionsContext);
  const beatmaps = React.useContext(BeatmapsContext);
  const discussion: BeatmapDiscussion = discussions[data.discussion_id];
  const bn = 'beatmap-discussion-review-post-embed';

  if (!discussion) {
    // this should never happen, but just in case...
    return (
      <div className={bn}>
        <div className={`${bn}__message-container ${bn}__message-container--error`}>[DISCUSSION NOT LOADED]</div>
      </div>
    );
  }

  return (
    <div className={bn}>
      <div className={`${bn}__beatmap-icon`}>
        {discussion.beatmap_id &&
        <BeatmapIcon
            beatmap={beatmaps[discussion.beatmap_id]}
        />
        }
      </div>
      <div className={`${bn}__timestamp`}>
        <div className={`${bn}__icons-container`}>
          <div className={`${bn}__icon`}>
            <span
              className={`beatmap-discussion-message-type beatmap-discussion-message-type--${discussion.message_type}`}
            >
              <i className={BeatmapDiscussionHelper.messageType.icon[discussion.message_type]}/>
            </span>
          </div>
          <div className={`${bn}__timestamp-text`}>
              {discussion.timestamp ? BeatmapDiscussionHelper.formatTimestamp(discussion.timestamp) : 'general'}
            </div>
        </div>
      </div>
      <div className={`${bn}__stripe`}/>
      <div
        className={`${bn}__message-container`}
        dangerouslySetInnerHTML={{__html: BeatmapDiscussionHelper.format(discussion.posts[0].message)}}
      />
    </div>
  );
};
