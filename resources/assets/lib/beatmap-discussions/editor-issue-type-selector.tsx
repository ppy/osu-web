// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { discussionTypeIcons } from 'beatmap-discussions/discussion-type';
import { EmbedElement } from 'editor';
import { BeatmapReviewDiscussionType, beatmapReviewDiscussionTypes } from 'interfaces/beatmap-discussion-review';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import * as React from 'react';
import { Transforms } from 'slate';
import { ReactEditor } from 'slate-react';
import { trans } from 'utils/lang';
import IconDropdownMenu, { MenuItem } from './icon-dropdown-menu';
import { SlateContext } from './slate-context';

interface Props {
  beatmaps: BeatmapExtendedJson[];
  disabled: boolean;
  element: EmbedElement;
}

export default class EditorIssueTypeSelector extends React.Component<Props> {
  static contextType = SlateContext;
  declare context: React.ContextType<typeof SlateContext>;

  render() {
    const menuOptions: MenuItem[] = beatmapReviewDiscussionTypes.map((type) => ({
      icon: <span className={`beatmap-discussion-message-type beatmap-discussion-message-type--${type}`}><i className={discussionTypeIcons[type]} /></span>,
      id: type,
      label: trans(`beatmaps.discussions.message_type.${type}`),
    }));

    return (
      <IconDropdownMenu
        disabled={this.props.disabled}
        menuOptions={menuOptions}
        onSelect={this.select}
        selected={this.props.element.discussionType}
      />
    );
  }

  select = (discussionType: BeatmapReviewDiscussionType) => {
    const path = ReactEditor.findPath(this.context, this.props.element);
    Transforms.setNodes(this.context, { discussionType }, { at: path });
  };
}
