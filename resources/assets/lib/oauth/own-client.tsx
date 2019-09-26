/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import { BigButton } from 'big-button';
import { observer } from 'mobx-react';
import { OwnClient as Client } from 'models/oauth/own-client';
import core from 'osu-core-singleton';
import * as React from 'react';

const uiState = core.dataStore.uiState;

interface Props {
  client: Client;
}

@observer
export class OwnClient extends React.Component<Props> {
  deleteClicked = (event: React.MouseEvent<HTMLElement>) => {
    if (!confirm(osu.trans('oauth.own_clients.confirm_delete'))) { return; }

    this.props.client.delete().catch(osu.ajaxError);
  }

  render() {
    const client = this.props.client;

    return (
      <div className='oauth-client'>
        <button className='oauth-client__details oauth-client__details--button' onClick={this.showClientDetails}>
          <div className='oauth-client__name'>{client.name}</div>
          <div className='oauth-client__redirect'>{client.redirect}</div>
        </button>
        <div className='oauth-client__actions'>
          <BigButton
            icon='fas fa-pencil-alt'
            modifiers={['account-edit', 'settings-oauth']}
            props={{
              disabled: client.isRevoking || client.revoked,
              onClick: this.showClientDetails,
            }}
            text={osu.trans('common.buttons.edit')}
          />
          <BigButton
            icon={client.revoked ? 'fas fa-ban' : 'fas fa-trash'}
            isBusy={client.isRevoking}
            modifiers={['account-edit', 'danger', 'settings-oauth']}
            props={{
              disabled: client.isRevoking || client.revoked,
              onClick: this.deleteClicked,
            }}
            text={osu.trans(`oauth.own_clients.revoked.${client.revoked}`)}
          />
        </div>
      </div>
    );
  }

  showClientDetails = () => {
    uiState.account.client = this.props.client;
  }
}
