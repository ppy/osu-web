// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetJson } from 'beatmapsets/beatmapset-json';
import BeatmapJsonExtended from 'interfaces/beatmap-json-extended';
import * as React from 'react';
import { Path, Transforms } from 'slate';
import { RenderElementProps } from 'slate-react';
import { ReactEditor } from 'slate-react';
import EditorBeatmapSelector from './editor-beatmap-selector';
import EditorIssueTypeSelector from './editor-issue-type-selector';
import { SlateContext } from './slate-context';

interface Props extends RenderElementProps {
  beatmaps: BeatmapJsonExtended[];
  beatmapset: BeatmapsetJson;
  currentBeatmap: BeatmapJsonExtended;
  currentDiscussions: BeatmapDiscussion[];
  discussionId?: number;
  editMode?: boolean;
  readOnly?: boolean;
}

export default class EditorDiscussionComponent extends React.Component<Props> {
  static contextType = SlateContext;

  componentDidMount = () => {
    // reset timestamp to null on clone
    Transforms.setNodes(this.context, {timestamp: null}, {at: this.path()});
  }

  componentDidUpdate = () => {
    const path = this.path();

    if (this.props.element.beatmapId) {
      const content = this.props.element.children[0].text;
      const matches = content.match(BeatmapDiscussionHelper.TIMESTAMP_REGEX);
      let timestamp = null;

      // only extract timestamp if it occurs at the start of the issue
      if (matches !== null && matches.index === 0) {
        timestamp = matches[2];
      }

      Transforms.setNodes(this.context, {timestamp}, {at: path});
    } else {
      Transforms.setNodes(this.context, {timestamp: null}, {at: path});
    }
  }

  delete = () => {
    Transforms.delete(this.context, { at: this.path() });
  }

  editable = () => {
    return !(this.props.editMode && this.props.element.discussionId);
  }

  path = (): Path => ReactEditor.findPath(this.context, this.props.element);

  render(): React.ReactNode {
    const bn = 'beatmap-discussion-review-post-embed-preview';
    const canEdit = this.editable();
    const classMods = canEdit ? [] : ['read-only'];
    const timestampTooltipType = this.props.element.beatmapId ? 'diff' : 'all-diff';
    const timestampTooltip = osu.trans(`beatmaps.discussions.review.embed.timestamp.${timestampTooltipType}`, {
        type: osu.trans(`beatmaps.discussions.message_type.${this.props.element.discussionType}`),
      });

    const deleteButton =
      (
        <button
          className={`${bn}__delete`}
          disabled={this.props.readOnly}
          onClick={this.delete}
          contentEditable={false}
          title={osu.trans(`beatmaps.discussions.review.embed.${canEdit ? 'delete' : 'unlink'}`)}
        >
          <i className={`fas fa-${canEdit ? 'trash-alt' : 'link'}`} />
        </button>
      );

    return (
      <div
        className='beatmap-discussion beatmap-discussion--preview'
        contentEditable={canEdit}
        suppressContentEditableWarning={true}
        {...this.props.attributes}
      >
        <div className='beatmap-discussion__discussion'>
          <div className={osu.classWithModifiers(bn, classMods)}>
            <div className={`${bn}__content`}>
              <div
                className={`${bn}__selectors`}
                contentEditable={false} // workaround for slatejs 'Cannot resolve a Slate point from DOM point' nonsense
              >
                <EditorBeatmapSelector {...this.props} disabled={this.props.readOnly || !canEdit}/>
                <EditorIssueTypeSelector {...this.props} disabled={this.props.readOnly || !canEdit}/>
                <div
                  className={`${bn}__timestamp`}
                  contentEditable={false} // workaround for slatejs 'Cannot resolve a Slate point from DOM point' nonsense
                  title={canEdit ? timestampTooltip : ''}
                >
                  {this.props.element.timestamp || osu.trans('beatmap_discussions.timestamp_display.general')}
                </div>
                <div
                  contentEditable={false} // workaround for slatejs 'Cannot resolve a Slate point from DOM point' nonsense
                  className={`${bn}__stripe`}
                />
              </div>
              <div className={`${bn}__message-container`}>
                <div className='beatmapset-discussion-message'>{this.props.children}</div>
              </div>
              {this.props.editMode && canEdit &&
                <div
                  className={`${bn}__unsaved-indicator`}
                  contentEditable={false} // workaround for slatejs 'Cannot resolve a Slate point from DOM point' nonsense
                  title={osu.trans('beatmaps.discussions.review.embed.unsaved')}
                >
                  <i className='fas fa-pencil-alt'/>
                </div>
              }
            </div>
          </div>
        </div>
        {deleteButton}
      </div>
    );
  }
}
