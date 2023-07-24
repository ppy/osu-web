// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { discussionTypeIcons } from 'beatmap-discussions/discussion-type';
import { BeatmapIcon } from 'components/beatmap-icon';
import BeatmapsetDiscussionJson from 'interfaces/beatmapset-discussion-json';
import * as React from 'react';
import { formatTimestamp, makeUrl, startingPost } from 'utils/beatmapset-discussion-helper';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import { BeatmapsContext } from './beatmaps-context';
import DiscussionMessage from './discussion-message';
import { DiscussionsContext } from './discussions-context';

interface Props {
  data: {
    discussion_id: number;
  };
}

export function postEmbedModifiers(discussion: BeatmapsetDiscussionJson) {
  return {
    deleted: discussion.deleted_at != null,
    'general-all': discussion.beatmap_id == null,
    praise: discussion.message_type === 'praise',
    resolved: discussion.resolved && discussion.message_type !== 'praise',
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
        <div className={`${bn}__missing`}>{trans('beatmaps.discussions.review.embed.missing')}</div>
      </div>
    );
  }

  const post = startingPost(discussion);
  if (post.system) {
    console.error('embed should not have system starting post', discussion.id);
    return null;
  }

  const beatmap = discussion.beatmap_id == null ? undefined : beatmaps[discussion.beatmap_id];

  const messageTypeIcon = () => {
    const type = discussion.message_type;

    return (
      <div>
        <span
          className={discussionTypeIcons[type]}
          style={{ color: `var(--beatmapset-discussion-colour--${type})` }}
          title={trans(`beatmaps.discussions.message_type.${type}`)}
        />
      </div>
    );
  };

  const timestamp = () => (
    <div className={`${bn}__timestamp-text`}>
      {
        discussion.timestamp !== null
          ? formatTimestamp(discussion.timestamp)
          : trans('beatmap_discussions.timestamp_display.general')
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
          href={makeUrl({ discussion })}
          title={trans('beatmap_discussions.review.go_to_child')}
        >
          <i className='fas fa-external-link-alt' />
        </a>
      </div>
    );
  };

  return (
    <div className={classWithModifiers(bn, 'lighter', postEmbedModifiers(discussion))}>
      <div className={`${bn}__content`}>
        <div className={`${bn}__selectors`}>
          <div className='icon-dropdown-menu icon-dropdown-menu--disabled'>
            {beatmap != null && <BeatmapIcon beatmap={beatmap} withTooltip />}
            {!discussion.beatmap_id &&
              <i className='fas fa-fw fa-star-of-life' title={trans('beatmaps.discussions.mode.scopes.generalAll')} />
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
          <div className={`${bn}__body`}>
            <DiscussionMessage markdown={post.message} />
          </div>
        </div>
        {parentLink()}
      </div>
    </div>
  );
};
