// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Option, OptionRenderProps, SelectOptions } from 'components/select-options';
import { route } from 'laroute';
import * as React from 'react';
import { navigate } from 'utils/turbolinks';

interface ItemJson {
  id: number;
  name: string;
}

interface Props {
  currentItem: ItemJson;
  items: ItemJson[];
  type: 'multiplayer' | 'seasons';
}

export default class RankingSelectOptions extends React.PureComponent<Props> {
  render() {
    const options = this.props.items.map((item) => ({
      id: item.id,
      text: item.name,
    }));

    const selected = {
      id: this.props.currentItem.id,
      text: this.props.currentItem.name,
    };

    return (
      <SelectOptions
        modifiers='spotlight'
        onChange={this.handleChange}
        options={options}
        renderOption={this.renderOption}
        selected={selected}
      />
    );
  }

  private handleChange = (option: Option<number>) => {
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

  private renderOption = (props: OptionRenderProps<number>) => (
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
