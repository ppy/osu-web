// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapReviewDiscussionType } from 'interfaces/beatmap-discussion-review';
import BeatmapJsonExtended from 'interfaces/beatmap-json-extended';
import * as osu from 'osu-common';
import * as React from 'react';
import { Element, Transforms } from 'slate';
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
  beatmaps: BeatmapJsonExtended[];
  disabled: boolean;
  element: Element;
}

export default class EditorIssueTypeSelector extends React.Component<Props> {
  static contextType = SlateContext;
  declare context: React.ContextType<typeof SlateContext>;

  render(): React.ReactNode {
    const menuOptions: MenuItem[] = selectableTypes.map((type) => ({
      icon: <span className={`beatmap-discussion-message-type beatmap-discussion-message-type--${type}`}><i className={`${discussionTypeIcons[type]}`} /></span>,
      id: type,
      label: osu.trans(`beatmaps.discussions.message_type.${type}`),
    }));

    return (
      <IconDropdownMenu
        disabled={this.props.disabled}
        menuOptions={menuOptions}
        onSelect={this.select}
        selected={this.props.element.discussionType as BeatmapReviewDiscussionType}
      />
    );
  }

  select = (discussionType: string) => {
    const path = ReactEditor.findPath(this.context, this.props.element);
    Transforms.setNodes(this.context, { discussionType }, { at: path });
  };
}
