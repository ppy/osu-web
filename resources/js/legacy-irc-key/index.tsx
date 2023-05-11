// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import { action, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { trans } from 'utils/lang';
import Controller from './controller';
import Details from './details';

interface Props {
  container: HTMLElement;
}

@observer
export default class LegacyIrcKey extends React.Component<Props> {
  private controller;

  constructor(props: Props) {
    super(props);

    this.controller = new Controller(this.props.container);

    makeObservable(this);
  }

  componentWillUnmount() {
    this.controller.destroy();
  }

  render() {
    return this.controller.key == null ? this.renderEmpty() : this.renderDetails();
  }

  @action
  private readonly onNewKeyClick = () => {
    if (!confirm(trans('legacy_irc_key.confirm_new'))) return;

    this.controller.createKey();
  };

  private renderDetails() {
    return <Details controller={this.controller} />;
  }

  private renderEmpty() {
    return (
      <>
        <p>
          {trans('legacy_irc_key.none')}
        </p>
        <div>
          <BigButton
            icon='fas fa-plus'
            props={{
              onClick: this.onNewKeyClick,
            }}
            text={trans('legacy_irc_key.new')}
          />
        </div>
      </>
    );
  }
}
