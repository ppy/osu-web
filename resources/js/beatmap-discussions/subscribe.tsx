// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import BeatmapsetJson from 'interfaces/beatmapset-json';
import { route } from 'laroute';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { onError } from 'utils/ajax';
import { trans } from 'utils/lang';

interface Props {
  beatmapset: BeatmapsetJson;
}

@observer
export class Subscribe extends React.Component<Props> {
  @observable private xhr: JQuery.jqXHR<void> | null = null;

  private get busy() {
    return this.xhr != null;
  }

  private get isWatching() {
    return this.props.beatmapset.current_user_attributes?.is_watching ?? false;
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentWillUnmount() {
    this.xhr?.abort();
  }

  render() {
    return (
      <BigButton
        disabled={this.busy}
        icon={this.isWatching ? 'fas fa-eye-slash' : 'fas fa-eye'}
        isBusy={this.busy}
        modifiers='full'
        props={{
          onClick: this.toggleWatch,
        }}
        text={trans(`common.buttons.watch.to_${+!this.isWatching}`)}
      />
    );
  }

  @action
  private readonly toggleWatch = () => {
    if (this.busy) return;

    this.xhr = $.ajax(route('beatmapsets.watches.update', { watch: this.props.beatmapset.id }), {
      dataType: 'json',
      type: this.isWatching ? 'DELETE' : 'PUT',
    });

    this.xhr.done(() => {
      $.publish('beatmapsetDiscussions:update', { watching: !this.isWatching });
    })
      .fail(onError)
      .always(action(() => this.xhr = null));
  };
}
