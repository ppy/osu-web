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
import * as ReactDOM from 'react-dom';

export default class EditorBeatmapSelector extends React.Component<any, any> {
  portal: HTMLDivElement;
  private topRef: React.RefObject<HTMLDivElement>;

  constructor(props: {}) {
    super(props);
    this.portal = document.createElement('div');
    document.body.appendChild(this.portal);
    this.topRef = React.createRef<HTMLDivElement>();

    this.state = {
      visible: false,
    };
  }

  select = (event: React.MouseEvent<HTMLElement>) => {
    event.preventDefault();

    const target = event.currentTarget as HTMLElement;

    if (!target) {
      return;
    }

    const id = parseInt(target.dataset.id || '', 10);
    if (id) {
      this.setState({visible: false}, () => {
        const {editor, node} = this.props;
        const data = node.data.merge({beatmapId: id});
        editor.setNodeByKey(node.key, {data});
      });
    }
  }

  toggleMenu = (event: Event) => {
    event.preventDefault();
    this.setState({
      visible: !this.state.visible,
    });
  }

  beatmapThing = (beatmap: Beatmap) => {
    if (beatmap.deleted_at) {
      return null;
    }
    const menuItemClasses = '';

    return (
      <a
        href='#'
        className={menuItemClasses}
        key={beatmap.id}
        data-id={beatmap.id}
        style={{
          display: 'flex',
        }}
        onClick={this.select}
      >
        <BeatmapIcon
          beatmap={beatmap}
        />
        <div
          style={{
            paddingLeft: '5px',
          }}
        >
          {beatmap.version}
        </div>
      </a>
    );
  }

  componentDidUpdate(prevProps: Readonly<any>, prevState: Readonly<any>, snapshot?: any): void {
    if (!this.topRef.current) {
      return;
    }

    const position = $(this.topRef.current).offset();
    if (!position) {
      return;
    }

    const { top, left } = position;
    this.portal.style.position = 'absolute';
    this.portal.style.top = `${Math.floor(top + this.topRef.current.offsetHeight)}px`;
    this.portal.style.left = `${Math.floor(left)}px`;

  }

  renderList = () => {
    return ReactDOM.createPortal(
        <div className='beatmap-discussion-newer__dropdown-menu' contentEditable={false}>
          {this.props.beatmaps.map((bm: Beatmap) => this.beatmapThing(bm))}
        </div>
      , this.portal);
  }

  render(): React.ReactNode {
    const beatmap = this.props.node.data.get('beatmapId') ? _.find(this.props.beatmaps, (b) => b.id === this.props.node.data.get('beatmapId')) : this.props.currentBeatmap;
    return (
      <React.Fragment>
        <a href='#' className='beatmap-discussion-newer__dropdown' onClick={this.toggleMenu} contentEditable={false} {...this.props.attributes} ref={this.topRef}>
          <BeatmapIcon
            beatmap={beatmap}
          />
        </a>
        {this.state.visible && this.renderList()}
      </React.Fragment>
    );
  }
}
