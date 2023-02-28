// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapListItem from 'components/beatmap-list-item';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import BeatmapsetJson from 'interfaces/beatmapset-json';
import UserJson from 'interfaces/user-json';
import { deletedUser } from 'models/user';
import * as React from 'react';
import { blackoutToggle } from 'utils/blackout';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { nextVal } from 'utils/seq';

interface Props {
  beatmaps: BeatmapExtendedJson[];
  beatmapset: BeatmapsetJson;
  createLink: (beatmap: BeatmapExtendedJson) => string;
  currentBeatmap: BeatmapExtendedJson;
  getCount: (beatmap: BeatmapExtendedJson) => number | undefined;
  onSelectBeatmap: (beatmapId: number) => void;
  users: Partial<Record<number, UserJson>>;
}

interface State {
  showingSelector: boolean;
}

export default class BeatmapList extends React.PureComponent<Props, State> {
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
      <div className={classWithModifiers('beatmap-list', { selecting: this.state.showingSelector })}>
        <div className='beatmap-list__body'>
          <a
            className='beatmap-list__item beatmap-list__item--selected beatmap-list__item--large js-beatmap-list-selector'
            href={this.props.createLink(this.props.currentBeatmap)}
            onClick={this.toggleSelector}
          >
            <BeatmapListItem beatmap={this.props.currentBeatmap} mapper={null} modifiers='large' />
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

  private beatmapListItem = (beatmap: BeatmapExtendedJson) => {
    const count = this.props.getCount(beatmap);

    return (
      <div
        key={beatmap.id}
        className={classWithModifiers('beatmap-list__item', { current: beatmap.id === this.props.currentBeatmap.id })}
        data-id={beatmap.id}
        onClick={this.selectBeatmap}
      >
        <BeatmapListItem
          beatmap={beatmap}
          beatmapUrl={this.props.createLink(beatmap)}
          beatmapset={this.props.beatmapset}
          mapper={this.props.users[beatmap.user_id] ?? deletedUser}
          showNonGuestMapper={false}
        />
        {count != null &&
          <div className='beatmap-list__item-count'>
            {formatNumber(count)}
          </div>
        }
      </div>
    );
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
    blackoutToggle(this.state.showingSelector, 0.5);
  };

  private toggleSelector = (e: React.MouseEvent<HTMLElement>) => {
    if (e.button !== 0) return;
    e.preventDefault();

    this.setSelector(!this.state.showingSelector);
  };
}
