// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Spinner } from 'components/spinner';
import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import { route } from 'laroute';
import { action, makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import DiscussionsState from './discussions-state';

interface Props {
  discussionsState: DiscussionsState;
}

interface UpdateResponseJson {
  beatmapset: BeatmapsetWithDiscussionsJson;
}

interface CheckUpdatesResponseJson {
  last_update: string | null;
}

const checkNewTimeoutDefault = 10000;

@observer
export class Refresh extends React.PureComponent<Props> {
  @observable private lastUpdateResponse: Date | null = null;
  private timeoutCheckNew?: number;
  @observable private xhrCheckNew?: JQuery.jqXHR<CheckUpdatesResponseJson>;
  private xhrGetUpdates?: JQuery.jqXHR<UpdateResponseJson>;

  private get canRefresh() {
    return this.xhrGetUpdates == null && this.hasUpdates;
  }

  private get hasUpdates() {
    return this.lastUpdateResponse != null && this.lastUpdateResponse > this.props.discussionsState.lastUpdateDate;
  }

  private get title() {
    if (this.xhrCheckNew != null) {
      return trans('beatmap_discussions.refresh.checking');
    }

    if (this.xhrGetUpdates != null) {
      return trans('beatmap_discussions.refresh.updating');
    }

    return this.hasUpdates ? trans('beatmap_discussions.refresh.has_updates') : trans('beatmap_discussions.refresh.no_updates');
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  componentDidMount() {
    this.timeoutCheckNew = window.setTimeout(this.checkNew, checkNewTimeoutDefault);
    document.addEventListener('turbolinks:before-cache', this.destroy);
  }

  render() {
    const updates = this.hasUpdates;

    return (
      <button
        className={classWithModifiers('back-to-top', { updates })}
        data-tooltip-float='fixed'
        disabled={!this.canRefresh}
        onClick={this.refresh}
        title={this.title}
      >
        <i className='fas fa-rotate' />
        {this.xhrCheckNew != null || this.xhrGetUpdates ? (
          <Spinner />
        ) : (
          <span className='fas fa-sync-alt' />
        )}
      </button>
    );
  }

  @action
  private readonly checkNew = () => {
    if (this.xhrCheckNew != null) return;

    window.clearTimeout(this.timeoutCheckNew);

    this.xhrCheckNew = $.getJSON(route('beatmapsets.discussion-check-updates', { beatmapset: this.props.discussionsState.beatmapset.id }));

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

  private readonly destroy = () => {
    document.removeEventListener('turbolinks:before-cache', this.destroy);
    window.clearTimeout(this.timeoutCheckNew);
    this.xhrCheckNew?.abort();
    this.xhrGetUpdates?.abort();
  };

  @action
  private readonly refresh = () => {
    if (this.xhrGetUpdates != null) return;

    // cancel any update check.
    window.clearTimeout(this.timeoutCheckNew);
    this.xhrCheckNew?.abort();

    this.xhrGetUpdates = $.getJSON(route('beatmapsets.discussion', { beatmapset: this.props.discussionsState.beatmapset.id }));

    this.xhrGetUpdates.done((json) => {
      if (json != null) {
        this.props.discussionsState.update({ beatmapset: json.beatmapset });
      }
    }).always(() => {
      this.xhrGetUpdates = undefined;
      // restart update checking.
      this.timeoutCheckNew = window.setTimeout(this.checkNew, checkNewTimeoutDefault);
    });
  };
}
