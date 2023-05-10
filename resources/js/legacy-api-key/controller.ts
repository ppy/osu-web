// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import LegacyApiKeyJson from 'interfaces/legacy-api-key-json';
import { route } from 'laroute';
import { action, makeObservable, observable, reaction, runInAction } from 'mobx';
import { onError } from 'utils/ajax';

interface State {
  legacy_api_key: LegacyApiKeyJson | null;
  showing_form: boolean;
}

type DatasetState = Partial<State> & Required<Pick<State, 'legacy_api_key'>>;

export default class Controller {
  @observable state;
  private stateSyncDisposer;
  @observable private xhrCreate?: JQuery.jqXHR<LegacyApiKeyJson>;
  @observable private xhrDelete?: JQuery.jqXHR<void>;

  get isCreating() {
    return this.xhrCreate != null;
  }

  get isDeleting() {
    return this.xhrDelete != null;
  }

  get key() {
    return this.state.legacy_api_key;
  }

  constructor(private container: HTMLElement) {
    this.state = {
      ...JSON.parse(container.dataset.state ?? '') as DatasetState,
      showing_form: false,
    };

    makeObservable(this);

    this.stateSyncDisposer = reaction(
      () => JSON.stringify(this.state),
      (stateString) => this.container.dataset.state = stateString,
    );
  }

  @action
  createKey(appName: string, appUrl: string) {
    this.xhrCreate = $.ajax(route('legacy-api-key.store'), {
      data: {
        legacy_api_key: {
          app_name: appName,
          app_url: appUrl,
        },
      },
      method: 'POST',
    });
    this.xhrCreate
      .done((json) => runInAction(() => {
        this.state.legacy_api_key = json;
      })).always(action(() => {
        this.xhrCreate = undefined;
      }));

    return this.xhrCreate;
  }

  @action
  deleteKey() {
    this.xhrDelete = $.ajax(route('legacy-api-key.destroy'), { method: 'DELETE' })
      .fail(onError)
      .done(action(() => {
        this.state.legacy_api_key = null;
      })).always(action(() => {
        this.xhrDelete = undefined;
      }));
  }

  destroy() {
    this.xhrCreate?.abort();
    this.xhrDelete?.abort();
    this.stateSyncDisposer();
  }
}
