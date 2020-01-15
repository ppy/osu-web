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
import { RenderElementProps } from 'slate-react';
import { ReactEditor } from 'slate-react';
import EditorBeatmapSelector from './editor-beatmap-selector';
import EditorIssueTypeSelector from './editor-issue-type-selector';
import { SlateContext } from './slate-context';

interface Props extends RenderElementProps {
  beatmaps: Beatmap[];
  beatmapset: Beatmapset;
  currentBeatmap: Beatmap;
  currentDiscussions: BeatmapDiscussion[];
}

export default class EditorDiscussionComponent extends React.Component<Props> {
  static contextType = SlateContext;

  componentDidUpdate(prevProps: Readonly<Props>, prevState: Readonly<{}>, snapshot?: any): void {
    if (this.props.element.beatmapId !== 'all') {
      const content = this.props.element.children[0].text;
      const TS_REGEX = /((\d{2,}):([0-5]\d)[:.](\d{3}))( \((?:\d[,|])*\d\))?/;
      const matches = content.match(TS_REGEX);
      let timestamp = osu.trans('beatmap_discussions.timestamp_display.general');

      if (matches !== null) {
        timestamp = matches[1];
      }

      const path = ReactEditor.findPath(this.context, this.props.element);
      Transforms.setNodes(this.context, {timestamp}, {at: path});
    } else {
      const path = ReactEditor.findPath(this.context, this.props.element);
      Transforms.setNodes(this.context, {timestamp: null}, {at: path});
    }
  }

  remove = (event: React.MouseEvent<HTMLElement>) => {
    event.preventDefault();
    const path = ReactEditor.findPath(this.context, this.props.element);
    Transforms.delete(this.context, { at: path });
  }

  render(): React.ReactNode {
    const timestamp = this.props.element.timestamp || osu.trans('beatmap_discussions.timestamp_display.general');
    return (
      <div className='beatmap-discussion beatmap-discussion--preview' {...this.props.attributes}>
        <div className='beatmap-discussion__discussion'>
          <div className='beatmap-discussion-post'>
            <div
              className='beatmap-discussion-post__content'
              style={{
                alignItems: 'flex-start',
              }}
            >
              <div
                style={{
                  alignItems: 'center',
                  display: 'flex',
                }}
              >
                <EditorBeatmapSelector {...this.props}/>
                <EditorIssueTypeSelector {...this.props}/>
                <div
                  contentEditable={false}
                  style={{
                    color: 'hsl(var(--base-hue), 10%, 60%)',
                    fontSize: '9px',
                    userSelect: 'none',
                    width: '45px',
                  }}
                >
                  {timestamp}
                </div>
                <div
                  contentEditable={false}
                  style={{
                    backgroundColor: '#21272a',
                    borderRadius: '5px',
                    display: 'flex',
                    height: '32px',
                    margin: '0 10px',
                    padding: '0',
                    userSelect: 'none',
                    width: '2px',
                  }}
                />
              </div>
              <div
                className='beatmap-discussion-post__message-container'
                style={{alignSelf: 'center'}}
              >
                <div className='beatmapset-discussion-message'>{this.props.children}</div>
              </div>
            </div>
          </div>
        </div>
        <button
          onClick={this.remove}
          style={{
            height: '32px',
            userSelect: 'none',
          }}
          contentEditable={false}
        >
          <i className='far fa-trash-alt' />
        </button>
      </div>
    );
  }
}
