// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { discussionTypeIcons } from 'beatmap-discussions/discussion-type';
import { EmbedElement } from 'editor';
import { BeatmapReviewDiscussionType, beatmapReviewDiscussionTypes, beatmapReviewDiscussionTypesWithoutNote } from 'interfaces/beatmap-discussion-review';
import { HasDiscussionsEditable } from 'interfaces/has-discussions';
import * as React from 'react';
import { Transforms } from 'slate';
import { ReactEditor } from 'slate-react';
import { fail } from 'utils/fail';
import { trans } from 'utils/lang';
import { discussionPageForNode } from './editor-helpers';
import IconDropdownMenu, { MenuItem } from './icon-dropdown-menu';
import { SlateContext } from './slate-context';

interface Props extends HasDiscussionsEditable {
  disabled: boolean;
  element: EmbedElement;
}

export default class EditorIssueTypeSelector extends React.Component<Props> {
  static contextType = SlateContext;
  declare context: React.ContextType<typeof SlateContext>;

  get currentBeatmap() {
    if (this.props.element.beatmapId == null) return null;
    return this.props.store.beatmaps.get(this.props.element.beatmapId) ?? fail('missing beatmap');
  }

  render() {
    const types = this.props.discussionsState.canPostNote(this.currentBeatmap, discussionPageForNode(this.props.element, this.currentBeatmap))
      ? beatmapReviewDiscussionTypes
      : beatmapReviewDiscussionTypesWithoutNote;

    const menuOptions: MenuItem[] = types.map((type) => ({
      icon: <span className={discussionTypeIcons[type]} style={{ color: `var(--beatmapset-discussion-colour--${type})` }} />,
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
