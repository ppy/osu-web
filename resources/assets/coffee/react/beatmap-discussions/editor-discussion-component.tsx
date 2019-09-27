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
import EditorBeatmapSelector from './editor-beatmap-selector';

type DiscussionType = 'hype' | 'mapperNote' | 'praise' | 'problem' | 'suggestion';

export default class EditorDiscussionComponent extends React.Component<any, any> {
  remove = (event: React.MouseEvent<HTMLElement>) => {
    const { editor, node } = this.props;

    event.preventDefault();
    editor.removeNodeByKey(node.key);
  }

  render(): React.ReactNode {
    const { isFocused, node } = this.props;
    const styles = isFocused ? {} : {};
    // const styles = {};
    const type: DiscussionType = node.data.get('type');
    const icons = {
      hype: 'fas fa-bullhorn',
      mapperNote: 'far fa-sticky-note',
      praise: 'fas fa-heart',
      problem: 'fas fa-exclamation-circle',
      suggestion: 'far fa-circle',
    };

    return (
      <div className='beatmap-discussion beatmap-discussion--preview' style={styles} {...this.props.attributes}>
        <div className='beatmap-discussion__discussion'>
            <div className='beatmap-discussion-post beatmap-discussion-post--reply'>
                <div className='beatmap-discussion-post__content'>
                    <EditorBeatmapSelector {...this.props}/>
                    <div className='beatmap-discussion-post__user-container' contentEditable={false}>
                      <div className='beatmap-discussion-timestamp__icons-container' style={{marginRight: '10px'}}>
                        <div className='beatmap-discussion-timestamp__icons'>
                          <div className='beatmap-discussion-timestamp__icon'>
                            <span className={`beatmap-discussion-message-type beatmap-discussion-message-type--${type}`}><i className={icons[type]} /></span>
                          </div>
                          <div className='beatmap-discussion-timestamp__icon beatmap-discussion-timestamp__icon--resolved'>
                            {/*<i className="far fa-check-circle"></i>*/}
                          </div>
                        </div>
                        <div className='beatmap-discussion-timestamp__text'>00:00.184</div>
                      </div>
                      <div className='beatmap-discussion-post__user-stripe'/>
                    </div>
                    <div className='beatmap-discussion-post__message-container undefined'>
                        <div className='beatmapset-discussion-message'>{this.props.children}</div>
                        <div className='beatmap-discussion-post__actions' contentEditable={false}>
                            <div className='beatmap-discussion-post__actions-group'>
                                <a className='beatmap-discussion-post__action beatmap-discussion-post__action--button' href='#' onClick={this.remove}>delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    );
  }
}

