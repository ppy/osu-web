/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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
