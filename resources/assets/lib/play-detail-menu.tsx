// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Score from 'interfaces/score';
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
