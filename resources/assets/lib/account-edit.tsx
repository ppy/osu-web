// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { AuthorizedClients } from 'oauth/authorized-clients';
import { OwnClients } from 'oauth/own-clients';
import * as osu from 'osu-common';
import core from 'osu-core-singleton';
import * as React from 'react';

core.reactTurbolinks.register('authorized-clients', () => {
  const json = osu.parseJson('json-authorized-clients', true);
  if (json != null) {
    core.dataStore.clientStore.initialize(json);
  }

  return <AuthorizedClients />;
});

core.reactTurbolinks.register('own-clients', () => {
  const json = osu.parseJson('json-own-clients', true);
  if (json != null) {
    core.dataStore.ownClientStore.initialize(json);
  }

  return <OwnClients />;
});
