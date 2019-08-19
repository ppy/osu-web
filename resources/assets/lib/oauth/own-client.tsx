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
import { OwnClient as Client } from 'models/oauth/own-client';
import * as React from 'react';
import { Spinner } from 'spinner';

interface Props {
  client: Client;
}

@observer
export class OwnClient extends React.Component<Props> {
  deleteClicked = (event: React.MouseEvent<HTMLElement>) => {
    if (!confirm(osu.trans('oauth.own-clients.confirm_delete'))) { return; }

    this.props.client.delete().catch(osu.ajaxError);
  }

  render() {
    const client = this.props.client;

    return (
      <div className='oauth-client'>
        <div className='oauth-client__details'>
          <div className='oauth-client__name'>
            {client.name}
          </div>
        </div>

        <div className='oauth-client__actions'>
          <button
            className={osu.classWithModifiers('oauth-client__button', client.revoked ? ['revoked'] : [])}
            onClick={this.deleteClicked}
            disabled={client.isRevoking || client.revoked}
          >
            {
              client.isRevoking ? <Spinner /> : osu.trans(`oauth.own-clients.revoked.${client.revoked}`)
            }
          </button>
        </div>
      </div>
    );
  }
}
