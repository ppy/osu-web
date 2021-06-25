// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ScoreJson from 'interfaces/score-json';
import { route } from 'laroute';
import * as _ from 'lodash';
import { PopupMenuPersistent } from 'popup-menu-persistent';
import * as React from 'react';
import { ReportReportable } from 'report-reportable';
import { canBeReported, hasReplay, hasShow } from 'score-helper';

interface Props {
  score: ScoreJson;
}

export class PlayDetailMenu extends React.PureComponent<Props> {
  render() {
    const { score } = this.props;

    const children = (dismiss: () => void) => (
      <>
        {hasShow(score) && (
          <a
            className='simple-menu__item'
            href={route('scores.show', { mode: score.mode, score: score.best_id })}
          >
            {osu.trans('users.show.extra.top_ranks.view_details')}
          </a>
        )}

        {hasReplay(score) && (
          <a
            className='simple-menu__item js-login-required--click'
            data-turbolinks={false}
            href={route('scores.download', { mode: score.mode, score: score.best_id })}
            onClick={dismiss}
          >
            {osu.trans('users.show.extra.top_ranks.download_replay')}
          </a>
        )}

        {canBeReported(score) && (
          <ReportReportable
            baseKey='scores'
            className='simple-menu__item'
            reportableId={score.best_id?.toString() ?? ''}
            reportableType={`score_best_${score.mode}`}
            user={score.user}
          />
        )}
      </>
    );

    return (
      <PopupMenuPersistent>
        {children}
      </PopupMenuPersistent>
    );
  }
}
