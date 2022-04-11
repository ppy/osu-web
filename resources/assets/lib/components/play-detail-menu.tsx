// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ScorePin from 'components/score-pin';
import ScoreJson from 'interfaces/score-json';
import { route } from 'laroute';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { canBeReported, hasReplay, hasShow } from 'utils/score-helper';
import { PopupMenuPersistent } from './popup-menu-persistent';
import { ReportReportable } from './report-reportable';

interface Props {
  score: ScoreJson;
}

@observer
export class PlayDetailMenu extends React.Component<Props> {
  render() {
    const { score } = this.props;

    const children = (dismiss: () => void) => (
      <div className='simple-menu'>
        {core.scorePins.canBePinned(score) && (
          <ScorePin
            className='simple-menu__item'
            onUpdate={dismiss}
            score={score}
          />
        )}

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
      </div>
    );

    return (
      <PopupMenuPersistent>
        {children}
      </PopupMenuPersistent>
    );
  }
}
