// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetJson } from 'beatmapsets/beatmapset-json';
import { PopupMenuPersistent } from 'popup-menu-persistent';
import * as React from 'react';
import { ReportReportable } from 'report-reportable';

interface Props {
  beatmapset: BeatmapsetJson;
}

export default function BeatmapsetMenu(props: Props) {
  return (
    <PopupMenuPersistent>
      {(dismiss: () => void) => (
        <ReportReportable
          className='simple-menu__item'
          icon
          reportableId={props.beatmapset.id.toString()}
          reportableType='beatmapset'
          user={{username: props.beatmapset.creator}}
        />
      )}
    </PopupMenuPersistent>
  );
}
