// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ProfilePageKudosu from 'components/profile-page-kudosu';
import KudosuHistoryJson from 'interfaces/kudosu-history-json';
import { makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { jsonClone } from 'utils/json';
import { hasMoreCheck, OffsetPaginatorJson } from 'utils/offset-paginator';

interface Props {
  expectedInitialCount: number;
  initialKudosu: KudosuHistoryJson[];
  name: string;
  total: number;
  userId: number;
}

type MobxState = OffsetPaginatorJson<KudosuHistoryJson>;

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
    this.mobxState.items = jsonClone(props.initialKudosu);
    this.mobxState.pagination.hasMore = hasMoreCheck(props.expectedInitialCount, this.mobxState.items);

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
        total={this.props.total}
        userId={this.props.userId}
        withEdit={false}
      />
    );
  }
}
