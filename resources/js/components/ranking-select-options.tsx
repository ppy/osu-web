// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import SelectOptions, { OptionRenderProps } from 'components/select-options';
import SelectOptionJson from 'interfaces/select-option-json';
import { route } from 'laroute';
import * as React from 'react';
import { navigate } from 'utils/turbolinks';

interface Props {
  currentItem: SelectOptionJson;
  items: SelectOptionJson[];
  type: 'multiplayer' | 'seasons';
}

export default class RankingSelectOptions extends React.PureComponent<Props> {
  render() {
    return (
      <SelectOptions
        modifiers='spotlight'
        onChange={this.handleChange}
        options={this.props.items}
        renderOption={this.renderOption}
        selected={this.props.currentItem}
      />
    );
  }

  private handleChange = (option: SelectOptionJson) => {
    navigate(this.href(option.id));
  };

  private href(id: number | null) {
    switch (this.props.type) {
      case 'multiplayer':
        return route('multiplayer.rooms.show', { room: id ?? 'latest' });
      case 'seasons':
        return route('seasons.show', { season: id ?? 'latest' });
    }
  }

  private renderOption = (props: OptionRenderProps<SelectOptionJson>) => (
    <a
      key={props.option.id ?? -1}
      className={props.cssClasses}
      href={this.href(props.option.id)}
      onClick={props.onClick}
    >
      {props.children}
    </a>
  );
}
