/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

import { AuthorizedClients } from 'oauth/authorized-clients';
import { OwnClients } from 'oauth/own-clients';
import core from 'osu-core-singleton';

reactTurbolinks.register('authorized-clients', AuthorizedClients, (container: HTMLElement) => {
  const json = osu.parseJson('json-authorized-clients', true);
  if (json != null) {
    core.dataStore.clientStore.initialize(json);
  }

  return {};
});

reactTurbolinks.register('own-clients', OwnClients, (container: HTMLElement) => {
  const json = osu.parseJson('json-own-clients', true);
  if (json != null) {
    core.dataStore.ownClientStore.initialize(json);
  }

  return {};
});
