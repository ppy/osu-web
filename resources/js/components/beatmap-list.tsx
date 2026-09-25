// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapListItem from 'components/beatmap-list-item';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import { action, autorun, makeObservable, observable } from 'mobx';
import { disposeOnUnmount, observer } from 'mobx-react';
import * as React from 'react';
import { blackoutToggle } from 'utils/blackout';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { nextVal } from 'utils/seq';

interface Props {
  beatmaps: BeatmapExtendedJson[];
  beatmapset: BeatmapsetExtendedJson;
  currentBeatmap: BeatmapExtendedJson;
  getCount?: (beatmap: BeatmapExtendedJson) => number | undefined;
  makeBeatmapUrl: (beatmap: BeatmapExtendedJson) => string;
  onSelectBeatmap: (beatmapId: number) => void;
}

@observer
export default class BeatmapList extends React.Component<Props> {
  private readonly eventId = `beatmap-list-${nextVal()}`;
  @observable private showingSelector = false;

  constructor(props: Props) {
    super(props);

    makeObservable(this);
    disposeOnUnmount(this, autorun(() => {
      blackoutToggle(this, this.showingSelector);
    }));
  }

  componentDidMount() {
    $(document).on(`click.${this.eventId}`, this.onDocumentClick);
    $(document).on(`turbo:before-cache.${this.eventId}`, this.handleBeforeCache);
  }

  componentWillUnmount() {
    $(document).off(`.${this.eventId}`);
    blackoutToggle(this, false);
  }

  render() {
    return (
      <div className={classWithModifiers('beatmap-list', { selecting: this.showingSelector })}>
        <div className='beatmap-list__body'>
          <a
            className='beatmap-list__item beatmap-list__item--selected beatmap-list__item--large js-beatmap-list-selector'
            href={this.props.makeBeatmapUrl(this.props.currentBeatmap)}
            onClick={this.toggleSelector}
          >
            <BeatmapListItem beatmap={this.props.currentBeatmap} modifiers='large' showOwners={false} />
            <div className='beatmap-list__item-selector-button'>
              <span className='fas fa-chevron-down' />
            </div>
          </a>

          <div className='beatmap-list__selector-container'>
            <div className='beatmap-list__selector'>
              {this.props.beatmaps.map(this.beatmapListItem)}
            </div>
          </div>
        </div>
      </div>
    );
  }

  private readonly beatmapListItem = (beatmap: BeatmapExtendedJson) => {
    const count = this.props.getCount?.(beatmap);

    return (
      <div
        key={beatmap.id}
        className={classWithModifiers('beatmap-list__item', { current: beatmap.id === this.props.currentBeatmap.id })}
        data-id={beatmap.id}
        onClick={this.selectBeatmap}
      >
        <BeatmapListItem
          beatmap={beatmap}
          beatmapUrl={this.props.makeBeatmapUrl(beatmap)}
          beatmapset={this.props.beatmapset}
          showNonGuestOwner={false}
          showOwners
        />
        {count != null &&
          <div className='beatmap-list__item-count'>
            {formatNumber(count)}
          </div>
        }
      </div>
    );
  };

  @action
  private readonly handleBeforeCache = () => {
    this.setShowingSelector(false);
  };

  @action
  private readonly onDocumentClick = (e: JQuery.ClickEvent) => {
    if (e.button !== 0) return;

    if ($(e.target).closest('.js-beatmap-list-selector').length) {
      return;
    }

    this.setShowingSelector(false);
  };

  @action
  private readonly selectBeatmap = (e: React.MouseEvent<HTMLElement>) => {
    if (e.button !== 0) return;
    e.preventDefault();

    const beatmapId = parseInt(e.currentTarget.dataset.id ?? '', 10);
    this.props.onSelectBeatmap(beatmapId);
  };

  @action
  private setShowingSelector(state: boolean) {
    this.showingSelector = state;
  }

  @action
  private readonly toggleSelector = (e: React.MouseEvent<HTMLElement>) => {
    if (e.button !== 0) return;
    e.preventDefault();

    this.setShowingSelector(!this.showingSelector);
  };
}
