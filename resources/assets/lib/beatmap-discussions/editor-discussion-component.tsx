// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { Path, Transforms } from 'slate';
import { RenderElementProps } from 'slate-react';
import { ReactEditor } from 'slate-react';
import EditorBeatmapSelector from './editor-beatmap-selector';
import EditorIssueTypeSelector from './editor-issue-type-selector';
import { SlateContext } from './slate-context';

interface Props extends RenderElementProps {
  // attributes taken from RenderElementProps, but extended with contentEditable
  attributes: {
    contentEditable?: boolean;
    'data-slate-inline'?: true;
    'data-slate-node': 'element';
    'data-slate-void'?: true;
    dir?: 'rtl';
    ref: any;
  };
  beatmaps: Beatmap[];
  beatmapset: Beatmapset;
  currentBeatmap: Beatmap;
  currentDiscussions: BeatmapDiscussion[];
  discussionId?: number;
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
      let timestamp = null;

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

  readOnly = () => {
    return this.props.editMode && this.props.element.discussionId;
  }

  render(): React.ReactNode {
    const bn = 'beatmap-discussion-review-post-embed-preview';
    const timestamp = this.props.element.timestamp || osu.trans('beatmap_discussions.timestamp_display.general');
    const attribs = this.props.attributes;
    const extraClasses = [];

    if (this.readOnly()) {
      attribs.contentEditable = false;
      extraClasses.push('read-only');
    }

    return (
      <div className='beatmap-discussion beatmap-discussion--preview' {...attribs}>
        <div className='beatmap-discussion__discussion'>
          <div className={osu.classWithModifiers(bn, extraClasses)}>
            <div
              className={`${bn}__content`}
            >
              <div
                className={`${bn}__selectors`}
                contentEditable={false} // workaround for slatejs 'Cannot resolve a Slate point from DOM point' nonsense
              >
                <EditorBeatmapSelector {...this.props} disabled={this.readOnly()}/>
                <EditorIssueTypeSelector {...this.props} disabled={this.readOnly()}/>
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
              {this.props.editMode && !this.readOnly() &&
                <div
                  className={`${bn}__unsaved-indicator`}
                  contentEditable={false} // workaround for slatejs 'Cannot resolve a Slate point from DOM point' nonsense
                  title='unsaved'
                >
                  <i className='fas fa-pencil-alt'/>
                </div>
              }
            </div>
          </div>
        </div>
        {!this.props.editMode || !this.readOnly() &&
          <button
            className={`${bn}__trashcan`}
            onClick={this.remove}
            contentEditable={false}
            title='delete'
          >
            <i className='fas fa-trash-alt'/>
          </button>
        }
        {this.props.editMode && this.readOnly() &&
          <button
            className={`${bn}__trashcan`}
            onClick={this.remove}
            contentEditable={false}
            title='unlink'
          >
            <i className='fas fa-link' />
          </button>
        }
      </div>
    );
  }

  unlink = () => {
    Transforms.delete(this.context, { at: this.path() });
  }
}
