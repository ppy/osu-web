// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ScorePin from 'components/score-pin';
import ScoreJson from 'interfaces/score-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { trans } from 'utils/lang';
import { canBeReported, hasReplay, hasShow } from 'utils/score-helper';
import { PopupMenuPersistent } from './popup-menu-persistent';
import PopupMenuState from './popup-menu-state';
import { ReportReportable } from './report-reportable';

interface Props {
  score: ScoreJson;
  user: UserJson;
}

@observer
export class PlayDetailMenu extends React.Component<Props> {
  render() {
    const { score, user } = this.props;

    const children = (state: PopupMenuState) => (
      <div className='simple-menu'>
        {core.scorePins.canBePinned(score) && (
          <ScorePin
            className='simple-menu__item'
            onUpdate={state.dismiss}
            score={score}
          />
        )}

        {hasShow(score) && (
          <a className='simple-menu__item' href={route('scores.show', { score: score.id })}>
            {trans('users.show.extra.top_ranks.view_details')}
          </a>
        )}

        {hasReplay(score) && (
          <a
            className='simple-menu__item js-login-required--click'
            href={route('scores.download', { score: score.id })}
            onClick={state.dismiss}
          >
            {trans('users.show.extra.top_ranks.download_replay')}
          </a>
        )}

        {canBeReported(score) && (
          <ReportReportable
            className='simple-menu__item'
            onFormOpen={state.dismiss}
            reportableId={score.id.toString()}
            reportableType={score.type}
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
