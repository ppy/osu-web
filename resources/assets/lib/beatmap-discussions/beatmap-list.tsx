// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Blackout from 'blackout';
import BeatmapJsonExtended from 'interfaces/beatmap-json-extended';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import * as React from 'react';
import { getBeatmapMapper } from 'utils/beatmap-helper';
import { classWithModifiers } from 'utils/css';
import { nextVal } from 'utils/seq';
import BeatmapListItem from './beatmap-list-item';

interface Props {
  beatmaps: BeatmapJsonExtended[];
  beatmapset: BeatmapsetExtendedJson;
  createLink: (beatmap: BeatmapJsonExtended) => string;
  currentBeatmap: BeatmapJsonExtended;
  getCount?: (beatmap: BeatmapJsonExtended) => number | undefined;
  large: boolean;
  modifiers?: string[];
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
    const classModifiers = { selecting: this.state.showingSelector, ...this.getModifiers() };

    return (
      <div className={classWithModifiers('beatmap-list', classModifiers)}>
        <div className='beatmap-list__body'>
          <a
            className='beatmap-list__item beatmap-list__item--selected beatmap-list__item--large js-beatmap-list-selector'
            href={this.props.createLink(this.props.currentBeatmap)}
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
                mapper={getBeatmapMapper(this.props.beatmapset, this.props.currentBeatmap)}
                withButton='fas fa-chevron-down'
              />
            </div>
          </a>

          <div className='beatmap-list__selector u-fancy-scrollbar'>
            {this.props.beatmaps.map(this.beatmapListItem)}
          </div>
        </div>
      </div>
    );
  }

  private beatmapListItem = (beatmap: BeatmapJsonExtended) => (
    <a
      key={beatmap.id}
      className={classWithModifiers('beatmap-list__item', { current: beatmap.id === this.props.currentBeatmap.id })}
      data-id={beatmap.id}
      href={this.props.createLink(beatmap)}
      onClick={this.selectBeatmap}
    >
      <BeatmapListItem
        beatmap={beatmap}
        count={this.props.getCount?.(beatmap)}
        mapper={getBeatmapMapper(this.props.beatmapset, beatmap)}
      />
    </a>
  );

  private getModifiers = () => {
    if (this.props.modifiers === undefined) {
      return {};
    }

    return Object.fromEntries(this.props.modifiers.map((modifier) => ([modifier, true])));
  };

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
    e.preventDefault();

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
    e.preventDefault();

    this.setSelector(!this.state.showingSelector);
  };
}
