// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import ScoreboardType from './scoreboard-type';

interface Props {
  active: boolean;
  type: ScoreboardType;
}

export default function ScoreboardTab(props: Props) {
  const onClick = React.useCallback(() => {
    $.publish('beatmapset:scoreboard:set', { scoreboardType: props.type });
  }, [props.type]);

  return (
    <div
      className={classWithModifiers('page-tabs__tab', { active: props.active })}
      onClick={onClick}
    >
      {osu.trans(`beatmapsets.show.scoreboard.${props.type}`)}
    </div>
  );
}
