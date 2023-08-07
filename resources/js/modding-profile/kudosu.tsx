// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ProfilePageKudosu from 'components/profile-page-kudosu';
import KudosuHistoryJson from 'interfaces/kudosu-history-json';
import * as React from 'react';
import { jsonClone } from 'utils/json';
import { hasMoreCheck } from 'utils/offset-paginator';

interface Props {
  expectedInitialCount: number;
  initialKudosu: KudosuHistoryJson[];
  name: string;
  total: number;
  userId: number;
}

export default class Kudosu extends React.Component<Props> {
  private readonly kudosu;

  constructor(props: Props) {
    super(props);

    const items = jsonClone(props.initialKudosu);
    this.kudosu = {
      items,
      pagination: {
        hasMore: hasMoreCheck(props.expectedInitialCount, items),
      },
    };
  }

  render() {
    return (
      <ProfilePageKudosu
        kudosu={this.kudosu}
        name={this.props.name}
        total={this.props.total}
        userId={this.props.userId}
        withEdit={false}
      />
    );
  }
}
