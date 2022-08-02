// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetDiscussionPostJson, { SystemPostMessage } from 'interfaces/beatmapset-discussion-post-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { linkHtml } from 'utils/url';

interface Props {
  post: BeatmapsetDiscussionPostJson;
  user: UserJson;
}

const bn = 'beatmap-discussion-system-post';

function isSystemPostMessage(message: string | SystemPostMessage): message is SystemPostMessage {
  return typeof message === 'object' && 'type' in message && 'value' in message;
}

export default function SystemPost(props: Props) {
  if (!isSystemPostMessage(props.post.message)) return null;
  if (props.post.message.type !== 'resolved') return null;

  const message = osu.trans(`beatmap_discussions.system.resolved.${props.post.message.value}`, {
    user: linkHtml(route('users.show', { user: props.user.id }), props.user.username, { classNames: [`${bn}__user`] }),
  });

  const className = classWithModifiers(bn, props.post.message.type, {
    deleted: props.post.deleted_at != null,
  });

  return (
    <div className={className}>
      <div dangerouslySetInnerHTML={{ __html: message }} className={`${bn}__content`} />
    </div>
  );
}
