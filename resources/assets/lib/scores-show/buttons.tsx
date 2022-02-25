// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { PopupMenuPersistent } from 'components/popup-menu-persistent';
import { ReportReportable } from 'components/report-reportable';
import ScorePin from 'components/score-pin';
import ScoreJson from 'interfaces/score-json';
import { route } from 'laroute';
import core from 'osu-core-singleton';
import * as React from 'react';
import { canBeReported } from 'utils/score-helper';

interface Props {
  score: ScoreJson;
}

export default function Buttons(props: Props) {
  const visibleMenuItems = new Set<string>();

  if (canBeReported(props.score)) {
    visibleMenuItems.add('report');
  }

  if (core.scorePins.canBePinned(props.score)) {
    visibleMenuItems.add('pin');
  }

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

      {visibleMenuItems.size > 0 && (
        <div className='score-buttons__menu'>
          <PopupMenuPersistent>
            {(dismiss: () => void) => (
              <div className='simple-menu'>
                {visibleMenuItems.has('pin') &&
                  <ScorePin
                    className='simple-menu__item'
                    onUpdate={dismiss}
                    score={props.score}
                  />
                }
                {visibleMenuItems.has('report') &&
                  <ReportReportable
                    baseKey='scores'
                    className='simple-menu__item'
                    onFormClose={dismiss}
                    reportableId={props.score.best_id?.toString() ?? ''}
                    reportableType={`score_best_${props.score.mode}`}
                    user={props.score.user}
                  />
                }
              </div>
            )}
          </PopupMenuPersistent>
        </div>
      )}
    </div>
  );
}
