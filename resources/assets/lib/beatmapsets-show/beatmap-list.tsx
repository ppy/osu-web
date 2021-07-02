// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Blackout from 'blackout';
import BeatmapJsonExtended from 'interfaces/beatmap-json-extended';
import core from 'osu-core-singleton';
import * as React from 'react';
import { generate as generateHash } from 'utils/beatmapset-page-hash';
import { classWithModifiers } from 'utils/css';
import BeatmapListItem from './beatmap-list-item';

// TODO: temporary, only for this component for now
interface CurrentDiscussions {
  countsByBeatmap: {
    [key: number]: number;
  };
}

interface Props {
  beatmaps: BeatmapJsonExtended[];
  currentBeatmap: BeatmapJsonExtended;
  currentDiscussions?: CurrentDiscussions;
  type: 'show' | 'discussions';
}

interface State {
  showingSelector: boolean;
}

export default class BeatmapList extends React.PureComponent<Props, State> {
  constructor(props: Props) {
    super(props);

    this.state = {
      showingSelector: false,
    };
  }

  componentDidMount() {
    $(document).on('click.beatmapList', this.onDocumentClick);
    $(document).on('turbolinks:before-cache.beatmapList', this.hideSelector);
  }

  componentWillUnmount() {
    $(document).off('.beatmapList');
  }

  render() {
    const iconOnly = this.props.type === 'show' && core.windowSize.isDesktop;

    return (
      <div className={classWithModifiers('beatmap-list', { selecting: this.state.showingSelector })}>
        <div className='beatmap-list__body'>
          <a
            className={`${classWithModifiers('beatmap-list__item', {
              [this.props.type]: true,
              selected: true,
            })} js-beatmap-list-selector`}
            href={this.createHref(this.props.currentBeatmap)}
            onClick={this.toggleSelector}
          >
            <BeatmapListItem
              beatmap={this.props.currentBeatmap}
              iconOnly={iconOnly}
              large={this.props.type === 'discussions'}
              withButton='down'
            />
          </a>

          <div
            className={classWithModifiers('beatmap-list__selector', {
              'icon-only': iconOnly,
            })}
          >
            {this.props.beatmaps.map((beatmap) => this.renderListItem(beatmap))}
          </div>
        </div>
      </div>
    );
  }

  renderListItem(beatmap: BeatmapJsonExtended) {
    const count = beatmap.deleted_at !== null
      ? undefined
      : this.props.currentDiscussions?.countsByBeatmap?.[beatmap.id];

    return (
      <a
        key={beatmap.id}
        className={classWithModifiers('beatmap-list__item', {
          current: beatmap.id === this.props.currentBeatmap.id,
        })}
        data-id={beatmap.id}
        href={this.createHref(beatmap)}
        onClick={this.selectBeatmap}
      >
        <BeatmapListItem
          beatmap={beatmap}
          count={count}
          mode='version'
        />
      </a>
    );
  }

  private createHref = (beatmap: BeatmapJsonExtended) => {
    switch (this.props.type) {
      case 'show':
        return generateHash({ beatmap });
      case 'discussions':
        return BeatmapDiscussionHelper.url({ beatmap });
    }
  };

  private hideSelector = () => {
    if (this.state.showingSelector) {
      this.setSelector(false);
    }
  };

  private onDocumentClick = (e: JQuery.ClickEvent) => {
    if (e.button !== 0) {
      return;
    }

    if ($(e.target).closest('.js-beatmap-list-selector').length > 0) {
      return;
    }

    this.hideSelector();
  };

  private selectBeatmap = (e: React.MouseEvent<HTMLElement>) => {
    if (e.button !== 0) {
      return;
    }

    e.preventDefault();

    if (this.props.type === 'discussions') {
      $.publish('beatmapsetDiscussions:update', {
        beatmapId: parseInt(e.currentTarget.dataset.id ?? '', 10),
        mode: BeatmapDiscussionHelper.DEFAULT_MODE,
      });
    }
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
    if (e.button !== 0) {
      return;
    }

    e.preventDefault();
    this.setSelector(!this.state.showingSelector);
  };
}
