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

import { OAuthApp } from 'oauth/oauth-app';
import core from 'osu-core-singleton';
import * as React from 'react';

const store = core.dataStore.oauthAppStore;

export class OAuthApps extends React.Component {
  render() {
    return (
      <div className='authorized-clients'>
        {store.apps.size > 0 ? this.renderOAuthApps() : this.renderEmpty()}
      </div>
    );
  }

  renderEmpty() {
    return osu.trans('oauth.authorized-clients.none');
  }

  renderOAuthApps() {
    return [...store.apps.values()].map((app) => {
      return <OAuthApp app={app} key={app.id} />;
    });
  }
}
