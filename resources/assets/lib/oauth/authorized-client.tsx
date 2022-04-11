// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import StringWithComponent from 'components/string-with-component';
import { UserLink } from 'components/user-link';
import { observer } from 'mobx-react';
import { Client } from 'models/oauth/client';
import * as React from 'react';

interface Props {
  client: Client;
}

@observer
export class AuthorizedClient extends React.Component<Props> {
  render() {
    const client = this.props.client;

    return (
      <div className='oauth-client'>
        <div className='oauth-client__details'>
          <div className='oauth-client__name'>
            {client.name}
          </div>
          <span className='oauth-client__owner'>
            <StringWithComponent
              mappings={{
                user: <UserLink user={client.user} />,
              }}
              pattern={osu.trans('oauth.authorized_clients.owned_by')}
            />
          </span>
          <div className='oauth-client__scopes'>
            {this.renderPermissions()}
          </div>
        </div>
        <div>
          <BigButton
            disabled={client.isRevoking || client.revoked}
            icon={client.revoked ? 'fas fa-ban' : 'fas fa-trash'}
            isBusy={client.isRevoking}
            modifiers={['account-edit', 'danger', 'settings-oauth']}
            props={{
              onClick: this.revokeClicked,
            }}
            text={osu.trans(`oauth.authorized_clients.revoked.${client.revoked}`)}
          />
        </div>
      </div>
    );
  }

  renderPermissions() {
    const scopes = Array.from(this.props.client.scopes).sort();
    return (
      <>
        <div>{osu.trans('oauth.authorized_clients.scopes_title')}</div>
        <ul className='oauth-scopes'>
          {
            scopes.map((scope) => (
              <li key={scope}>
                <span className='oauth-scopes__icon'><span className='fas fa-check' /></span>
                {osu.trans(`api.scopes.${scope}`)}
              </li>
            ))
          }
        </ul>
      </>
    );
  }

  revokeClicked = () => {
    if (!confirm(osu.trans('oauth.authorized_clients.confirm_revoke'))) return;

    this.props.client.revoke().catch(osu.ajaxError);
  };
}
