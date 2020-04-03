// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { Node, Transforms } from 'slate';
import { ReactEditor } from 'slate-react';
import IconDropdownMenu, { MenuItem } from './icon-dropdown-menu';
import { SlateContext } from './slate-context';

type DiscussionType = 'hype' | 'mapperNote' | 'praise' | 'problem' | 'suggestion';
const selectableTypes: DiscussionType[] = ['praise', 'problem', 'suggestion'];
const discussionTypeIcons = {
  hype: 'fas fa-fw fa-bullhorn',
  mapperNote: 'far fa-fw fa-sticky-note',
  praise: 'fas fa-fw fa-heart',
  problem: 'fas fa-fw fa-exclamation-circle',
  suggestion: 'far fa-fw fa-circle',
};

interface Props {
  beatmaps: Beatmap[];
  disabled: boolean;
  element: Node;
}

export default class EditorIssueTypeSelector extends React.Component<Props> {
  static contextType = SlateContext;
  menuOptions: MenuItem[];

  constructor(props: Props) {
    super(props);

    this.menuOptions = [];
    this.menuOptions.push({
      icon: <i className='fas fa-fw fa-star-of-life beatmap-discussion-editor__menu-icon' />,
      id: 'all',
      label: osu.trans('beatmaps.discussions.mode.scopes.generalAll'),
    });

    selectableTypes.forEach((type) => {
      this.menuOptions.push({
        icon: <span className={`beatmap-discussion-message-type beatmap-discussion-message-type--${type}`}><i className={`${discussionTypeIcons[type]} beatmap-discussion-editor__menu-icon`} /></span>,
        id: type,
        label: osu.trans(`beatmaps.discussions.message_type.${type}`),
      });
    });
  }

  render(): React.ReactNode {
    return (
      <IconDropdownMenu
        disabled={this.props.disabled}
        menuOptions={this.menuOptions}
        onSelect={this.select}
        selected={`${this.props.element.discussionType}`}
      />
    );
  }

  select = (discussionType: string) => {
    const path = ReactEditor.findPath(this.context, this.props.element);
    Transforms.setNodes(this.context, {discussionType}, {at: path});
  }
}
