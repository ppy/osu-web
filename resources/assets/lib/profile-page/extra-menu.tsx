// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BlockButton } from 'block-button';
import UserJson from 'interfaces/user-json';
import { PopupMenu } from 'popup-menu';
import * as React from 'react';
import { ReportReportable } from 'report-reportable';

interface Props {
  user: UserJson;
}

export default function ExtraMenu(props: Props) {
  return (
    <div
      className='btn-circle btn-circle--page-toggle btn-circle--page-toggle-detail'
      title={osu.trans('common.buttons.show_more_options')}
    >
      <PopupMenu>
        {() => (
          <div className='simple-menu'>
            <BlockButton
              modifiers='inline'
              userId={props.user.id}
              wrapperClass='simple-menu__item'
            />
            <ReportReportable
              className='simple-menu__item'
              icon
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
