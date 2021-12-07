// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import KudosuHistoryJson from 'interfaces/kudosu-history-json';
import { observer } from 'mobx-react';
import ExtraHeader from 'profile-page/extra-header';
import * as React from 'react';
import ShowMoreLink from 'show-more-link';
import StringWithComponent from 'string-with-component';
import TimeWithTooltip from 'time-with-tooltip';
import { OffsetPaginatorJson, itemsLength } from 'utils/offset-paginator';
import { wikiUrl } from 'utils/url';
import ValueDisplay from 'value-display';

function Entry({ kudosu }: { kudosu: KudosuHistoryJson }) {
  const textMappings = {
    amount: (
      <strong className='profile-extra-entries__kudosu-amount'>
        {osu.trans('users.show.extra.kudosu.entry.amount', { amount: osu.formatNumber(Math.abs(kudosu.amount)) })}
      </strong>
    ),
    giver: kudosu.giver == null
      ? osu.trans('users.deleted')
      : <a href={kudosu.giver.url}>{kudosu.giver.username}</a>,
    post: kudosu.post.url == null
      ? kudosu.post.title
      : <a href={kudosu.post.url}>{kudosu.post.title}</a>,
  };

  return (
    <li className='profile-extra-entries__item'>
      <div className='profile-extra-entries__detail'>
        <div className='profile-extra-entries__text'>
          <StringWithComponent
            mappings={textMappings}
            pattern={osu.trans(`users.show.extra.kudosu.entry.${kudosu.model}.${kudosu.action}`)}
          />
        </div>
      </div>
      <div className='profile-extra-entries__time'>
        <TimeWithTooltip dateTime={kudosu.created_at} relative />
      </div>
    </li>
  );
}

interface Props {
  kudosu: OffsetPaginatorJson<KudosuHistoryJson>;
  name: string;
  onShowMore: () => void;
  total: number;
  userId: number;
  withEdit: boolean;
}

@observer
export default class ProfilePageKudosu extends React.Component<Props> {
  render() {
    return (
      <div className='page-extra'>
        <ExtraHeader name={this.props.name} withEdit={this.props.withEdit} />

        <div className='kudosu-box'>
          <ValueDisplay
            description={(
              <StringWithComponent
                mappings={{
                  link: (
                    <a href={wikiUrl('Kudosu')}>
                      {osu.trans('users.show.extra.kudosu.total_info.link')}
                    </a>
                  ),
                }}
                pattern={osu.trans('users.show.extra.kudosu.total_info._')}
              />
            )}
            label={osu.trans('users.show.extra.kudosu.total')}
            modifiers='kudosu'
            value={osu.formatNumber(this.props.total)}
          />
        </div>

        {this.renderEntries()}
      </div>
    );
  }

  private renderEntries() {
    if (itemsLength(this.props.kudosu.items) === 0) {
      return (
        <div className='profile-extra-entries profile-extra-entries--kudosu'>
          {osu.trans('users.show.extra.kudosu.entry.empty')}
        </div>
      );
    }

    return (
      <ul className='profile-extra-entries profile-extra-entries--kudosu'>
        {Array.isArray(this.props.kudosu.items) && this.props.kudosu.items.map((kudosu) => <Entry key={kudosu.id} kudosu={kudosu} />)}

        <li className='profile-extra-entries__item'>
          <ShowMoreLink
            {...this.props.kudosu.pagination}
            callback={this.props.onShowMore}
            modifiers='profile-page'
          />
        </li>
      </ul>
    );
  }
}
