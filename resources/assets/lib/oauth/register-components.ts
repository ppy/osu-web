import { AuthorizedClients } from 'oauth/authorized-clients';
import core from 'osu-core-singleton';

reactTurbolinks.register('authorized-clients', AuthorizedClients, true, (container: HTMLElement) => {
  const json = osu.parseJson('json-authorized-clients', true);
  if (json != null) {
    core.dataStore.clientStore.initialize(json);
  }

  return {};
});
