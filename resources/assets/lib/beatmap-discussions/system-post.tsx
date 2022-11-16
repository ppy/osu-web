// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import StringWithComponent from 'components/string-with-component';
import { BeatmapsetDiscussionSystemPostJson } from 'interfaces/beatmapset-discussion-post-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import { switchNever } from 'utils/switch-never';

interface Props {
  post: BeatmapsetDiscussionSystemPostJson;
  user: UserJson;
}

export default function SystemPost({ post, user }: Props) {
  if (post.message.type !== 'resolve') switchNever(post.message.type);

  const className = classWithModifiers('beatmap-discussion-system-post', post.message.type, {
    deleted: post.deleted_at != null,
  });

  return (
    <div className={className}>
      <div className='beatmap-discussion-system-post__content'>
        <StringWithComponent
          mappings={{
            user: <a
              className='beatmap-discussion-system-post__user'
              href={route('users.show', { user: user.id })}
            >
              {user.username}
            </a>,
          }}
          pattern={trans(`beatmap_discussions.system.resolved.${post.message.value}`)}
        />
      </div>
    </div>
  );
}
