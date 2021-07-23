// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapIcon } from 'beatmap-icon';
import osu from 'osu-common';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { BeatmapsContext } from './beatmaps-context';
import { DiscussionsContext } from './discussions-context';

interface Props {
  data: {
    discussion_id: number;
  };
}

export const ReviewPostEmbed = ({ data }: Props) => {
  const bn = 'beatmap-discussion-review-post-embed-preview';
  const discussions = React.useContext(DiscussionsContext);
  const beatmaps = React.useContext(BeatmapsContext);
  const discussion = discussions[data.discussion_id];

  if (!discussion) {
    // if a discussion has been deleted or is otherwise missing
    return (
      <div className={classWithModifiers(bn, ['deleted', 'lighter'])}>
        <div className={`${bn}__missing`}>{osu.trans('beatmaps.discussions.review.embed.missing')}</div>
      </div>
    );
  }

  const beatmap = discussion.beatmap_id == null ? undefined : beatmaps[discussion.beatmap_id];

  const additionalClasses = ['lighter'];
  if (discussion.message_type === 'praise') {
    additionalClasses.push('praise');
  } else if (discussion.resolved) {
    additionalClasses.push('resolved');
  }

  const hasBeatmap = discussion.beatmap_id !== null;
  if (!hasBeatmap) {
    additionalClasses.push('general-all');
  }

  if (discussion.deleted_at) {
    additionalClasses.push('deleted');
  }

  const messageTypeIcon = () => {
    const type = discussion.message_type;
    return (
      <div className={`beatmap-discussion-message-type beatmap-discussion-message-type--${type}`}><i className={BeatmapDiscussionHelper.messageType.icon[type]} title={osu.trans(`beatmaps.discussions.message_type.${type}`)} /></div>
    );
  };

  const timestamp = () => (
    <div className={`${bn}__timestamp-text`}>
      {
        discussion.timestamp !== null
          ? BeatmapDiscussionHelper.formatTimestamp(discussion.timestamp)
          : osu.trans('beatmap_discussions.timestamp_display.general')
      }
    </div>
  );

  const parentLink = () => {
    if (!discussion.parent_id) {
      return;
    }

    return (
      <div className={`${bn}__link`}>
        <a
          className={`${bn}__link-text js-beatmap-discussion--jump`}
          href={BeatmapDiscussionHelper.url({ discussion })}
          title={osu.trans('beatmap_discussions.review.go_to_child')}
        >
          <i className='fas fa-external-link-alt' />
        </a>
      </div>
    );
  };

  return (
    <div className={classWithModifiers(bn, additionalClasses)}>
      <div className={`${bn}__content`}>
        <div className={`${bn}__selectors`}>
          <div className='icon-dropdown-menu icon-dropdown-menu--disabled'>
            {beatmap != null && <BeatmapIcon beatmap={beatmap} />}
            {!discussion.beatmap_id &&
              <i className='fas fa-fw fa-star-of-life' title={osu.trans('beatmaps.discussions.mode.scopes.generalAll')} />
            }
          </div>
          <div className='icon-dropdown-menu icon-dropdown-menu--disabled'>
            {messageTypeIcon()}
          </div>
          <div className={`${bn}__timestamp`}>
            {timestamp()}
          </div>
          <div className={`${bn}__stripe`} />
          {parentLink()}
        </div>
        <div className={`${bn}__stripe`} />
        <div className={`${bn}__message-container`}>
          <div className={`${bn}__body`} dangerouslySetInnerHTML={{ __html: BeatmapDiscussionHelper.format((discussion.starting_post || discussion.posts[0]).message) }} />
        </div>
        {parentLink()}
      </div>
    </div>
  );
};
