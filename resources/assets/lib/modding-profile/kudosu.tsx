// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ProfilePageKudosu from 'components/profile-page-kudosu';
import KudosuHistoryJson from 'interfaces/kudosu-history-json';
import { makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { jsonClone, parseJsonNullable, storeJson } from 'utils/json';
import { apiShowMoreRecentlyReceivedKudosu, hasMoreCheck, OffsetPaginatorJson } from 'utils/offset-paginator';

interface Props {
  expectedInitialCount: number;
  initialKudosu: KudosuHistoryJson[];
  name: string;
  total: number;
  userId: number;
}

type MobxState = OffsetPaginatorJson<KudosuHistoryJson>;

const jsonId = 'kudosu';

@observer
export default class Kudosu extends React.Component<Props> {
  @observable private mobxState: MobxState = {
    items: [],
    pagination: {},
  };
  private xhr?: JQuery.jqXHR;

  constructor(props: Props) {
    super(props);

    // TODO: this should be handled by Main component instead.
    const savedState = parseJsonNullable<MobxState>(jsonId);

    if (savedState == null) {
      this.mobxState.items = jsonClone(props.initialKudosu);
      this.mobxState.pagination.hasMore = hasMoreCheck(props.expectedInitialCount, this.mobxState.items);
    } else {
      this.mobxState = savedState;
    }

    makeObservable(this);
  }

  componentWillUnmount() {
    this.xhr?.abort();
  }

  render() {
    return (
      <ProfilePageKudosu
        kudosu={this.mobxState}
        name={this.props.name}
        onShowMore={this.onShowMore}
        total={this.props.total}
        userId={this.props.userId}
        withEdit={false}
      />
    );
  }

  private readonly onShowMore = () => {
    this.xhr = apiShowMoreRecentlyReceivedKudosu(this.mobxState, this.props.userId)
      .done(this.saveState);
  };


  private readonly saveState = () => {
    storeJson(jsonId, this.mobxState);
  };
}
