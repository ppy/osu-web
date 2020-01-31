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
import { Path, Transforms } from 'slate';
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
  editMode?: boolean;
}

export default class EditorDiscussionComponent extends React.Component<Props> {
  static contextType = SlateContext;

  componentDidMount = () => {
    // reset timestamp to null on clone
    Transforms.setNodes(this.context, {timestamp: null}, {at: this.path()});
  }

  componentDidUpdate(prevProps: Readonly<Props>, prevState: Readonly<{}>, snapshot?: any): void {
    const path = this.path();

    if (this.props.element.beatmapId !== 'all') {
      const content = this.props.element.children[0].text;
      const TS_REGEX = /((\d{2,}):([0-5]\d)[:.](\d{3}))( \((?:\d[,|])*\d\))?/;
      const matches = content.match(TS_REGEX);
      let timestamp = osu.trans('beatmap_discussions.timestamp_display.general');

      if (matches !== null) {
        timestamp = matches[1];
      }

      Transforms.setNodes(this.context, {timestamp}, {at: path});
    } else {
      Transforms.setNodes(this.context, {timestamp: null}, {at: path});
    }
  }

  path = (): Path => ReactEditor.findPath(this.context, this.props.element);

  remove = () => {
    Transforms.delete(this.context, { at: this.path() });
    // if editmode, do callback to server to nuke?
  }

  render(): React.ReactNode {
    const bn = 'beatmap-discussion-review-post-embed-preview';
    const timestamp = this.props.element.timestamp || osu.trans('beatmap_discussions.timestamp_display.general');
    return (
      <div className='beatmap-discussion beatmap-discussion--preview' {...this.props.attributes}>
        <div className='beatmap-discussion__discussion'>
          <div className={bn}>
            <div
              className={`${bn}__content`}
            >
              <div
                className={`${bn}__selectors`}
                contentEditable={false} // workaround for slatejs 'Cannot resolve a Slate point from DOM point' nonsense
              >
                <EditorBeatmapSelector {...this.props}/>
                <EditorIssueTypeSelector {...this.props}/>
                <div
                  className={`${bn}__timestamp`}
                  contentEditable={false} // workaround for slatejs 'Cannot resolve a Slate point from DOM point' nonsense
                >
                  {timestamp}
                </div>
                <div
                  contentEditable={false} // workaround for slatejs 'Cannot resolve a Slate point from DOM point' nonsense
                  className={`${bn}__stripe`}
                />
              </div>
              <div
                className={`${bn}__message-container`}
              >
                <div className='beatmapset-discussion-message'>{this.props.children}</div>
              </div>
            </div>
          </div>
        </div>
        {this.props.editMode &&
          <button
            className={`${bn}__trashcan`}
            onClick={this.unlink}
            contentEditable={false}
          >
            <i className='fas fa-unlink' />
          </button>
        }
        <button
          className={`${bn}__trashcan`}
          onClick={this.remove}
          contentEditable={false}
        >
          <i className='far fa-trash-alt' />
        </button>
      </div>
    );
  }

  unlink = () => {
    Transforms.delete(this.context, { at: this.path() });
  }
}
