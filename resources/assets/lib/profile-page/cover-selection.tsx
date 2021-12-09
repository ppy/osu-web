// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import * as React from 'react';
import { onErrorWithCallback } from 'utils/ajax';
import { classWithModifiers, Modifiers } from 'utils/css';

const bn = 'profile-cover-selection';

interface Props {
  isSelected: boolean;
  modifiers?: Modifiers;
  name: string;
  thumbUrl: string | null;
  url: string | null;
}

export default class CoverSelection extends React.PureComponent<Props> {
  render() {
    return (
      <button
        className={classWithModifiers(bn, this.props.modifiers)}
        onClick={this.onClick}
        onMouseEnter={this.onMouseEnter}
        onMouseLeave={this.onMouseLeave}
        style={{
          backgroundImage: osu.urlPresence(this.props.thumbUrl),
        }}
      >
        {this.props.isSelected && (
          <span className='profile-cover-selection__selected'>
            <span className='far fa-check-circle' />
          </span>
        )}
      </button>
    );
  }

  private readonly onClick = () => {
    if (this.props.url == null) return;

    $.publish('user:cover:upload:state', [true]);

    $.ajax(route('account.cover'), {
      data: {
        cover_id: this.props.name,
      },
      dataType: 'json',
      method: 'post',
    }).always(() => {
      $.publish('user:cover:upload:state', [false]);
    }).done((userData) => {
      $.publish('user:update', userData);
    }).fail(onErrorWithCallback(this.onClick));
  };

  private readonly onMouseEnter = () => {
    if (this.props.url == null) return;

    $.publish('user:cover:set', this.props.url);
  };

  private readonly onMouseLeave = () => {
    $.publish('user:cover:reset');
  };
}
