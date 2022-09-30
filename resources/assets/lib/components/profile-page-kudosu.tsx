// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import KudosuHistoryJson from 'interfaces/kudosu-history-json';
import { makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import ExtraHeader from 'profile-page/extra-header';
import getPage from 'profile-page/extra-page';
import * as React from 'react';
import { formatNumber } from 'utils/html';
import { hasMoreCheck, OffsetPaginatorJson } from 'utils/offset-paginator';
import { wikiUrl } from 'utils/url';
import LazyLoad from './lazy-load';
import ShowMoreLink from './show-more-link';
import StringWithComponent from './string-with-component';
import TimeWithTooltip from './time-with-tooltip';
import ValueDisplay from './value-display';

function Entry({ kudosu }: { kudosu: KudosuHistoryJson }) {
  const textMappings = {
    amount: (
      <strong className='profile-extra-entries__kudosu-amount'>
        {osu.trans('users.show.extra.kudosu.entry.amount', { amount: formatNumber(Math.abs(kudosu.amount)) })}
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
  kudosu?: OffsetPaginatorJson<KudosuHistoryJson>;
  name: string;
  onShowMore: () => void;
  total: number;
  userId: number;
  withEdit: boolean;
}

interface Response {
  items: KudosuHistoryJson[];
}

@observer
export default class ProfilePageKudosu extends React.Component<Props> {
  @observable
  private kudosu?: OffsetPaginatorJson<KudosuHistoryJson>;

  private xhr?: JQuery.jqXHR<Response>;

  constructor(props: Props) {
    super(props);

    this.kudosu = props.kudosu;

    makeObservable(this);
  }

  render() {
    return (
      <div className='page-extra'>
        <ExtraHeader name={this.props.name} withEdit={this.props.withEdit} />

        <LazyLoad onLoad={this.handleOnLoad} >
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
              value={formatNumber(this.props.total)}
            />
          </div>

          {this.renderEntries()}
        </LazyLoad>
      </div>
    );
  }

  private readonly handleOnLoad = () => {
    this.xhr = getPage({ id: this.props.userId }, 'kudosu');

    this.xhr.done((json) => runInAction(() => {
      const items = json.items;
      const hasMore = hasMoreCheck(5, items);
      this.kudosu = {
        items,
        pagination: { hasMore },
      };
    }));

    return this.xhr;
  };

  private renderEntries() {
    if (this.kudosu == null) return null;

    if (this.kudosu.items.length === 0) {
      return (
        <div className='profile-extra-entries profile-extra-entries--kudosu'>
          {osu.trans('users.show.extra.kudosu.entry.empty')}
        </div>
      );
    }

    return (
      <ul className='profile-extra-entries profile-extra-entries--kudosu'>
        {Array.isArray(this.kudosu.items) && this.kudosu.items.map((kudosu) => <Entry key={kudosu.id} kudosu={kudosu} />)}

        <li className='profile-extra-entries__item'>
          <ShowMoreLink
            {...this.kudosu.pagination}
            callback={this.props.onShowMore}
            modifiers='profile-page'
          />
        </li>
      </ul>
    );
  }
}
