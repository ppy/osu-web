// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { EmbedElement } from 'editor';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import BeatmapsetDiscussionJson from 'interfaces/beatmapset-discussion-json';
import BeatmapsetJson from 'interfaces/beatmapset-json';
import { filter } from 'lodash';
import { Observer } from 'mobx-react';
import * as React from 'react';
import { Transforms } from 'slate';
import { RenderElementProps } from 'slate-react';
import { ReactEditor } from 'slate-react';
import { formatTimestamp, makeUrl, nearbyDiscussions, parseTimestamp, timestampRegex } from 'utils/beatmapset-discussion-helper';
import { classWithModifiers } from 'utils/css';
import { trans, transArray } from 'utils/lang';
import { linkHtml } from 'utils/url';
import { DraftsContext } from './drafts-context';
import EditorBeatmapSelector from './editor-beatmap-selector';
import EditorIssueTypeSelector from './editor-issue-type-selector';
import { postEmbedModifiers } from './review-post-embed';
import { SlateContext } from './slate-context';

const bn = 'beatmap-discussion-review-post-embed-preview';

interface Cache {
  nearbyDiscussions?: {
    beatmap_id: number;
    discussions: BeatmapsetDiscussionJson[];
    timestamp: number;
  };
}

interface Props extends RenderElementProps {
  beatmaps: BeatmapExtendedJson[];
  beatmapset: BeatmapsetJson;
  discussions: Partial<Record<number, BeatmapsetDiscussionJson>>;
  editMode?: boolean;
  element: EmbedElement;
  readOnly?: boolean;
}

export default class EditorDiscussionComponent extends React.Component<Props> {
  static contextType = SlateContext;

  cache: Cache = {};
  declare context: React.ContextType<typeof SlateContext>;
  tooltipContent = React.createRef<HTMLScriptElement>();
  tooltipEl?: HTMLElement;

  componentDidMount = () => {
    // reset timestamp to null on clone
    if (this.editable()) {
      Transforms.setNodes(this.context, { timestamp: undefined }, { at: this.path() });
    }
  };

  componentDidUpdate = () => {
    if (!this.editable()) {
      return;
    }

    const path = this.path();
    let purgeCache = false;

    if (this.props.element.type === 'embed' && this.props.element.beatmapId != null) {
      const content = this.props.element.children[0].text;
      const matches = timestampRegex.exec(content);
      let timestamp: string | undefined;

      // only extract timestamp if it occurs at the start of the issue
      if (matches !== null && matches.index === 0) {
        timestamp = matches[2];
      }

      if (timestamp !== this.props.element.timestamp) {
        purgeCache = true;
      }

      Transforms.setNodes(this.context, { timestamp }, { at: path });
    } else {
      Transforms.setNodes(this.context, { timestamp: undefined }, { at: path });
      purgeCache = true;
    }

    if (purgeCache) {
      this.cache = {};
      this.destroyTooltip();
    }
  };

  componentWillUnmount() {
    this.destroyTooltip();
  }

  createTooltip = (event: (React.MouseEvent<HTMLElement> | React.TouchEvent<HTMLElement>)) => {
    const timestamp = this.timestamp();
    if (timestamp == null) return;

    const target = event.currentTarget;
    const tooltipId = `${this.selectedBeatmap()}-${timestamp}`;

    // if the tooltipId hasn't changed, we don't need to re-render the tooltip
    if (this.tooltipEl && this.tooltipEl._tooltip === tooltipId) {
      return;
    }

    this.tooltipEl = target;
    target._tooltip = tooltipId;

    $(target).qtip({
      content: {
        text: () => this.tooltipContent.current?.innerHTML,
      },
      hide: {
        delay: 200,
        fixed: true,
      },
      position: {
        at: 'top center',
        my: 'bottom center',
        viewport: $(window),
      },
      show: {
        delay: 200,
        ready: true,
      },
      style: {
        classes: 'tooltip-default tooltip-default--interactable',
      },
    });

    this.tooltipEl = target;
  };

  delete = () => {
    // Timeout is used to let Slate handle the click event before the node is removed - otherwise a "Cannot find a descendant at path" error gets thrown.
    window.setTimeout(() => Transforms.delete(this.context, { at: this.path() }), 0);
  };

  destroyTooltip = () => {
    if (!this.tooltipEl) {
      return;
    }

    const qtip = $(this.tooltipEl).qtip('api');
    if (qtip != null) {
      qtip.destroy();
      this.tooltipEl = undefined;
    }
  };

  // FIXME: element should be typed properly instead.
  discussionType = () => this.props.element.discussionType;

  editable = () => !(this.props.editMode && this.props.element.discussionId);

  isRelevantDiscussion = (discussion?: BeatmapsetDiscussionJson): discussion is BeatmapsetDiscussionJson => (
    discussion != null && discussion.beatmap_id === this.selectedBeatmap()
  );

  nearbyDiscussions = () => {
    const timestamp = this.timestamp();
    const beatmapId = this.selectedBeatmap();
    if (timestamp == null || beatmapId == null) {
      return [];
    }

    if (this.cache.nearbyDiscussions == null
      || this.cache.nearbyDiscussions.timestamp !== timestamp
      || this.cache.nearbyDiscussions.beatmap_id !== beatmapId) {
      const relevantDiscussions = filter(this.props.discussions, this.isRelevantDiscussion);
      this.cache.nearbyDiscussions = {
        beatmap_id: beatmapId,
        discussions: nearbyDiscussions(relevantDiscussions, timestamp),
        timestamp,
      };
    }

    return this.cache.nearbyDiscussions.discussions;
  };

  nearbyDraftEmbeds = (drafts: EmbedElement[]) => {
    const timestamp = this.timestamp();
    if (timestamp == null || drafts.length === 0) {
      return;
    }

    return drafts.filter((embed) => {
      if (!embed.timestamp || embed.beatmapId !== this.props.element.beatmapId) {
        return false;
      }

      const ts = parseTimestamp(embed.timestamp);
      if (ts == null) {
        return false;
      }

      return Math.abs(ts - timestamp) <= 5000;
    });
  };

  nearbyIndicator = (drafts: EmbedElement[]) => {
    if (!this.editable() || this.timestamp() == null || this.discussionType() === 'praise') {
      return null;
    }

    const discussions = this.nearbyDiscussions();
    const nearbyUnsaved = this.nearbyDraftEmbeds(drafts) ?? [];

    if (discussions.length > 0 || nearbyUnsaved.length > 1) {
      const timestamps: string[] = [];
      discussions.forEach((discussion) => {
        if (discussion.timestamp == null) return;
        const timestamp = formatTimestamp(discussion.timestamp);

        // don't linkify timestamps when in edit mode
        timestamps.push(this.props.editMode
          ? timestamp
          : linkHtml(makeUrl({ discussion }),
            timestamp,
            { classNames: ['js-beatmap-discussion--jump'] },
          ),
        );
      });

      if (nearbyUnsaved.length > 1) {
        timestamps.push(trans('beatmap_discussions.nearby_posts.unsaved', { count: nearbyUnsaved.length - 1 }));
      }

      const timestampsString = transArray(timestamps);

      const nearbyText = trans('beatmap_discussions.nearby_posts.notice', {
        existing_timestamps: timestampsString,
        timestamp: this.props.element.timestamp,
      });

      return (
        <div
          className={`${bn}__indicator ${bn}__indicator--warning`}
          contentEditable={false} // workaround for slatejs 'Cannot resolve a Slate point from DOM point' nonsense
          onMouseOver={this.createTooltip}
          onTouchStart={this.createTooltip}
        >
          <script
            dangerouslySetInnerHTML={{
              __html: nearbyText,
            }}
            ref={this.tooltipContent}
            type='text/html'
          />
          <i className='fas fa-exclamation-triangle' />
        </div>
      );
    }

    return null;
  };

  path = () => ReactEditor.findPath(this.context, this.props.element);

  render() {
    const canEdit = this.editable();
    const classMods = canEdit ? [] : ['read-only'];

    const timestampTooltipType = this.props.element.beatmapId != null ? 'diff' : 'all-diff';
    const timestampTooltip = trans(`beatmaps.discussions.review.embed.timestamp.${timestampTooltipType}`, {
      // TODO: remove after translations are updated without the key
      type: trans(`beatmaps.discussions.message_type.${this.discussionType()}`),
    });

    const deleteButton =
      (
        <button
          className={`${bn}__delete`}
          contentEditable={false}
          disabled={this.props.readOnly}
          onClick={this.delete}
          title={trans(`beatmaps.discussions.review.embed.${canEdit ? 'delete' : 'unlink'}`)}
        >
          <i className={`fas fa-${canEdit ? 'trash-alt' : 'link'}`} />
        </button>
      );

    const nearbyIndicator = (
      <DraftsContext.Consumer>
        {(drafts) => <Observer>{() => this.nearbyIndicator(drafts)}</Observer>}
      </DraftsContext.Consumer>
    );

    const unsavedIndicator =
      this.props.editMode && canEdit ?
        (
          <div
            className={`${bn}__indicator`}
            contentEditable={false} // workaround for slatejs 'Cannot resolve a Slate point from DOM point' nonsense
            title={trans('beatmaps.discussions.review.embed.unsaved')}
          >
            <i className='fas fa-pencil-alt' />
          </div>
        )
        : null;

    const disabled = this.props.readOnly || !canEdit;

    const discussion = this.props.element.discussionId != null ? this.props.discussions[this.props.element.discussionId] : null;
    const embedMofidiers = discussion != null
      ? postEmbedModifiers(discussion)
      : this.discussionType() === 'praise' ? 'praise' : null;

    return (
      <div
        className='beatmap-discussion beatmap-discussion--preview'
        contentEditable={canEdit}
        suppressContentEditableWarning
        {...this.props.attributes}
      >
        <div className={classWithModifiers(bn, classMods, embedMofidiers)}>
          <div className={`${bn}__content`}>
            <div
              className={`${bn}__selectors`}
              contentEditable={false} // workaround for slatejs 'Cannot resolve a Slate point from DOM point' nonsense
            >
              <EditorBeatmapSelector {...this.props} disabled={disabled} element={this.props.element} />
              <EditorIssueTypeSelector {...this.props} disabled={disabled} element={this.props.element} />
              <div
                className={`${bn}__timestamp`}
                contentEditable={false} // workaround for slatejs 'Cannot resolve a Slate point from DOM point' nonsense
              >
                <span title={canEdit ? timestampTooltip : ''}>
                  {this.props.element.timestamp ?? trans('beatmap_discussions.timestamp_display.general')}
                </span>
              </div>
              {unsavedIndicator}
              {nearbyIndicator}
            </div>
            <div
              className={`${bn}__stripe`} // workaround for slatejs 'Cannot resolve a Slate point from DOM point' nonsense
              contentEditable={false}
            />
            <div className={`${bn}__message-container`}>
              {this.props.children}
            </div>
            {unsavedIndicator}
            {nearbyIndicator}
          </div>
        </div>
        {deleteButton}
      </div>
    );
  }

  selectedBeatmap = () => this.props.element.beatmapId;

  timestamp = () => parseTimestamp(this.props.element.timestamp);
}
