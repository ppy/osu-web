// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import { route } from 'laroute';
import { action, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import DiscussionsState from './discussions-state';

interface Props {
  discussionsState: DiscussionsState;
}

interface UpdateResponseJson {
  beatmapset: BeatmapsetWithDiscussionsJson;
}

const checkNewTimeoutDefault = 10000;
const checkNewTimeoutMax = 60000;

@observer
export class Refresh extends React.PureComponent<Props> {
  private nextTimeout = checkNewTimeoutDefault;
  private timeoutCheckNew?: number;
  private xhrCheckNew?: JQuery.jqXHR<UpdateResponseJson>;

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  componentDidMount() {
    this.timeoutCheckNew = window.setTimeout(this.checkNew, checkNewTimeoutDefault);
    document.addEventListener('turbolinks:before-cache', this.destroy);
  }

  render() {
    return null;
  }

  @action
  private readonly checkNew = () => {
    if (this.xhrCheckNew != null) return;

    window.clearTimeout(this.timeoutCheckNew);

    this.xhrCheckNew = $.get(route('beatmapsets.discussion', { beatmapset: this.props.discussionsState.beatmapset.id }), {
      format: 'json',
      last_updated: this.props.discussionsState.lastUpdate,
    });

    this.xhrCheckNew.done((data, _textStatus, xhr) => {
      if (xhr.status === 304) {
        this.nextTimeout *= 2;
        return;
      }

      this.nextTimeout = checkNewTimeoutDefault;
      this.props.discussionsState.update({ beatmapset: data.beatmapset });
    }).always(() => {
      this.nextTimeout = Math.min(this.nextTimeout, checkNewTimeoutMax);

      this.timeoutCheckNew = window.setTimeout(this.checkNew, this.nextTimeout);
      this.xhrCheckNew = undefined;
    });
  };

  private readonly destroy = () => {
    document.removeEventListener('turbolinks:before-cache', this.destroy);
    window.clearTimeout(this.timeoutCheckNew);
    this.xhrCheckNew?.abort();
  };
}
