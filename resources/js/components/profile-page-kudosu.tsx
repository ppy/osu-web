// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import KudosuHistoryJson from 'interfaces/kudosu-history-json';
import { action, computed, makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import ExtraHeader from 'profile-page/extra-header';
import getPage, { PageSectionWithoutCountJson } from 'profile-page/extra-page';
import * as React from 'react';
import { formatNumber } from 'utils/html';
import { parseJsonNullable, storeJson } from 'utils/json';
import { trans } from 'utils/lang';
import { apiShowMoreRecentlyReceivedKudosu, OffsetPaginatorJson } from 'utils/offset-paginator';
import { wikiUrl } from 'utils/url';
import LazyLoad from './lazy-load';
import ShowMoreLink from './show-more-link';
import StringWithComponent from './string-with-component';
import TimeWithTooltip from './time-with-tooltip';
import ValueDisplay from './value-display';

const jsonId = 'json-kudosu';

function Entry({ kudosu }: { kudosu: KudosuHistoryJson }) {
  const textMappings = {
    amount: (
      <strong className='profile-extra-entries__kudosu-amount'>
        {trans('users.show.extra.kudosu.entry.amount', { amount: formatNumber(Math.abs(kudosu.amount)) })}
      </strong>
    ),
    giver: kudosu.giver == null
      ? trans('users.deleted')
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
            pattern={trans(`users.show.extra.kudosu.entry.${kudosu.model}.${kudosu.action}`)}
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
  total: number;
  userId: number;
  withEdit: boolean;
}

@observer
export default class ProfilePageKudosu extends React.Component<Props> {
  @observable private kudosu?: OffsetPaginatorJson<KudosuHistoryJson>;
  private showMoreXhr?: JQuery.jqXHR<KudosuHistoryJson[]>;
  private xhr?: JQuery.jqXHR<PageSectionWithoutCountJson<KudosuHistoryJson>>;

  @computed
  private get hasData() {
    return this.kudosu != null;
  }

  constructor(props: Props) {
    super(props);

    this.kudosu = parseJsonNullable(jsonId) ?? props.kudosu;

    makeObservable(this);
  }

  componentWillUnmount(){
    this.xhr?.abort();
    this.showMoreXhr?.abort();
  }

  render() {
    return (
      <div className='page-extra'>
        <ExtraHeader name={this.props.name} withEdit={this.props.withEdit} />

        <LazyLoad hasData={this.hasData} name={this.props.name} onLoad={this.handleOnLoad}>
          <div className='kudosu-box'>
            <ValueDisplay
              description={(
                <StringWithComponent
                  mappings={{
                    link: (
                      <a href={wikiUrl('Kudosu')}>
                        {trans('users.show.extra.kudosu.total_info.link')}
                      </a>
                    ),
                  }}
                  pattern={trans('users.show.extra.kudosu.total_info._')}
                />
              )}
              label={trans('users.show.extra.kudosu.total')}
              modifiers='kudosu'
              value={formatNumber(this.props.total)}
            />
          </div>

          {this.renderEntries()}
        </LazyLoad>
      </div>
    );
  }

  @action
  private readonly handleOnLoad = () => {
    this.xhr = getPage({ id: this.props.userId }, 'kudosu');

    this.xhr.done((json) => runInAction(() => {
      this.kudosu = json;
      this.saveState();
    }));

    return this.xhr;
  };

  @action
  private readonly handleShowMore = () => {
    if (this.kudosu == null) return;

    this.showMoreXhr = apiShowMoreRecentlyReceivedKudosu(this.kudosu, this.props.userId).done(this.saveState);
  };

  private renderEntries() {
    if (this.kudosu == null) return null;

    if (this.kudosu.items.length === 0) {
      return (
        <div className='profile-extra-entries profile-extra-entries--kudosu'>
          {trans('users.show.extra.kudosu.entry.empty')}
        </div>
      );
    }

    return (
      <ul className='profile-extra-entries profile-extra-entries--kudosu'>
        {this.kudosu.items.map((kudosu) => <Entry key={kudosu.id} kudosu={kudosu} />)}

        <li className='profile-extra-entries__item'>
          <ShowMoreLink
            {...this.kudosu.pagination}
            callback={this.handleShowMore}
            modifiers='profile-page'
          />
        </li>
      </ul>
    );
  }

  private readonly saveState = () => {
    storeJson(jsonId, this.kudosu);
  };
}
