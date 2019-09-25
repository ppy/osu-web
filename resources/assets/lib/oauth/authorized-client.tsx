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
import { Client } from 'models/oauth/client';
import * as React from 'react';
import { StringWithComponent } from 'string-with-component';
import { UserLink } from 'user-link';

interface Props {
  client: Client;
}

@observer
export class AuthorizedClient extends React.Component<Props> {
  render() {
    const client = this.props.client;
    const mappings = {
      ':user': <UserLink key='user' user={client.user} />,
    };

    return (
      <div className='oauth-client'>
        <div className='oauth-client__details'>
          <div className='oauth-client__name'>
            {client.name}
          </div>
          <span className='oauth-client__owner'>
            <StringWithComponent pattern={osu.trans('oauth.authorized_clients.owned_by')} mappings={mappings} />
          </span>
          <div className='oauth-client__scopes'>
            {this.renderPermissions()}
          </div>
        </div>
        <div>
          <BigButton
            text={osu.trans(`oauth.authorized_clients.revoked.${client.revoked}`)}
            icon={client.revoked ? 'fas fa-ban' : 'fas fa-trash'}
            isBusy={client.isRevoking}
            modifiers={['account-edit', 'danger', 'settings-oauth']}
            props={{
              disabled: client.isRevoking || client.revoked,
              onClick: this.revokeClicked,
            }}
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
            scopes.map((scope) => {
              return (
                <li key={scope}>
                  <span className='oauth-scopes__icon'><span className='fas fa-check' /></span>
                  {osu.trans(`api.scopes.${scope}`)}
                </li>
              );
            })
          }
        </ul>
      </>
    );
  }

  revokeClicked = (event: React.MouseEvent<HTMLElement>) => {
    if (!confirm(osu.trans('oauth.authorized_clients.confirm_revoke'))) { return; }

    this.props.client.revoke().catch(osu.ajaxError);
  }
}
