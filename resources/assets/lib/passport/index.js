import { AuthorizedClients } from './authorized-clients';
import { Clients } from './oauth-clients';
import { PersonalAccessTokens } from './personal-access-tokens';

reactTurbolinks.register('authorized-clients', AuthorizedClients, () => {
  return {};
});

reactTurbolinks.register('clients', Clients, () => {
  return {};
});

reactTurbolinks.register('personal-access-tokens', PersonalAccessTokens, () => {
  return {};
});
