// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import mapperGroup from 'beatmap-discussions/mapper-group';
import SelectOptions, { OptionRenderProps } from 'components/select-options';
import UserJson from 'interfaces/user-json';
import { action } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { makeUrl, parseUrl } from 'utils/beatmapset-discussion-helper';
import { groupColour } from 'utils/css';
import { trans } from 'utils/lang';
import DiscussionsState from './discussions-state';

const allUsers = Object.freeze({
  id: null,
  text: trans('beatmap_discussions.user_filter.everyone'),
});

const noSelection = Object.freeze({
  id: null,
  text: trans('beatmap_discussions.user_filter.label'),
});

interface Option {
  groups: UserJson['groups'];
  id: UserJson['id'];
  text: UserJson['username'];
}

interface Props {
  discussionsState: DiscussionsState;
}

function mapUserProperties(user: UserJson): Option {
  return {
    groups: user.groups,
    id: user.id,
    text: user.username,
  };
}

@observer
export class UserFilter extends React.Component<Props> {
  private get ownerId() {
    return this.props.discussionsState.beatmapset.user_id;
  }

  private get selected() {
    return this.props.discussionsState.selectedUser != null
      ? mapUserProperties(this.props.discussionsState.selectedUser)
      : noSelection;
  }

  private get options() {
    return [allUsers, ...Object.values(this.props.discussionsState.users).map(mapUserProperties)];
  }

  render() {
    return (
      <SelectOptions
        modifiers='beatmap-discussions-user-filter'
        onChange={this.handleChange}
        options={this.options}
        renderOption={this.renderOption}
        selected={this.selected}
      />
    );
  }

  @action
  private readonly handleChange = (option: Option) => {
    this.props.discussionsState.selectedUserId = option.id;
  };

  private isOwner(user?: Option) {
    return user != null && user.id === this.ownerId;
  }

  private readonly renderOption = ({ cssClasses, children, onClick, option }: OptionRenderProps<Option>) => {
    // TODO: exclude null/undefined user from discussionsState
    if (option.id < 0) return;

    const group = this.isOwner(option) ? mapperGroup : option.groups?.[0];
    const style = groupColour(group);

    const urlOptions = parseUrl();
    // means it doesn't work on non-beatmapset discussion paths
    if (urlOptions == null) return null;

    urlOptions.user = option?.id;

    return (
      <a
        key={option.id}
        className={cssClasses}
        href={makeUrl(urlOptions)}
        onClick={onClick}
        style={style}
      >
        {children}
      </a>
    );
  };
}
