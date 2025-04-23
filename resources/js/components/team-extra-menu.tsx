// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import PopupMenu from 'components/popup-menu';
import { ReportReportable } from 'components/report-reportable';
import core from 'osu-core-singleton';
import * as React from 'react';
import { trans } from 'utils/lang';

interface Props {
  leaderUsername: string;
  teamId: number;
}

export default function TeamExtraMenu(props: Props) {
  if (core.currentUser?.team?.id === props.teamId) return null;

  return (
    <div
      className='btn-circle btn-circle--page-toggle btn-circle--page-toggle-detail'
      title={trans('common.buttons.show_more_options')}
    >
      <PopupMenu>
        {(dismiss) => (
          <div className='simple-menu'>
            <ReportReportable
              className='simple-menu__item'
              icon
              onFormOpen={dismiss}
              reportableId={props.teamId.toString()}
              reportableType='team'
              user={{ username: props.leaderUsername }}
            />
          </div>
        )}
      </PopupMenu>
    </div>
  );
}
