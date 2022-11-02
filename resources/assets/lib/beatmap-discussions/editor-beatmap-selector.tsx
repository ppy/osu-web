// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapIcon } from 'components/beatmap-icon';
import BeatmapListItem from 'components/beatmap-list-item';
import { EmbedElement } from 'editor';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import * as React from 'react';
import { Transforms } from 'slate';
import { ReactEditor } from 'slate-react';
import { classWithModifiers } from 'utils/css';
import IconDropdownMenu, { MenuItem } from './icon-dropdown-menu';
import { SlateContext } from './slate-context';

interface Props {
  beatmaps: BeatmapExtendedJson[];
  disabled: boolean;
  element: EmbedElement;
}

export default class EditorBeatmapSelector extends React.Component<Props> {
  static contextType = SlateContext;
  declare context: React.ContextType<typeof SlateContext>;

  render(): React.ReactNode {
    const menuOptions: MenuItem[] = [];
    const listItemModifier = 'full-width';
    menuOptions.push({
      icon: <i className='fas fa-fw fa-star-of-life' />,
      id: 'all',
      label: (
        <div className={classWithModifiers('beatmap-list-item', listItemModifier)}>
          <div className='beatmap-list-item__col beatmap-list-item__col--icon'>
            <i className='fas fa-xs fa-star-of-life' />
          </div>
          <div className='beatmap-list-item__col beatmap-list-item__col--main'>
            {osu.trans('beatmaps.discussions.mode.scopes.generalAll')}
          </div>
        </div>
      ),
      renderIcon: false,
    });

    this.props.beatmaps.forEach((beatmap: BeatmapExtendedJson) => {
      if (beatmap.deleted_at) {
        return;
      }

      menuOptions.push({
        icon: <BeatmapIcon beatmap={beatmap} />,
        id: beatmap.id.toString(),
        label: <BeatmapListItem beatmap={beatmap} modifiers={listItemModifier} />,
        renderIcon: false,
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
