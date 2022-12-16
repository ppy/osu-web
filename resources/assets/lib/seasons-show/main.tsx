// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import MultiplayerList from 'components/multiplayer-list';
import RankingSelectOptions from 'components/ranking-select-options';
import TimeWithTooltip from 'components/time-with-tooltip';
import RoomJson from 'interfaces/room-json';
import SeasonJson from 'interfaces/season-json';
import { route } from 'laroute';
import * as React from 'react';
import MultiplayerListStore from 'stores/multiplayer-list-store';
import { trans } from 'utils/lang';

interface Props {
  currentSeason: SeasonJson;
  rooms: RoomJson[];
  seasons: SeasonJson[];
  store: MultiplayerListStore;
}

export default function Main(props: Props) {
  return (
    <>
      <div className='osu-page osu-page--description'>
        <RankingSelectOptions
          currentItem={props.currentSeason}
          items={props.seasons}
          type='seasons'
        />
      </div>

      <div className='osu-page osu-page--info-bar'>
        <div className="grid-items">
          {props.currentSeason.start_date !== null &&
            <div className='counter-box counter-box--info'>
              <div className="counter-box__title">
                {trans('rankings.spotlight.start_date')}
              </div>
              <div className="counter-box__count">
                <TimeWithTooltip
                  dateTime={props.currentSeason.start_date}
                  format='YYYY-MM-DD'
                />
              </div>
            </div>
          }

          <div className='counter-box counter-box--info'>
            <div className="counter-box__title">
              {trans('rankings.spotlight.end_date')}
            </div>
            <div className="counter-box__count">
              {props.currentSeason.end_date !== null
                ? <TimeWithTooltip
                  dateTime={props.currentSeason.end_date}
                  format='YYYY-MM-DD'
                />
                : <div title={trans('rankings.seasons.ongoing')}>---</div>
              }
            </div>
          </div>

          <div className="counter-box counter-box--info">
            <div className="counter-box__title">
              {trans('rankings.seasons.room_count')}
            </div>
            <div className="counter-box__count">
              {props.currentSeason.room_count}
            </div>
          </div>
        </div>
      </div>

      <div className="osu-page osu-page--generic">
        <MultiplayerList
          showMoreRoute={route('seasons.show', { season: props.currentSeason.id })}
          store={props.store}
        />
      </div>
    </>
  );
}
