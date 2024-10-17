// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import { route } from 'laroute';
import { action, makeObservable, observable, runInAction } from 'mobx';
import DiscussionsState from './discussions-state';

interface UpdateResponseJson {
  beatmapset: BeatmapsetWithDiscussionsJson;
}

interface CheckUpdatesResponseJson {
  last_update: string | null;
}

const checkNewTimeoutDefault = 10000;

export default class DiscussionsStateWorker {
  @observable private lastUpdateResponse: Date | null = null;
  private timeoutCheckNew?: number;
  @observable private xhrCheckNew?: JQuery.jqXHR<CheckUpdatesResponseJson>;
  @observable private xhrGetUpdates?: JQuery.jqXHR<UpdateResponseJson>;

  get busy() {
    return this.xhrCheckNew != null || this.xhrGetUpdates != null;
  }

  get hasUpdates() {
    return this.lastUpdateResponse != null && this.lastUpdateResponse > this.discussionsState.lastUpdateDate;
  }

  get state() {
    if (this.xhrCheckNew != null) {
      return 'checking';
    }

    if (this.xhrGetUpdates != null) {
      return 'updating';
    }

    return this.hasUpdates ? 'has_updates' : 'no_updates';
  }

  constructor(private readonly discussionsState: DiscussionsState) {
    makeObservable(this);
    this.timeoutCheckNew = window.setTimeout(this.checkNew, checkNewTimeoutDefault);
  }

  @action
  refresh() {
    if (this.xhrGetUpdates != null) return;

    // cancel any update check.
    window.clearTimeout(this.timeoutCheckNew);
    this.xhrCheckNew?.abort();

    this.xhrGetUpdates = $.getJSON(route('beatmapsets.discussion', { beatmapset: this.discussionsState.beatmapset.id }));

    this.xhrGetUpdates.done((json) => {
      if (json != null) {
        this.discussionsState.update({ beatmapset: json.beatmapset });
      }
    }).always(action(() => {
      this.xhrGetUpdates = undefined;
      // restart update checking.
      this.timeoutCheckNew = window.setTimeout(this.checkNew, checkNewTimeoutDefault);
    }));
  }

  stop() {
    window.clearTimeout(this.timeoutCheckNew);
    this.xhrCheckNew?.abort();
    this.xhrGetUpdates?.abort();
  }

  @action
  private readonly checkNew = () => {
    if (this.xhrCheckNew != null) return;

    window.clearTimeout(this.timeoutCheckNew);

    this.xhrCheckNew = $.getJSON(route('beatmapsets.discussion-last-update', { beatmapset: this.discussionsState.beatmapset.id }));

    this.xhrCheckNew.done((json) => runInAction(() => {
      this.lastUpdateResponse = json.last_update != null ? new Date(json.last_update) : null;
    })).always(action(() => {
      // stop polling if there is an update, otherwise keep checking.
      if (!this.hasUpdates) {
        this.timeoutCheckNew = window.setTimeout(this.checkNew, checkNewTimeoutDefault);
      }

      this.xhrCheckNew = undefined;
    }));
  };
}
