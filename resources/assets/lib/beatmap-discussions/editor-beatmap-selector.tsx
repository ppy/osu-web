// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapIcon } from 'beatmap-icon';
import * as React from 'react';
import { Node, Transforms } from 'slate';
import { ReactEditor } from 'slate-react';
import IconDropdownMenu, { MenuItem } from './icon-dropdown-menu';
import { SlateContext } from './slate-context';

interface Props {
  beatmaps: Beatmap[];
  disabled: boolean;
  element: Node;
}

export default class EditorBeatmapSelector extends React.Component<Props> {
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

    this.props.beatmaps.forEach((beatmap: Beatmap) => {
      if (beatmap.deleted_at) {
        return;
      }

      this.menuOptions.push({
        icon: <BeatmapIcon beatmap={beatmap} showTitle={false} />,
        id: `${beatmap.id}`, // explicit conversion to string
        label: beatmap.version,
      });
    });
  }

  render(): React.ReactNode {
    return (
      <IconDropdownMenu
        disabled={this.props.disabled}
        menuOptions={this.menuOptions}
        onSelect={this.select}
        selected={`${this.props.element.beatmapId}`}
      />
    );
  }

  select = (id: string) => {
    const beatmapId = id !== 'all' ? parseInt(id || '', 10) : 'all';

    if (beatmapId) {
      const path = ReactEditor.findPath(this.context, this.props.element);
      Transforms.setNodes(this.context, {beatmapId}, {at: path});
    }
  }
}
