// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ScorePin from 'components/score-pin';
import SoloScoreJson from 'interfaces/solo-score-json';
import UserJson from 'interfaces/user-json';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { rulesetName } from 'utils/beatmap-helper';
import { trans } from 'utils/lang';
import { canBeReported, hasReplay, hasShow, scoreDownloadUrl, scoreUrl } from 'utils/score-helper';
import { PopupMenuPersistent } from './popup-menu-persistent';
import { ReportReportable } from './report-reportable';

interface Props {
  score: SoloScoreJson;
  user: UserJson;
}

@observer
export class PlayDetailMenu extends React.Component<Props> {
  render() {
    const { score, user } = this.props;
    const ruleset = rulesetName(score.ruleset_id);

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
          <a className='simple-menu__item' href={scoreUrl(score)}>
            {trans('users.show.extra.top_ranks.view_details')}
          </a>
        )}

        {hasReplay(score) && (
          <a
            className='simple-menu__item js-login-required--click'
            data-turbolinks={false}
            href={scoreDownloadUrl(score)}
            onClick={dismiss}
          >
            {trans('users.show.extra.top_ranks.download_replay')}
          </a>
        )}

        {canBeReported(score) && (
          <ReportReportable
            className='simple-menu__item'
            onFormOpen={dismiss}
            reportableId={(score.best_id ?? score.id).toString()}
            reportableType={score.type === 'solo_score' ? score.type : `score_best_${ruleset}`}
            user={user}
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
