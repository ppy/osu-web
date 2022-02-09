// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { PopupMenu } from 'components/popup-menu';
import { ReportReportable } from 'components/report-reportable';
import BeatmapsetJson from 'interfaces/beatmapset-json';
import * as React from 'react';

interface Props {
  beatmapset: BeatmapsetJson;
}

export default function BeatmapsetMenu(props: Props) {
  return (
    <PopupMenu>
      {() => (
        <div className='simple-menu'>
          <ReportReportable
            className='simple-menu__item'
            icon
            reportableId={props.beatmapset.id.toString()}
            reportableType='beatmapset'
            user={{username: props.beatmapset.creator}}
          />
        </div>
      )}
    </PopupMenu>
  );
}
