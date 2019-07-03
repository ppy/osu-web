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

import { observer } from 'mobx-react';
import { Client } from 'oauth/client';
import * as React from 'react';
import { Spinner } from 'spinner';
import { UserLink } from 'user-link';

interface Props {
  client: Client;
}

@observer
export class AuthorizedClient extends React.Component<Props> {
  render() {
    return (
      <div className='authorized-client'>
        <div className='authorized-client__details'>
          <div className='authorized-client__name'>
            {this.props.client.name}
          </div>
          <span className='authorized-client__owner'>
            {osu.trans('oauth.authorized-clients.owned_by')} <UserLink user={this.props.client.user} />
          </span>
          <div className='authorized-client__scopes'>
            {this.renderPermissions()}
          </div>
        </div>
        <div className='authorized-client__actions'>
          {
            this.props.client.revoked ? (
              <div className='authorized-client__button authorized-client__button--revoked'>{osu.trans('oauth.authorized-clients.revoked')}</div>
            ) : (
              <button
                className='authorized-client__button'
                onClick={this.revokeClicked}
                disabled={this.props.client.isRevoking}
              >
                {
                  this.props.client.isRevoking ? <Spinner /> : osu.trans('oauth.authorized-clients.revoke')
                }

              </button>
            )
          }
        </div>
      </div>
    );
  }

  renderPermissions() {
    const scopes = Array.from(this.props.client.scopes).sort();
    return (
      <>
        <div>{osu.trans('oauth.authorized-clients.scopes_title')}</div>
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
    if (!confirm(osu.trans('oauth.authorized-clients.confirm_revoke'))) { return; }

    this.props.client.revoke().catch(osu.ajaxError);
  }
}
