// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import { action, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import { OwnClient as Client } from 'models/oauth/own-client';
import core from 'osu-core-singleton';
import * as React from 'react';
import { onError } from 'utils/ajax';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';

const uiState = core.dataStore.uiState;

interface Props {
  client: Client;
}

@observer
export class OwnClient extends React.Component<Props> {
  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  deleteClicked = () => {
    if (!confirm(trans('oauth.own_clients.confirm_delete'))) return;

    this.props.client.delete().fail(onError);
  };

  render() {
    const client = this.props.client;
    const redirects = client.redirect.split('\r\n');

    return (
      <div className='oauth-client'>
        <button className='oauth-client__details oauth-client__details--button' onClick={this.showClientDetails}>
          <div className='oauth-client__name'>{client.name}</div>
          <div className='oauth-client__redirect'>
            {redirects[0]}
            {' '}
            {redirects.length > 1 ? <small>(+{formatNumber(redirects.length - 1)})</small> : null}
          </div>
        </button>
        <div className='oauth-client__actions'>
          <BigButton
            disabled={client.isRevoking || client.revoked}
            icon='fas fa-pencil-alt'
            modifiers={['account-edit', 'settings-oauth']}
            props={{
              onClick: this.showClientDetails,
            }}
            text={trans('common.buttons.edit')}
          />
          <BigButton
            disabled={client.isRevoking || client.revoked}
            icon={client.revoked ? 'fas fa-ban' : 'fas fa-trash'}
            isBusy={client.isRevoking}
            modifiers={['account-edit', 'danger', 'settings-oauth']}
            props={{
              onClick: this.deleteClicked,
            }}
            text={trans(`oauth.own_clients.revoked.${client.revoked}`)}
          />
        </div>
      </div>
    );
  }

  @action
  showClientDetails = () => {
    uiState.account.client = this.props.client;
  };
}
