// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BlockButton from 'components/block-button';
import { PopupMenu } from 'components/popup-menu';
import { ReportReportable } from 'components/report-reportable';
import UserJson from 'interfaces/user-json';
import core from 'osu-core-singleton';
import * as React from 'react';

interface Props {
  user: UserJson;
}

export function showExtraMenu(user: UserJson) {
  return core.currentUser != null && core.currentUser.id !== user.id;
}

export default function ExtraMenu(props: Props) {
  return (
    <div
      className='btn-circle btn-circle--page-toggle btn-circle--page-toggle-detail'
      title={osu.trans('common.buttons.show_more_options')}
    >
      <PopupMenu>
        {(dismiss) => (
          <div className='simple-menu'>
            <BlockButton
              modifiers='inline'
              onClick={dismiss}
              userId={props.user.id}
              wrapperClass='simple-menu__item'
            />
            <ReportReportable
              className='simple-menu__item'
              icon
              onFormClose={dismiss}
              reportableId={props.user.id.toString()}
              reportableType='user'
              user={props.user}
            />
          </div>
        )}
      </PopupMenu>
    </div>
  );
}
