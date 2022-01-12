// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { PopupMenuPersistent } from 'components/popup-menu-persistent';
import { ReportReportable } from 'components/report-reportable';
import ScoreJson from 'interfaces/score-json';
import { route } from 'laroute';
import * as React from 'react';
import { canBeReported } from 'utils/score-helper';

interface Props {
  score: ScoreJson;
}

export default function Buttons(props: Props) {
  return (
    <div className='score-buttons'>
      {props.score.replay && (
        <a
          className='js-login-required--click btn-osu-big btn-osu-big--rounded'
          data-turbolinks={false}
          href={route('scores.download', { mode: props.score.mode, score: props.score.best_id })}
        >
          {osu.trans('users.show.extra.top_ranks.download_replay')}
        </a>
      )}

      {canBeReported(props.score) && (
        <div className='score-buttons__menu'>
          <PopupMenuPersistent>
            {() => (
              <div className='simple-menu'>
                <ReportReportable
                  baseKey='scores'
                  className='simple-menu__item'
                  reportableId={props.score.best_id?.toString() ?? ''}
                  reportableType={`score_best_${props.score.mode}`}
                  user={props.score.user}
                />
              </div>
            )}
          </PopupMenuPersistent>
        </div>
      )}
    </div>
  );
}
