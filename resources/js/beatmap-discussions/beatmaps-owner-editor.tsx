// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import UserJson from 'interfaces/user-json';
import { action, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { group as groupBeatmaps } from 'utils/beatmap-helper';
import { trans } from 'utils/lang';
import BeatmapOwnerEditor from './beatmap-owner-editor';
import DiscussionsState from './discussions-state';

interface Props {
  beatmapset: BeatmapsetWithDiscussionsJson;
  discussionsState: DiscussionsState;
  onClose: () => void;
  users: Map<number | null | undefined, UserJson>;
}

@observer
export default class BeatmapsOwnerEditor extends React.Component<Props> {
  private readonly editorRefs: Partial<Record<number, React.RefObject<BeatmapOwnerEditor>>> = {};

  constructor(props: Props) {
    super(props);

    for (const beatmap of this.props.beatmapset.beatmaps) {
      if (beatmap.deleted_at == null) {
        this.editorRefs[beatmap.id] = React.createRef<BeatmapOwnerEditor>();
      }
    }

    makeObservable(this);
  }

  componentDidMount() {
    document.addEventListener('turbo:before-visit', this.handleBeforeVisit);
  }

  componentWillUnmount() {
    document.removeEventListener('turbo:before-visit', this.handleBeforeVisit);
  }

  render() {
    const groupedBeatmaps = [...groupBeatmaps((this.props.beatmapset.beatmaps ?? []).filter(
      (beatmap) => beatmap.deleted_at == null,
    ))];

    return (
      <div className='beatmaps-owner-editor u-fancy-scrollbar'>
        <div className='beatmaps-owner-editor__row beatmaps-owner-editor__row--content'>
          {/* header and its grid placeholder */}
          <div />
          <strong>
            {trans('beatmap_discussions.owner_editor.version')}
          </strong>
          <strong>
            {trans('beatmap_discussions.owner_editor.user')}
          </strong>
          <div />

          {groupedBeatmaps.map(([, beatmaps]) => (
            beatmaps.map((beatmap) => (
              <BeatmapOwnerEditor
                key={beatmap.id}
                ref={this.editorRefs[beatmap.id]}
                beatmap={beatmap}
                beatmapset={this.props.beatmapset}
                discussionsState={this.props.discussionsState}
              />
            ))
          ))}
        </div>

        <div className='beatmaps-owner-editor__row beatmaps-owner-editor__row--footer'>
          <button
            className='btn-osu-big btn-osu-big--rounded-thin'
            onClick={this.handleCloseClick}
            type='button'
          >
            {trans('common.buttons.close')}
          </button>
        </div>
      </div>
    );
  }

  @action
  private readonly handleBeforeVisit = (event: Event) => {
    if (this.shouldCancelNavigation()) {
      event.preventDefault();
    }
  };

  private readonly handleCloseClick = () => {
    if (this.shouldCancelNavigation()) return;
    this.props.onClose();
  };

  private shouldCancelNavigation() {
    return Object.values(this.editorRefs).some((ref) => ref?.current?.editing)
      && !confirm(trans('common.confirmation_unsaved'));
  }
}
