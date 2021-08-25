// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserAccountHistoryJson from 'interfaces/user-account-history-json';
import * as moment from 'moment';
import ExtraHeader from 'profile-page/extra-header';
import * as React from 'react';
import { StringWithComponent } from 'string-with-component';
import TimeWithTooltip from 'time-with-tooltip';
import { UserLink } from 'user-link';
import { classWithModifiers } from 'utils/css';
import ExtraPageProps from './extra-page-props';

const bn = 'profile-extra-recent-infringements';
const columns = ['date', 'action', 'length', 'description'];

// TODO: remove once translations are updated
function stripTags(str: string) {
  return str.replace(/<[^>]*>/g, '');
}

function HistoryRow({ history }: { history: UserAccountHistoryJson }) {
  return (
    <tr>
      <td className={`${bn}__table-cell ${bn}__table-cell--date`}>
        <TimeWithTooltip dateTime={history.timestamp} relative />
      </td>

      <td className={`${bn}__table-cell ${bn}__table-cell--action`}>
        <div className={`${bn}__action ${bn}__action--${history.type}`}>
          {osu.trans(`users.show.extra.account_standing.recent_infringements.actions.${history.type}`)}
        </div>
      </td>

      <td className={`${bn}__table-cell ${bn}__table-cell--length`}>
        {history.type === 'restriction'
          ? (
            <div className={`${bn}__action ${bn}__action--restriction`}>
              {osu.trans('users.show.extra.account_standing.recent_infringements.length_permanent')}
            </div>
          ) : (history.type === 'note' ? '' : moment.duration(history.length, 'seconds').humanize())
        }
      </td>

      <td className={`${bn}__table-cell ${bn}__table-cell--description`}>
        <span className={`${bn}__description`}>
          {history.supporting_url != null
            ? <a href={history.supporting_url}>{history.description}</a>
            : history.description
          }

          {history.actor != null && (
            <span className={`${bn}__actor`}>
              <StringWithComponent
                mappings={{ ':username': <UserLink key='username' user={history.actor} /> }}
                pattern={osu.trans('users.show.extra.account_standing.recent_infringements.actor')}
              />
            </span>
          )}
        </span>
      </td>
    </tr>
  );
}

export default class AccountStanding extends React.PureComponent<ExtraPageProps> {
  render() {
    const latest = this.props.user.account_history.find((d) => d.type === 'silence');
    const endTime = latest == null
      ? null
      : moment(latest.timestamp).add(latest.length, 'seconds');

    return (
      <div className='page-extra'>
        <ExtraHeader name={this.props.name} withEdit={false} />

        {latest != null && (
          <div className='page-extra__alert page-extra__alert--warning'>
            <StringWithComponent
              mappings={{ ':username': <strong key='username'>{this.props.user.username}</strong> }}
              pattern={stripTags(osu.trans('users.show.extra.account_standing.bad_standing'))}
            />
          </div>
        )}

        {endTime != null && endTime.isAfter() && (
          <div className='page-extra__alert page-extra__alert--info'>
            <StringWithComponent
              mappings={{
                ':duration': <TimeWithTooltip dateTime={endTime} relative />,
                ':username': <strong key='username'>{this.props.user.username}</strong>,
              }}
              pattern={stripTags(osu.trans('users.show.extra.account_standing.remaining_silence'))}
            />
          </div>
        )}

        <h3 className='title title--page-extra-small'>
          {osu.trans('users.show.extra.account_standing.recent_infringements.title')}
        </h3>

        <div className={bn}>
          <table className={`${bn}__table`}>
            <thead>
              <tr>
                {columns.map((column) => (
                  <th
                    key={column}
                    className={classWithModifiers(`${bn}__table-cell`, 'header', column)}
                  >
                    {osu.trans(`users.show.extra.account_standing.recent_infringements.${column}`)}
                  </th>
                ))}
              </tr>
            </thead>
            <tbody>
              {this.props.user.account_history.map((h) => <HistoryRow key={h.id} history={h} />)}
            </tbody>
          </table>
        </div>
      </div>
    );
  }
}
