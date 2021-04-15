// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapIcon } from 'beatmap-icon';
import BeatmapJsonExtended from 'interfaces/beatmap-json-extended';
import * as React from 'react';
import { Node, Transforms } from 'slate';
import { ReactEditor } from 'slate-react';
import IconDropdownMenu, { MenuItem } from './icon-dropdown-menu';
import { SlateContext } from './slate-context';

interface Props {
  beatmaps: BeatmapJsonExtended[];
  disabled: boolean;
  element: Node;
}

export default class EditorBeatmapSelector extends React.Component<Props> {
  static contextType = SlateContext;
  declare context: React.ContextType<typeof SlateContext>;

  render(): React.ReactNode {
    const menuOptions: MenuItem[] = [];
    menuOptions.push({
      icon: <i className='fas fa-fw fa-star-of-life' />,
      id: 'all',
      label: osu.trans('beatmaps.discussions.mode.scopes.generalAll'),
    });

    this.props.beatmaps.forEach((beatmap: BeatmapJsonExtended) => {
      if (beatmap.deleted_at) {
        return;
      }

      menuOptions.push({
        icon: <BeatmapIcon beatmap={beatmap} showTitle={false} />,
        id: beatmap.id.toString(),
        label: beatmap.version,
      });
    });

    return (
      <IconDropdownMenu
        disabled={this.props.disabled}
        menuOptions={menuOptions}
        onSelect={this.select}
        selected={(this.props.element.beatmapId as number)?.toString()}
      />
    );
  }

  select = (id: string) => {
    const beatmapId = id !== 'all' ? parseInt(id, 10) : undefined;

    const path = ReactEditor.findPath(this.context, this.props.element);
    Transforms.setNodes(this.context, {beatmapId}, {at: path});
  };
}
