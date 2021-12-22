// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ProfilePageKudosu from 'components/profile-page-kudosu';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import ExtraPageProps from './extra-page-props';

@observer
export default class Kudosu extends React.Component<ExtraPageProps> {
  @computed
  get paginatorJson() {
    return this.props.controller.paginatorJson('recentlyReceivedKudosu');
  }

  constructor(props: ExtraPageProps) {
    super(props);

    makeObservable(this);
  }

  render() {
    return (
      <ProfilePageKudosu
        kudosu={this.paginatorJson}
        name={this.props.name}
        onShowMore={this.onShowMore}
        total={this.props.controller.state.user.kudosu.total}
        userId={this.props.controller.state.user.id}
        withEdit={this.props.controller.withEdit}
      />
    );
  }

  private readonly onShowMore = () => {
    this.props.controller.apiShowMore('recentlyReceivedKudosu');
  };
}
