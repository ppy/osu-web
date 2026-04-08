// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import SelectOptions from 'components/select-options';
import Ruleset from 'interfaces/ruleset';
import SelectOptionJson from 'interfaces/select-option-json';
import { route } from 'laroute';
import * as React from 'react';
import { Modifiers } from 'utils/css';
import { fail } from 'utils/fail';
import { updateQueryString } from 'utils/url';

interface PropsBase {
  currentItem: SelectOptionJson;
  items: SelectOptionJson[];
  modifiers?: Modifiers;
}

type Props = PropsBase & ({
  type: 'daily_challenge' | 'download' | 'multiplayer' | 'seasons' | 'spotlight';
} | {
  ruleset: Ruleset;
  type: 'matchmaking';
});

// TODO: stricter typing; require only one of string or number at a time, not both.
export default class BasicSelectOptions extends React.PureComponent<Props> {
  private get options() {
    return this.props.items.map((item) => ({
      ...item,
      href: this.href(item.id),
    }));
  }

  render() {
    return (
      <SelectOptions
        href={this.href(this.props.currentItem.id)}
        modifiers={this.props.modifiers}
        options={this.options}
        selected={this.props.currentItem.id}
        text={this.props.currentItem.text}
      />
    );
  }

  private href(id?: string | number) {
    switch (this.props.type) {
      case 'daily_challenge':
        return route('daily-challenge.show', { daily_challenge: id ?? fail('missing id parameter') });
      case 'download':
        return route('download', { platform: id });
      case 'matchmaking':
        return route('rankings.matchmaking', { mode: this.props.ruleset, pool: id });
      case 'multiplayer':
        return route('multiplayer.rooms.show', { room: id ?? 'latest' });
      case 'seasons':
        return route('seasons.show', { season: id ?? 'latest' });
      case 'spotlight':
        return updateQueryString(null, { spotlight: id?.toString() });
    }
  }
}
