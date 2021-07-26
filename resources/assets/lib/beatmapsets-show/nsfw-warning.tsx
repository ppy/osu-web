// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import * as osu from 'osu-common';
import core from 'osu-core-singleton';
import * as React from 'react';

interface Props {
  onClose: () => void;
}

interface State {
  busy: boolean;
}

export default class NsfwWarning extends React.PureComponent<Props, State> {
  private xhr?: JQuery.jqXHR;

  constructor(props: Props) {
    super(props);

    this.state = {
      busy: false,
    };
  }

  componentWillUnmount() {
    this.xhr?.abort();
  }

  render() {
    return (
      <div className='osu-page osu-page--generic'>
        <div className='nsfw-warning'>
          <div className='nsfw-warning__row nsfw-warning__row--icon'>
            <span className='fas fa-exclamation-triangle' />
          </div>

          <div className='nsfw-warning__row nsfw-warning__row--title'>
            {osu.trans('beatmapsets.show.nsfw_warning.title')}
          </div>

          <div className='nsfw-warning__row'>
            {osu.trans('beatmapsets.show.nsfw_warning.details')}
          </div>

          <div className='nsfw-warning__row nsfw-warning__row--buttons'>
            <button
              className='nsfw-warning__button nsfw-warning__button--show'
              disabled={this.state.busy}
              onClick={this.props.onClose}
              type='button'
            >
              {osu.trans('beatmapsets.show.nsfw_warning.buttons.show')}
            </button>

            {currentUser.id != null &&
              <button
                className='nsfw-warning__button nsfw-warning__button--show'
                disabled={this.state.busy}
                onClick={this.disableWarning}
                type='button'
              >
                {osu.trans('beatmapsets.show.nsfw_warning.buttons.disable')}
              </button>
            }

            <a className='nsfw-warning__button' href={route('beatmapsets.index')}>
              {osu.trans('beatmapsets.show.nsfw_warning.buttons.listing')}
            </a>
          </div>
        </div>
      </div>
    );
  }

  private disableWarning = () => {
    this.xhr = core.userPreferences.set('beatmapset_show_nsfw', true);

    if (this.xhr == null) {
      this.props.onClose();
    } else {
      this.setState({ busy: true });
      this.xhr
        .always(() => this.setState({ busy: false }))
        .done(this.props.onClose);
    }
  };
}
