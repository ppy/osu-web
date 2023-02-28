// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import core from 'osu-core-singleton';
import * as React from 'react';
import { trans } from 'utils/lang';

interface Props {
  onClose: () => void;
}

export default class NsfwWarning extends React.PureComponent<Props> {
  render() {
    return (
      <div className='osu-page osu-page--generic'>
        <div className='nsfw-warning'>
          <div className='nsfw-warning__row nsfw-warning__row--icon'>
            <span className='fas fa-exclamation-triangle' />
          </div>

          <div className='nsfw-warning__row nsfw-warning__row--title'>
            {trans('beatmapsets.show.nsfw_warning.title')}
          </div>

          <div className='nsfw-warning__row'>
            {trans('beatmapsets.show.nsfw_warning.details')}
          </div>

          <div className='nsfw-warning__row nsfw-warning__row--buttons'>
            <button
              className='nsfw-warning__button nsfw-warning__button--show'
              onClick={this.props.onClose}
              type='button'
            >
              {trans('beatmapsets.show.nsfw_warning.buttons.show')}
            </button>

            {core.currentUser != null &&
              <button
                className='nsfw-warning__button nsfw-warning__button--show'
                onClick={this.disableWarning}
                type='button'
              >
                {trans('beatmapsets.show.nsfw_warning.buttons.disable')}
              </button>
            }

            <a className='nsfw-warning__button' href={route('beatmapsets.index')}>
              {trans('beatmapsets.show.nsfw_warning.buttons.listing')}
            </a>
          </div>
        </div>
      </div>
    );
  }

  private readonly disableWarning = () => {
    core.userPreferences.set('beatmapset_show_nsfw', true);
    this.props.onClose();
  };
}
