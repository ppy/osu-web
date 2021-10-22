// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Blackout from 'blackout';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import { deletedUser } from 'models/user';
import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';
import { nextVal } from 'utils/seq';
import BeatmapListItem from './beatmap-list-item';

interface Props {
  beatmaps: BeatmapExtendedJson[];
  beatmapset: BeatmapsetExtendedJson;
  currentBeatmap: BeatmapExtendedJson;
  getCount?: (beatmap: BeatmapExtendedJson) => number | undefined;
  large: boolean;
  modifiers?: Modifiers;
  onSelectBeatmap: (beatmapId: number) => void;
}

interface State {
  showingSelector: boolean;
}

export default class BeatmapList extends React.PureComponent<Props, State> {
  static defaultProps = {
    large: true,
  };

  private readonly eventId = `beatmapset-discussions-show-beatmap-list-${nextVal()}`;

  constructor(props: Props) {
    super(props);

    this.state = {
      showingSelector: false,
    };
  }

  componentDidMount() {
    $(document).on(`click.${this.eventId}`, this.onDocumentClick);
    $(document).on(`turbolinks:before-cache.${this.eventId}`, this.hideSelector);
    this.syncBlackout();
  }

  componentWillUnmount() {
    $(document).off(`.${this.eventId}`);
  }

  render() {
    return (
      <div className={classWithModifiers('beatmap-list', this.props.modifiers, { selecting: this.state.showingSelector })}>
        <div className='beatmap-list__body'>
          <div
            className='beatmap-list__item beatmap-list__item--selected beatmap-list__item--large js-beatmap-list-selector'
            onClick={this.toggleSelector}
          >
            <div className='beatmap-list__selected beatmap-list__selected--icons'>
              {Array.from({ length: 4 }).map((_, idx) => (
                <i key={idx} className={`fal fa-extra-mode-${this.props.currentBeatmap.mode}`} />
              ))}
            </div>
            <div className='beatmap-list__selected beatmap-list__selected--list u-ellipsis-overflow'>
              <BeatmapListItem
                beatmap={this.props.currentBeatmap}
                large={this.props.large}
                mapper={this.props.currentBeatmap.user ?? deletedUser.toJson()}
                withButton='fas fa-chevron-down'
              />
            </div>
          </div>

          <div className='beatmap-list__selector u-fancy-scrollbar'>
            {this.props.beatmaps.map(this.beatmapListItem)}
          </div>
        </div>
      </div>
    );
  }

  private beatmapListItem = (beatmap: BeatmapExtendedJson) => (
    <div
      key={beatmap.id}
      className={classWithModifiers('beatmap-list__item', { current: beatmap.id === this.props.currentBeatmap.id })}
      data-id={beatmap.id}
      onClick={this.selectBeatmap}
    >
      <BeatmapListItem
        beatmap={beatmap}
        count={this.props.getCount?.(beatmap)}
        mapper={beatmap.user ?? deletedUser.toJson()}
      />
    </div>
  );

  private hideSelector = () => {
    if (this.state.showingSelector) {
      this.setSelector(false);
    }
  };

  private onDocumentClick = (e: JQuery.ClickEvent) => {
    if (e.button !== 0) return;

    if ($(e.target).closest('.js-beatmap-list-selector').length) {
      return;
    }

    this.hideSelector();
  };

  private selectBeatmap = (e: React.MouseEvent<HTMLElement>) => {
    if (e.button !== 0) return;
    if ($(e.target).is('a')) return;

    const beatmapId = parseInt(e.currentTarget.dataset.id ?? '', 10);
    this.props.onSelectBeatmap(beatmapId);
  };

  private setSelector = (state: boolean) => {
    if (this.state.showingSelector !== state) {
      this.setState({ showingSelector: state }, this.syncBlackout);
    }
  };

  private syncBlackout = () => {
    Blackout.toggle(this.state.showingSelector, 0.5);
  };

  private toggleSelector = (e: React.MouseEvent<HTMLElement>) => {
    if (e.button !== 0) return;
    if ($(e.target).is('a')) return;

    this.setSelector(!this.state.showingSelector);
  };
}
