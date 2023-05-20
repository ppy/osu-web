// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import RankingSelectOptions from 'components/ranking-select-options';
import RoomList from 'components/room-list';
import TimeWithTooltip from 'components/time-with-tooltip';
import SeasonJson from 'interfaces/season-json';
import SelectOptionJson from 'interfaces/select-option-json';
import { route } from 'laroute';
import * as React from 'react';
import RoomListStore from 'stores/room-list-store';
import { trans } from 'utils/lang';

interface Props {
  currentSeason: SeasonJson;
  seasons: SelectOptionJson[];
  store: RoomListStore;
}

export default function Main(props: Props) {
  return (
    <>
      <div className='osu-page osu-page--ranking-info'>
        <RankingSelectOptions
          currentItem={{
            id: props.currentSeason.id,
            text: props.currentSeason.name,
          }}
          items={props.seasons}
          type='seasons'
        />

        <div className='grid-items grid-items--ranking-info-bar'>
          {props.currentSeason.start_date !== null &&
            <div className='counter-box counter-box--ranking'>
              <div className='counter-box__title'>
                {trans('rankings.spotlight.start_date')}
              </div>
              <div className='counter-box__count'>
                <TimeWithTooltip
                  dateTime={props.currentSeason.start_date}
                  format='YYYY-MM-DD'
                />
              </div>
            </div>
          }

          <div className='counter-box counter-box--ranking'>
            <div className='counter-box__title'>
              {trans('rankings.spotlight.end_date')}
            </div>
            <div className='counter-box__count'>
              {props.currentSeason.end_date !== null
                ? <TimeWithTooltip
                  dateTime={props.currentSeason.end_date}
                  format='YYYY-MM-DD'
                />
                : <div title={trans('rankings.seasons.ongoing')}>---</div>
              }
            </div>
          </div>

          <div className='counter-box counter-box--ranking'>
            <div className='counter-box__title'>
              {trans('rankings.seasons.room_count')}
            </div>
            <div className='counter-box__count'>
              {props.currentSeason.room_count}
            </div>
          </div>
        </div>
      </div>

      <div className='osu-page osu-page--generic'>
        <RoomList
          showMoreUrl={route('seasons.rooms', { season: props.currentSeason.id })}
          store={props.store}
        />
      </div>
    </>
  );
}
