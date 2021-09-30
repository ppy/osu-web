// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ScorePin from 'components/score-pin';
import ScoreJson from 'interfaces/score-json';
import { route } from 'laroute';
import core from 'osu-core-singleton';
import { PopupMenuPersistent } from 'popup-menu-persistent';
import * as React from 'react';
import { ReportReportable } from 'report-reportable';
import { canBeReported } from 'utils/score-helper';

interface Props {
  score: ScoreJson;
}

export default function Buttons(props: Props) {
  return (
    <div className='score-buttons'>
      {props.score.replay && (
        <a
          className='js-login-required--click btn-osu-big btn-osu-big--rounded-thin'
          data-turbolinks={false}
          href={route('scores.download', { mode: props.score.mode, score: props.score.best_id })}
        >
          {osu.trans('users.show.extra.top_ranks.download_replay')}
        </a>
      )}

      {core.scorePins.canBePinned(props.score) &&
        <ScorePin className='btn-osu-big btn-osu-big--rounded-thin' score={props.score} />
      }

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
