// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import SelectOptions, { OptionRenderProps } from 'components/select-options';
import SelectOptionJson from 'interfaces/select-option-json';
import { route } from 'laroute';
import * as React from 'react';
import { fail } from 'utils/fail';
import { navigate } from 'utils/turbolinks';
import { updateQueryString } from 'utils/url';

interface Props {
  currentItem: SelectOptionJson;
  items: SelectOptionJson[];
  type: 'daily_challenge' | 'multiplayer' | 'seasons' | 'spotlight';
}

export default class BasicSelectOptions extends React.PureComponent<Props> {
  render() {
    return (
      <SelectOptions
        onChange={this.handleChange}
        options={this.props.items}
        renderOption={this.renderOption}
        selected={this.props.currentItem}
      />
    );
  }

  private readonly handleChange = (option: SelectOptionJson) => {
    navigate(this.href(option.id));
  };

  private href(id: number | null) {
    switch (this.props.type) {
      case 'daily_challenge':
        return route('daily-challenge.show', { daily_challenge: id ?? fail('missing id parameter') });
      case 'multiplayer':
        return route('multiplayer.rooms.show', { room: id ?? 'latest' });
      case 'seasons':
        return route('seasons.show', { season: id ?? 'latest' });
      case 'spotlight':
        return updateQueryString(null, { spotlight: id?.toString() });
    }
  }

  private readonly renderOption = (props: OptionRenderProps<SelectOptionJson>) => (
    <a
      key={props.option.id}
      className={props.cssClasses}
      href={this.href(props.option.id)}
      onClick={props.onClick}
    >
      {props.children}
    </a>
  );
}
