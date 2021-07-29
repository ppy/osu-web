// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetJson } from 'beatmapsets/beatmapset-json';
import BeatmapJson from 'interfaces/beatmap-json';
import GameMode from 'interfaces/game-mode';
import { route } from 'laroute';
import { computed } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { group as groupBeatmaps } from 'utils/beatmap-helper';

interface Props {
  beatmapset: BeatmapsetJson;
  onClose: () => void;
}

interface State {
  selectedBeatmapIds: Set<number>;
}

@observer
export default class LoveConfirmation extends React.PureComponent<Props, State> {
  constructor(props: Props) {
    super(props);

    this.state = {
      selectedBeatmapIds: new Set(this.props.beatmapset.beatmaps?.map((beatmap) => beatmap.id) ?? []),
    };
  }

  @computed
  private get beatmaps() {
    return this.props.beatmapset.beatmaps?.filter((beatmap) => beatmap.deleted_at === null) ?? [];
  }

  @computed
  private get groupedBeatmaps() {
    return groupBeatmaps(this.beatmaps);
  }

  render() {
    return (
      <div className='love-beatmap-modal'>
        <div className='love-beatmap-modal__row love-beatmap-modal__row--title'>
          {osu.trans('beatmaps.nominations.love_choose')}
        </div>

        <div className='love-beatmap-modal__row love-beatmap-modal__row--content u-fancy-scrollbar'>
          {[...this.groupedBeatmaps].map(([mode, beatmaps]) => this.renderDiffMode(mode, beatmaps))}
        </div>

        <div className='love-beatmap-modal__row love-beatmap-modal__row--footer'>
          <button
            className='btn-osu-big btn-osu-big--rounded-thin'
            disabled={this.state.selectedBeatmapIds.size === 0}
            onClick={this.handleSubmit}
            type='button'
          >
            {osu.trans('common.buttons.submit')}
          </button>

          <button
            className='btn-osu-big btn-osu-big--rounded-thin btn-osu-big--danger'
            onClick={this.props.onClose}
            type='button'
          >
            {osu.trans('common.buttons.close')}
          </button>
        </div>
      </div>
    );
  }

  private checkIsModeSelected = (mode: GameMode) => {
    const modeBeatmapIds = this.getModeBeatmapIds(mode);
    const isAllSelected = modeBeatmapIds.every((id) => this.state.selectedBeatmapIds.has(id));
    const isAllUnselected = modeBeatmapIds.every((id) => !this.state.selectedBeatmapIds.has(id));

    if (!isAllSelected && !isAllUnselected) {
      return 'indeterminate';
    }

    return isAllSelected;
  };

  private getModeBeatmapIds = (mode: GameMode) => this.groupedBeatmaps.get(mode)?.map((beatmap) => beatmap.id) ?? [];

  private handleCheckboxDifficulty = (e: React.ChangeEvent<HTMLInputElement>) => {
    const beatmapId = parseInt(e.target.value, 10);

    const newSelectedIds = new Set(this.state.selectedBeatmapIds);

    if (this.state.selectedBeatmapIds.has(beatmapId)) {
      newSelectedIds.delete(beatmapId);
    } else {
      newSelectedIds.add(beatmapId);
    }

    this.setState({ selectedBeatmapIds: newSelectedIds });
  };

  private handleCheckboxMode = (e: React.ChangeEvent<HTMLInputElement>) => {
    const mode = e.target.value as GameMode;
    const modeBeatmapIds = this.getModeBeatmapIds(mode);
    const newSelectedIds = new Set(this.state.selectedBeatmapIds);

    if (this.checkIsModeSelected(mode) === true) {
      modeBeatmapIds.forEach((id) => {
        newSelectedIds.delete(id);
      });
    } else {
      modeBeatmapIds.forEach((id) => {
        newSelectedIds.add(id);
      });
    }

    this.setState({ selectedBeatmapIds: newSelectedIds });
  };

  private handleSubmit = () => {
    if (!confirm(osu.trans('beatmaps.nominations.love_confirm'))) {
      return;
    }

    if (this.state.selectedBeatmapIds.size === 0) {
      return;
    }

    LoadingOverlay.show();

    const url = route('beatmapsets.love', { beatmapset: this.props.beatmapset.id });
    const params = {
      data: { beatmap_ids: [...this.state.selectedBeatmapIds] },
      method: 'PUT',
    };

    $.ajax(url, params).done((response) => {
      $.publish('beatmapsetDiscussions:update', { beatmapset: response });
      this.props.onClose();
    }).fail(osu.ajaxError)
      .always(LoadingOverlay.hide());
  };

  private renderDiffMode(mode: GameMode, beatmaps: BeatmapJson[]) {
    if (beatmaps.length === 0) {
      return null;
    }

    return (
      <div key={mode} className='love-beatmap-modal__diff-mode'>
        <div className='love-beatmap-modal__diff-mode-title'>
          <label className='osu-switch-v2'>
            <input
              checked={this.checkIsModeSelected(mode) !== false}
              className='osu-switch-v2__input'
              data-indeterminate={this.checkIsModeSelected(mode) === 'indeterminate'}
              onChange={this.handleCheckboxMode}
              type='checkbox'
              value={mode}
            />
            <span className='osu-switch-v2__content' />
            <div className='love-beatmap-modal__switch-text'>
              {osu.trans(`beatmaps.mode.${mode}`)}
            </div>
          </label>
        </div>
        <ul className='love-beatmap-modal__diff-list'>
          {beatmaps.map((beatmap) => (
            <li
              key={beatmap.id}
              className='love-beatmap-modal__diff-list-item'
            >
              <label className='osu-switch-v2'>
                <input
                  checked={this.state.selectedBeatmapIds.has(beatmap.id)}
                  className='osu-switch-v2__input'
                  onChange={this.handleCheckboxDifficulty}
                  type='checkbox'
                  value={beatmap.id}
                />
                <span className='osu-switch-v2__content' />
                <div className='love-beatmap-modal__switch-text'>
                  {beatmap.version}
                </div>
              </label>
            </li>
          ))}
        </ul>
      </div>
    );
  }
}
