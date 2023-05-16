// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJson from 'interfaces/beatmap-json';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import GameMode from 'interfaces/game-mode';
import { route } from 'laroute';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { onError } from 'utils/ajax';
import { group as groupBeatmaps } from 'utils/beatmap-helper';
import { trans } from 'utils/lang';
import { hideLoadingOverlay, showImmediateLoadingOverlay } from 'utils/loading-overlay';

interface Props {
  beatmapset: BeatmapsetExtendedJson & Required<Pick<BeatmapsetExtendedJson, 'beatmaps'>>;
  onClose: () => void;
}

@observer
export default class LoveConfirmation extends React.Component<Props> {
  @observable private selectedBeatmapIds: Set<number>;
  @observable private xhr: JQuery.jqXHR<BeatmapsetWithDiscussionsJson> | null = null;

  @computed
  private get beatmaps() {
    return this.props.beatmapset.beatmaps.filter((beatmap) => beatmap.deleted_at == null);
  }

  @computed
  private get groupedBeatmaps() {
    return groupBeatmaps(this.beatmaps);
  }

  constructor(props: Props) {
    super(props);

    this.selectedBeatmapIds = new Set(this.beatmaps.map((beatmap) => beatmap.id));

    makeObservable(this);
  }

  componentWillUnmount() {
    this.xhr?.abort();
  }

  render() {
    return (
      <div className='love-beatmap-modal u-fancy-scrollbar'>
        <div className='love-beatmap-modal__row love-beatmap-modal__row--title'>
          {trans('beatmaps.nominations.love_choose')}
        </div>

        <div className='love-beatmap-modal__row love-beatmap-modal__row--content'>
          {[...this.groupedBeatmaps].map(([mode, beatmaps]) => this.renderDiffMode(mode, beatmaps))}
        </div>

        <div className='love-beatmap-modal__row love-beatmap-modal__row--footer'>
          <button
            className='btn-osu-big btn-osu-big--rounded-thin btn-osu-big--danger'
            onClick={this.props.onClose}
            type='button'
          >
            {trans('common.buttons.close')}
          </button>

          <button
            className='btn-osu-big btn-osu-big--rounded-thin'
            disabled={this.xhr != null || this.selectedBeatmapIds.size === 0}
            onClick={this.handleSubmit}
            type='button'
          >
            {trans('common.buttons.submit')}
          </button>
        </div>
      </div>
    );
  }

  private checkIsModeSelected = (mode: GameMode) => {
    const modeBeatmaps = this.groupedBeatmaps.get(mode) ?? [];
    const isAllSelected = modeBeatmaps.every((beatmap) => this.selectedBeatmapIds.has(beatmap.id));
    const isAllUnselected = modeBeatmaps.every((beatmap) => !this.selectedBeatmapIds.has(beatmap.id));

    if (!isAllSelected && !isAllUnselected) {
      return null;
    }

    return isAllSelected;
  };

  @action
  private handleCheckboxDifficulty = (e: React.ChangeEvent<HTMLInputElement>) => {
    const beatmapId = parseInt(e.target.value, 10);

    if (this.selectedBeatmapIds.has(beatmapId)) {
      this.selectedBeatmapIds.delete(beatmapId);
    } else {
      this.selectedBeatmapIds.add(beatmapId);
    }
  };

  private handleCheckboxMode = (e: React.ChangeEvent<HTMLInputElement>) => {
    const mode = e.target.value as GameMode;
    const modeBeatmaps = this.groupedBeatmaps.get(mode) ?? [];

    const op = this.checkIsModeSelected(mode) ? 'delete' : 'add';
    modeBeatmaps.forEach((beatmap) => this.selectedBeatmapIds[op](beatmap.id));
  };

  @action
  private handleSubmit = () => {
    if (this.xhr != null
      || this.selectedBeatmapIds.size === 0
      || !confirm(trans('beatmaps.nominations.love_confirm'))) {
      return;
    }

    showImmediateLoadingOverlay();

    const url = route('beatmapsets.love', { beatmapset: this.props.beatmapset.id });
    const params = {
      data: { beatmap_ids: [...this.selectedBeatmapIds] },
      method: 'PUT',
    };

    this.xhr = $.ajax(url, params);
    this.xhr.done((beatmapset) => {
      $.publish('beatmapsetDiscussions:update', { beatmapset });
      this.props.onClose();
    }).fail(onError)
      .always(action(() => {
        this.xhr = null;
        hideLoadingOverlay();
      }));
  };

  private renderDiffMode(mode: GameMode, beatmaps: BeatmapJson[]) {
    if (beatmaps.length === 0) {
      return null;
    }

    const isModeSelected = this.checkIsModeSelected(mode);

    return (
      <div key={mode} className='love-beatmap-modal__diff-mode'>
        <div className='love-beatmap-modal__diff-mode-title'>
          <label className='love-beatmap-modal__switch'>
            <div className='osu-switch-v2'>
              <input
                checked={isModeSelected !== false}
                className='osu-switch-v2__input'
                data-indeterminate={isModeSelected == null}
                onChange={this.handleCheckboxMode}
                type='checkbox'
                value={mode}
              />
              <span className='osu-switch-v2__content' />
            </div>
            <span className='love-beatmap-modal__diff-mode-title-label'>
              {trans(`beatmaps.mode.${mode}`)}
            </span>
          </label>
        </div>
        <ul className='love-beatmap-modal__diff-list'>
          {beatmaps.map((beatmap) => (
            <li
              key={beatmap.id}
              className='love-beatmap-modal__diff-list-item'
            >
              <label className='love-beatmap-modal__switch'>
                <div className='osu-switch-v2'>
                  <input
                    checked={this.selectedBeatmapIds.has(beatmap.id)}
                    className='osu-switch-v2__input'
                    onChange={this.handleCheckboxDifficulty}
                    type='checkbox'
                    value={beatmap.id}
                  />
                  <span className='osu-switch-v2__content' />
                </div>
                {beatmap.version}
              </label>
            </li>
          ))}
        </ul>
      </div>
    );
  }
}
