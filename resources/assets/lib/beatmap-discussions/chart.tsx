// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  discussions: Record<string, BeatmapsetDiscussionJson>;
  duration: number;
}

const messageTypeCss: Record<string, string> = {
  mapper_note: 'mapper-note',
  praise: 'praise',
  problem: 'problem',
  suggestion: 'suggestion',
};

export default function Chart(props: Props) {
  const items: React.ReactNode[] = [];

  if (props.duration !== 0) {
    Object.values(props.discussions).forEach((discussion) => {
      if (discussion.timestamp == null) return;

      let className = classWithModifiers('beatmapset-discussions-chart__item', [
        (discussion.resolved ? 'resolved' : messageTypeCss[discussion.message_type]),
        (discussion.deleted_at == null ? null : 'deleted'),
      ]);
      className += ' js-beatmap-discussion--jump';

      const relativeTimestamp = discussion.timestamp < props.duration
        ? discussion.timestamp / props.duration
        : 1;

      items.push((
        <a
          key={discussion.id}
          href={BeatmapDiscussionHelper.url({ discussion })}
          className={className}
          style={{
            left: `${100 * relativeTimestamp}%`,
          }}
          title={BeatmapDiscussionHelper.formatTimestamp(discussion.timestamp)}
          data-tooltip-position='bottom center'
          data-tooltip-modifiers='extra-padding'
        />
      ));
    });
  }

  return (
    <div className='beatmapset-discussions-chart'>
      <div className='beatmapset-discussions-chart__container'>
        {items}
      </div>
    </div>
  );
}
