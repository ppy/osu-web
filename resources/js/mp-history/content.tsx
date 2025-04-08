// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ShowMoreLink from 'components/show-more-link';
import LegacyMatchEvent from 'interfaces/legacy-match-event-json';
import LegacyMatchGame from 'interfaces/legacy-match-game-json';
import LegacyMatch from 'interfaces/legacy-match-json';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { bottomPageDistance } from 'utils/html';
import { trans } from 'utils/lang';
import UserJson from '../interfaces/user-json';
import Event from './event';
import Game from './game';

interface Props {
  currentGameId?: number;
  events?: LegacyMatchEvent[];
  hasNext: boolean;
  hasPrevious: boolean;
  isAutoloading: boolean;
  loadingNext: boolean;
  loadingPrevious: boolean;
  loadNext: (state: any) => void; // TODO: type is temporary, will be specified better when `main.coffee` is converted to TS
  loadPrevious: (state: any) => void; // TODO: type is temporary, will be specified better when `main.coffee` is converted to TS
  match: LegacyMatch;
  users: Partial<Record<number, UserJson>>;
}

interface Snapshot {
  referenceFunc?: () => number;
  referencePrev?: number;
  scrollToLastEvent: boolean;
}

export interface TeamScores {
  blue: number;
  red: number;
}

export default class Content extends React.PureComponent<Props> {
  scoresCache: Partial<Record<number, TeamScores>> = {};

  componentDidUpdate(prevProps: Readonly<Props>, prevState: Readonly<any>, snapshot?: Snapshot) {
    if (snapshot?.scrollToLastEvent) {
      $(window).stop().scrollTo(document.body.scrollHeight, 500);
    } else if (snapshot?.referenceFunc) {
      const referenceCurrent = snapshot.referenceFunc();
      const documentScrollTopCurrent = window.scrollY;
      const documentScrollTopTarget = documentScrollTopCurrent + referenceCurrent - snapshot.referencePrev!;
      window.scrollTo(window.scrollX, documentScrollTopTarget);
    }
  }

  getSnapshotBeforeUpdate(prevProps: Readonly<Props>, _: Readonly<any>): Snapshot {
    const snapshot: Snapshot = {
      scrollToLastEvent: prevProps.isAutoloading && this.props.isAutoloading && bottomPageDistance() < 10,
    };

    if (!snapshot.scrollToLastEvent) {
      const hadEvents = prevProps.events != null && prevProps.events.length > 0;
      const hasEvents = this.props.events != null && this.props.events.length > 0;
      if (hadEvents && hasEvents) {
        // This is to allow events to be added without moving currently
        // visible events on viewport.
        if (prevProps.events[0].id > this.props.events[0].id) {
          snapshot.referenceFunc = () => document.body.scrollHeight;
        } else {
          snapshot.referenceFunc = () => 0;
        }

        snapshot.referencePrev = snapshot.referenceFunc();
      }
    }

    return snapshot;
  }

  render() {
    let inEvent = false;

    const openEventsGroup = () => {
      if (!inEvent) {
        inEvent = true;
        return <div className={classWithModifiers('mp-history-content__item', ['event', 'event-open'])} />;
      }
    };
    const closeEventsGroup= () => {
      if (inEvent) {
        inEvent = false;
        return <div className={classWithModifiers('mp-history-content__item', ['event', 'event-close'])} />;
      }
    };

    return (
      <div className='mp-history-content'>
        <h3 className='mp-history-content__item'>{this.props.match.name}</h3>
        {this.props.hasPrevious &&
          <div className={classWithModifiers('mp-history-content__item', ['more'])}>
            <ShowMoreLink
              callback={this.props.loadPrevious}
              direction='up'
              hasMore
              loading={this.props.loadingPrevious} />
          </div>}
        {this.props.events?.map((event) => {
          if (event.detail.type === 'other') {
            if (event.game == null || (event.game.end_time == null && event.game.id !== this.props.currentGameId)) {
              return null;
            }

            return (
              <React.Fragment key={event.id}>
                {closeEventsGroup()}

                <div className='mp-history-content__item'>
                  <Game
                    game={event.game}
                    teamScores={this.teamScores(event.game)}
                    users={this.props.users} />
                </div>
              </React.Fragment>
            );
          } else {
            return (
              <React.Fragment key={event.id}>
                {openEventsGroup()}

                <div className={classWithModifiers('mp-history-content__item', ['event'])}>
                  <Event
                    key={event.id}
                    event={event}
                    users={this.props.users} />
                </div>
              </React.Fragment>
            );
          }
        })}
        {closeEventsGroup()}
        {this.props.hasNext &&
          <div className={classWithModifiers('mp-history-content__item', ['more'])}>
            {this.props.isAutoloading && <div className='mp-history-content__autoload-label'>{trans('matches.match.in_progress_spinner_label')}</div>}
            <ShowMoreLink
              callback={this.props.loadNext}
              hasMore
              loading={this.props.isAutoloading || this.props.loadingNext} />
          </div>}
      </div>
    );
  }

  teamScores(game: LegacyMatchGame): TeamScores {
    // this only caches ended games which scores shouldn't change ever.
    const cachedScore = this.scoresCache[game.id];

    if (cachedScore != null) {
      return cachedScore;
    }

    const scores: TeamScores = { blue: 0, red: 0 };

    if (game.end_time == null) {
      return scores;
    }

    for (const score of game.scores) {
      if (!score.match.pass || score.match.team === 'none') {
        continue;
      }
      scores[score.match.team] += score.score;
    }

    return this.scoresCache[game.id] = scores;
  }
}
