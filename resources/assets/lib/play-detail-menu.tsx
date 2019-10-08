/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import { route } from 'laroute';
import * as _ from 'lodash';
import { PopupMenuPersistent } from 'popup-menu-persistent';
import * as React from 'react';
import { ReportReportable } from 'report-reportable';

interface Props {
  score: Score;
}

export class PlayDetailMenu extends React.PureComponent<Props> {
  private get canReport() {
    return !_.isEmpty(currentUser)
      && currentUser.id != null
      && currentUser.id !== this.props.score.user_id;
  }

  render() {
    const { score } = this.props;

    const children = (dismiss: () => void) => (
      <>
        {
          score.replay ? (
            <a
              className='simple-menu__item js-login-required--click'
              data-turbolinks={false}
              href={route('scores.download', { mode: score.mode, score: score.id })}
              onClick={dismiss}
            >
              {osu.trans('users.show.extra.top_ranks.download_replay')}
            </a>
           ) : null
        }

        {
          this.canReport ? (
            <ReportReportable
              className='simple-menu__item'
              baseKey='scores'
              reportableId={score.id}
              reportableType={`score_best_${score.mode}`}
              user={score.user}
            />
          ) : null
        }
      </>
    );

    return (
      <PopupMenuPersistent>
        {children}
      </PopupMenuPersistent>
    );
  }
}
