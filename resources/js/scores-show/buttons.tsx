// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { PopupMenuPersistent } from 'components/popup-menu-persistent';
import { ReportReportable } from 'components/report-reportable';
import ScorePin from 'components/score-pin';
import { ScoreJsonForShow } from 'interfaces/score-json';
import { route } from 'laroute';
import core from 'osu-core-singleton';
import * as React from 'react';
import { trans } from 'utils/lang';
import { canBeReported, hasReplay } from 'utils/score-helper';

interface Props {
  score: ScoreJsonForShow;
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
      {hasReplay(props.score) && (
        <a
          className='js-login-required--click btn-osu-big btn-osu-big--rounded'
          href={route('scores.download', { score: props.score.id })}
        >
          {trans('users.show.extra.top_ranks.download_replay')}
        </a>
      )}

      {visibleMenuItems.size > 0 && (
        <div className='score-buttons__menu'>
          <PopupMenuPersistent>
            {(state) => (
              <div className='simple-menu'>
                {visibleMenuItems.has('pin') &&
                  <ScorePin
                    className='simple-menu__item'
                    onUpdate={state.dismiss}
                    score={props.score}
                  />
                }
                {visibleMenuItems.has('report') &&
                  <ReportReportable
                    className='simple-menu__item'
                    onFormOpen={state.dismiss}
                    reportableId={props.score.id.toString()}
                    reportableType={props.score.type}
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
