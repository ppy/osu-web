// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapReviewDiscussionType } from 'interfaces/beatmap-discussion-review';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import BeatmapsetJson from 'interfaces/beatmapset-json';
import * as _ from 'lodash';
import * as React from 'react';
import { Element as SlateElement, Path, Transforms } from 'slate';
import { RenderElementProps } from 'slate-react';
import { ReactEditor } from 'slate-react';
import { classWithModifiers } from 'utils/css';
import { linkHtml } from 'utils/url';
import { DraftsContext } from './drafts-context';
import EditorBeatmapSelector from './editor-beatmap-selector';
import EditorIssueTypeSelector from './editor-issue-type-selector';
import { SlateContext } from './slate-context';

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
  currentBeatmap: BeatmapExtendedJson;
  discussionId?: number;
  discussions: Partial<Record<number, BeatmapsetDiscussionJson>>;
  editMode?: boolean;
  readOnly?: boolean;
}

export default class EditorDiscussionComponent extends React.Component<Props> {
  static contextType = SlateContext;

  bn = 'beatmap-discussion-review-post-embed-preview';
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

    if (this.props.element.beatmapId) {
      const content = this.props.element.children[0].text as string;
      const matches = BeatmapDiscussionHelper.TIMESTAMP_REGEX.exec(content);
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
    if (qtip) {
      qtip.destroy();
      this.tooltipEl = undefined;
    }
  };

  // FIXME: element should be typed properly instead.
  discussionType = () => this.props.element.discussionType as BeatmapReviewDiscussionType;

  editable = () => !(this.props.editMode && this.props.element.discussionId);

  isRelevantDiscussion = (discussion?: BeatmapsetDiscussionJson): discussion is BeatmapsetDiscussionJson => (
    discussion != null && discussion.beatmap_id === this.selectedBeatmap()
  );

  nearbyDiscussions = () => {
    const timestamp = this.timestamp();
    if (timestamp == null) {
      return [];
    }

    if (!this.cache.nearbyDiscussions || this.cache.nearbyDiscussions.timestamp !== timestamp || (this.cache.nearbyDiscussions.beatmap_id !== this.selectedBeatmap())) {
      const relevantDiscussions = _.filter(this.props.discussions, this.isRelevantDiscussion);
      this.cache.nearbyDiscussions = {
        beatmap_id: this.selectedBeatmap(),
        discussions: BeatmapDiscussionHelper.nearbyDiscussions(relevantDiscussions, timestamp),
        timestamp,
      };
    }

    return this.cache.nearbyDiscussions?.discussions;
  };

  nearbyDraftEmbeds = (drafts: SlateElement[]) => {
    const timestamp = this.timestamp();
    if (timestamp == null || drafts.length === 0) {
      return;
    }

    return drafts.filter((embed) => {
      if (!embed.timestamp || embed.beatmapId !== this.props.element.beatmapId) {
        return false;
      }

      const ts = BeatmapDiscussionHelper.parseTimestamp(embed.timestamp as string);
      if (ts == null) {
        return false;
      }

      return Math.abs(ts - timestamp) <= 5000;
    });
  };

  nearbyIndicator = (drafts: SlateElement[]) => {
    if (this.timestamp() == null || this.discussionType() === 'praise') {
      return;
    }

    const nearbyDiscussions = this.editable() ? this.nearbyDiscussions() : [];
    const nearbyUnsaved = this.nearbyDraftEmbeds(drafts) || [];

    if (nearbyDiscussions.length > 0 || nearbyUnsaved.length > 1) {
      const timestamps =
        nearbyDiscussions.map((discussion) => {
          const timestamp = BeatmapDiscussionHelper.formatTimestamp(discussion.timestamp);
          if (timestamp == null) {
            return;
          }

          // don't linkify timestamps when in edit mode
          return this.props.editMode
            ? timestamp
            : linkHtml(BeatmapDiscussionHelper.url({ discussion }),
              timestamp,
              { classNames: ['js-beatmap-discussion--jump'] },
            );
        });

      if (nearbyUnsaved.length > 1) {
        timestamps.push(osu.trans('beatmap_discussions.nearby_posts.unsaved', { count: nearbyUnsaved.length - 1 }));
      }

      const timestampsString = osu.transArray(timestamps);

      const nearbyText = osu.trans('beatmap_discussions.nearby_posts.notice', {
        existing_timestamps: timestampsString,
        timestamp: this.props.element.timestamp,
      });

      return (
        <div
          className={`${this.bn}__indicator ${this.bn}__indicator--warning`}
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
  };

  path = (): Path => ReactEditor.findPath(this.context, this.props.element);

  render(): React.ReactNode {
    const canEdit = this.editable();
    const classMods = canEdit ? [] : ['read-only'];

    let timestamp = this.props.element.timestamp as string | undefined;
    let timestampTooltipType: string;
    if (this.props.element.beatmapId != null) {
      timestampTooltipType = 'diff';
    } else {
      timestampTooltipType = 'all-diff';
      timestamp = undefined;
    }

    const timestampTooltip = osu.trans(`beatmaps.discussions.review.embed.timestamp.${timestampTooltipType}`, {
      type: osu.trans(`beatmaps.discussions.message_type.${this.discussionType()}`),
    });

    const deleteButton =
      (
        <button
          className={`${this.bn}__delete`}
          contentEditable={false}
          disabled={this.props.readOnly}
          onClick={this.delete}
          title={osu.trans(`beatmaps.discussions.review.embed.${canEdit ? 'delete' : 'unlink'}`)}
        >
          <i className={`fas fa-${canEdit ? 'trash-alt' : 'link'}`} />
        </button>
      );

    const nearbyIndicator =
      <DraftsContext.Consumer>{this.nearbyIndicator}</DraftsContext.Consumer>;

    const unsavedIndicator =
      this.props.editMode && canEdit ?
        (
          <div
            className={`${this.bn}__indicator`}
            contentEditable={false} // workaround for slatejs 'Cannot resolve a Slate point from DOM point' nonsense
            title={osu.trans('beatmaps.discussions.review.embed.unsaved')}
          >
            <i className='fas fa-pencil-alt' />
          </div>
        )
        : null;

    return (
      <div
        className='beatmap-discussion beatmap-discussion--preview'
        contentEditable={canEdit}
        suppressContentEditableWarning
        {...this.props.attributes}
      >
        <div className={classWithModifiers(this.bn, classMods)}>
          <div className={`${this.bn}__content`}>
            <div
              className={`${this.bn}__selectors`}
              contentEditable={false} // workaround for slatejs 'Cannot resolve a Slate point from DOM point' nonsense
            >
              <EditorBeatmapSelector {...this.props} disabled={this.props.readOnly || !canEdit} />
              <EditorIssueTypeSelector {...this.props} disabled={this.props.readOnly || !canEdit} />
              <div
                className={`${this.bn}__timestamp`}
                contentEditable={false} // workaround for slatejs 'Cannot resolve a Slate point from DOM point' nonsense
              >
                <span title={canEdit ? timestampTooltip : ''}>
                  {timestamp ?? osu.trans('beatmap_discussions.timestamp_display.general')}
                </span>
              </div>
              {unsavedIndicator}
              {nearbyIndicator}
            </div>
            <div
              className={`${this.bn}__stripe`} // workaround for slatejs 'Cannot resolve a Slate point from DOM point' nonsense
              contentEditable={false}
            />
            <div className={`${this.bn}__message-container`}>
              <div className='beatmapset-discussion-message'>{this.props.children}</div>
            </div>
            {unsavedIndicator}
            {nearbyIndicator}
          </div>
        </div>
        {deleteButton}
      </div>
    );
  }

  selectedBeatmap = () => this.props.element.beatmapId as number;

  timestamp = () => BeatmapDiscussionHelper.parseTimestamp(this.props.element.timestamp as string | undefined);
}
