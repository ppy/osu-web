// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ClientJson } from 'interfaces/client-json';
import { OwnClientJson } from 'interfaces/own-client-json';
import LegacyApiKey from 'legacy-api-key';
import LegacyIrcKey from 'legacy-irc-key';
import { AuthorizedClients } from 'oauth/authorized-clients';
import { OwnClients } from 'oauth/own-clients';
import core from 'osu-core-singleton';
import * as React from 'react';
import { parseJsonNullable } from 'utils/json';

core.reactTurbolinks.register('authorized-clients', () => {
  const json = parseJsonNullable<ClientJson[]>('json-authorized-clients', true);
  if (json != null) {
    core.dataStore.clientStore.initialize(json);
  }

  return <AuthorizedClients />;
});

core.reactTurbolinks.register('legacy-api-key', (container: HTMLElement) => (
  <LegacyApiKey container={container} />
));

core.reactTurbolinks.register('legacy-irc-key', (container: HTMLElement) => (
  <LegacyIrcKey container={container} />
));

core.reactTurbolinks.register('own-clients', () => {
  const json = parseJsonNullable<OwnClientJson[]>('json-own-clients', true);
  if (json != null) {
    core.dataStore.ownClientStore.initialize(json);
  }

  return <OwnClients />;
});
