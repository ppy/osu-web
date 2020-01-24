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

import * as React from 'react';
import { Transforms } from 'slate';
import { ReactEditor } from 'slate-react';
import { PopupMenuPersistent } from '../popup-menu-persistent';
import { SlateContext } from './slate-context';

type DiscussionType = 'hype' | 'mapperNote' | 'praise' | 'problem' | 'suggestion';
const selectableTypes: DiscussionType[] = ['praise', 'problem', 'suggestion'];

export default class EditorIssueTypeSelector extends React.Component<any, any> {
  static contextType = SlateContext;

  render(): React.ReactNode {
    return (
      <PopupMenuPersistent customRender={this.renderButton}>
        {() => {
          return (
            <div className='simple-menu simple-menu--popup-menu-compact'>
              {selectableTypes.map((type: DiscussionType) => this.renderListItem(type))}
            </div>
            );
        }}
      </PopupMenuPersistent>
    );
  }

  renderButton = (children: JSX.Element[], ref: React.RefObject<HTMLDivElement>, toggle: (event: React.MouseEvent<HTMLElement>) => void) => {
    const type: DiscussionType = this.props.element.discussionType;
    const icons = {
      hype: 'fas fa-bullhorn',
      mapperNote: 'far fa-sticky-note',
      praise: 'fas fa-heart',
      problem: 'fas fa-exclamation-circle',
      suggestion: 'far fa-circle',
    };

    return (
      <div
        className='beatmap-discussion-editor__dropdown'
        contentEditable={false}
        onClick={toggle}
        ref={ref}
      >
          <span className={`beatmap-discussion-message-type beatmap-discussion-message-type--${type}`}><i className={icons[type]} /></span>
          {children}
      </div>
    );
  }

  renderListItem = (type: DiscussionType) => {
    const menuItemClasses = 'simple-menu__item';
    const icons = {
      hype: 'fas fa-bullhorn',
      mapperNote: 'far fa-sticky-note',
      praise: 'fas fa-heart',
      problem: 'fas fa-exclamation-circle',
      suggestion: 'far fa-circle',
    };

    return (
      <button
        className={menuItemClasses}
        key={type}
        data-type={type}
        onClick={this.select}
      >
        <div
          style={{
            paddingLeft: '5px',
          }}
        >
          <span className={`beatmap-discussion-message-type beatmap-discussion-message-type--${type}`} style={{paddingRight: '5px'}}><i className={icons[type]} /></span>
          {type}
        </div>
      </button>
    );
  }

  select = (event: React.MouseEvent<HTMLElement>) => {
    event.preventDefault();

    const target = event.currentTarget;

    if (!target) {
      return;
    }

    const path = ReactEditor.findPath(this.context, this.props.element);
    Transforms.setNodes(this.context, {discussionType: target.dataset.type}, {at: path});
  }
}
