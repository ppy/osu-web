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
import * as _ from 'lodash';
import * as React from 'react';
import { Transforms } from 'slate';
import { ReactEditor } from 'slate-react';
import { PopupMenuPersistent } from '../popup-menu-persistent';
import { SlateContext } from './slate-context';

export default class EditorBeatmapSelector extends React.Component<any, any> {
  static contextType = SlateContext;

  render(): React.ReactNode {
    return (
      <PopupMenuPersistent customRender={this.renderButton}>
        {() => {
          return (
            <div className='simple-menu simple-menu--popup-menu-compact'>
              {this.props.beatmaps.map((beatmap: Beatmap) => this.renderItem(beatmap))}
            </div>
            );
        }}
      </PopupMenuPersistent>
    );
  }

  renderButton = (children: JSX.Element[], ref: React.RefObject<HTMLDivElement>, toggle: (event: React.MouseEvent<HTMLElement>) => void) => {
    const beatmap = this.props.element.beatmapId ? _.find(this.props.beatmaps, (b) => b.id === this.props.element.beatmapId) : this.props.currentBeatmap;
    return (
      <div ref={ref} className='beatmap-discussion-newer__dropdown' onClick={toggle} contentEditable={false} style={{userSelect: 'none'}}>
          <BeatmapIcon
            beatmap={beatmap}
          />
          {children}
      </div>
    );
  }

  renderItem = (beatmap: Beatmap) => {
    if (beatmap.deleted_at) {
      return null;
    }
    const menuItemClasses = 'simple-menu__item';

    return (
      <button
        className={menuItemClasses}
        key={beatmap.id}
        data-id={beatmap.id}
        onClick={this.select}
      >
        <BeatmapIcon
          beatmap={beatmap}
          showTitle={false}
        />
        <div
          style={{
            paddingLeft: '5px',
          }}
        >
          {beatmap.version}
        </div>
      </button>
    );
  }

  select = (event: React.MouseEvent<HTMLElement>) => {
    event.preventDefault();

    const target = event.currentTarget as HTMLElement;

    if (!target) {
      return;
    }

    const id = parseInt(target.dataset.id || '', 10);
    if (id) {
      const path = ReactEditor.findPath(this.context, this.props.element);
      Transforms.setNodes(this.context, {beatmapId: id}, {at: path});
    }
  }
}
