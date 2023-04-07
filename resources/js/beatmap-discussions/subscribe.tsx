// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import BeatmapsetJson from 'interfaces/beatmapset-json';
import { route } from 'laroute';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { emitError } from 'utils/ajax';
import { trans } from 'utils/lang';

interface Props {
  beatmapset: BeatmapsetJson;
}

@observer
export class Subscribe extends React.Component<Props> {
  @observable xhr: JQuery.jqXHR | null = null;

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  private get isWatching() {
    return this.props.beatmapset.current_user_attributes?.is_watching ?? false;
  }

  private get loading() {
    return this.xhr != null;
  }

  componentWillUnmount() {
    this.xhr?.abort();
  }

  render() {
    return (
      <BigButton
        disabled={this.loading}
        icon={this.isWatching ? 'fas fa-eye-slash' : 'fas fa-eye'}
        isBusy={this.loading}
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
    this.xhr = $.ajax(route('beatmapsets.watches.update', { watch: this.props.beatmapset.id }), {
      dataType: 'json',
      type: this.isWatching ? 'DELETE' : 'PUT',
    });

    this.xhr.done(() => {
      $.publish('beatmapsetDiscussions:update', { watching: !this.isWatching });
    })
      .fail(emitError())
      .always(action(() => this.xhr = null));
  };
}
