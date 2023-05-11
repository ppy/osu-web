// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { trans } from 'utils/lang';
import Controller from './controller';

const serverHost = 'irc.ppy.sh';
const serverPort = '6667';

interface Props {
  controller: Controller;
}

@observer
export default class Details extends React.Component<Props> {
  @observable private keyVisible = false;

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    const key = this.props.controller.key;

    if (key == null) {
      throw new Error('rendering Details component with no key available');
    }

    const user = core.currentUser;

    if (user == null) {
      throw new Error('rendering Details component with no current user available');
    }

    return (
      <div className='legacy-api-details'>
        <div className='legacy-api-details__content'>
          <div className='legacy-api-details__entry'>
            <div className='legacy-api-details__label'>
              {trans('legacy_irc_key.form.server_host')}
            </div>
            <div className='legacy-api-details__value'>
              {serverHost}
            </div>
          </div>
          <div className='legacy-api-details__entry'>
            <div className='legacy-api-details__label'>
              {trans('legacy_irc_key.form.server_port')}
            </div>
            <div className='legacy-api-details__value'>
              {serverPort}
            </div>
          </div>
          <div className='legacy-api-details__entry'>
            <div className='legacy-api-details__label'>
              {trans('legacy_irc_key.form.username')}
            </div>
            <div className='legacy-api-details__value'>
              {user.username}
            </div>
          </div>
          <div className='legacy-api-details__entry'>
            <div className='legacy-api-details__label'>
              {trans('legacy_irc_key.form.token')}
            </div>
            <div className='legacy-api-details__value'>
              {this.keyVisible ? key.token : '***'}
            </div>
          </div>
        </div>
        <div className='legacy-api-details__actions'>
          <BigButton
            icon={this.keyVisible ? 'fas fa-eye-slash' : 'fas fa-eye'}
            modifiers={['account-edit', 'settings-oauth']}
            props={{
              onClick: this.onClickToggleKeyVisibility,
            }}
            text={trans(`legacy_irc_key.view.${this.keyVisible ? 'hide' : 'show'}`)}
          />
          <BigButton
            disabled={this.props.controller.isDeleting}
            icon='fas fa-trash'
            isBusy={this.props.controller.isDeleting}
            modifiers={['account-edit', 'danger', 'settings-oauth']}
            props={{
              onClick: this.deleteClicked,
            }}
            text={trans('legacy_irc_key.view.delete')}
          />
        </div>
      </div>
    );
  }

  private readonly deleteClicked = () => {
    if (!confirm(trans('common.confirmation'))) return;

    this.props.controller.deleteKey();
  };

  @action
  private readonly onClickToggleKeyVisibility = () => {
    this.keyVisible = !this.keyVisible;
  };
}
