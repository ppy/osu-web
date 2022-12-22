// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetJson from 'interfaces/beatmapset-json';
import * as React from 'react';
import { showVisual } from 'utils/beatmapset-helper';
import { classWithModifiers, Modifiers } from 'utils/css';
import { cssVar2x } from 'utils/html';
import { trans } from 'utils/lang';

interface PropsWithIsDeleted {
  isDeleted: true;
}

interface PropsWithSize {
  isDeleted?: false;
  size: keyof BeatmapsetJson['covers'];
}

interface BaseProps {
  beatmapset?: BeatmapsetJson | null;
  forceShowVisual?: boolean;
  modifiers?: Modifiers;
}

type Props = BaseProps & (PropsWithIsDeleted | PropsWithSize);

export default function BeatmapsetCover(props: Props) {
  const className = classWithModifiers('beatmapset-cover', props.modifiers);

  if (props.isDeleted ?? false) {
    return (
      <div
        className={className}
        title={trans('beatmapsets.cover.deleted')}
      >
        <span className='fas fa-trash' />
      </div>
    );
  }

  const style = props.beatmapset != null && (props.forceShowVisual || showVisual(props.beatmapset))
    ? cssVar2x(props.beatmapset.covers[props.size])
    : undefined;

  return <div className={className} style={style} />;
}
