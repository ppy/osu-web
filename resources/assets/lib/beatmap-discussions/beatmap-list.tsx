// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapListItem from 'components/beatmap-list-item';
import StringWithComponent from 'components/string-with-component';
import { UserLink } from 'components/user-link';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import UserJson from 'interfaces/user-json';
import { deletedUser } from 'models/user';
import * as React from 'react';
import { blackoutToggle } from 'utils/blackout';
import { classWithModifiers, Modifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { isClickable } from 'utils/html';
import { nextVal } from 'utils/seq';

interface Props {
  beatmaps: BeatmapExtendedJson[];
  beatmapset: BeatmapsetExtendedJson;
  currentBeatmap: BeatmapExtendedJson;
  getCount?: (beatmap: BeatmapExtendedJson) => number | undefined;
  large: boolean;
  modifiers?: Modifiers;
  onSelectBeatmap: (beatmapId: number) => void;
  users: Partial<Record<number | string, UserJson>>;
}

interface State {
  showingSelector: boolean;
}

export default class BeatmapList extends React.PureComponent<Props, State> {
  static defaultProps = {
    large: true,
    users: {},
  };

  private readonly eventId = `beatmapset-discussions-show-beatmap-list-${nextVal()}`;
  private readonly selectorRef = React.createRef<HTMLDivElement>();

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
            ref={this.selectorRef}
            className='beatmap-list__item beatmap-list__item--selected beatmap-list__item--large js-beatmap-list-selector'
            onClick={this.toggleSelector}
          >
            <div className='beatmap-list__selected beatmap-list__selected--icons'>
              {Array.from({ length: 4 }).map((_blank, idx) => (
                <i key={idx} className='fas fa-circle u-relative' />
              ))}
            </div>
            <div className='beatmap-list__selected beatmap-list__selected--list u-ellipsis-overflow'>
              <BeatmapListItem
                beatmap={this.props.currentBeatmap}
                modifiers={{ large: this.props.large }}
              />

              <div className='beatmap-list__item-selector-button'>
                <span className='fas fa-chevron-down' />
              </div>
            </div>
          </div>

          <div className='beatmap-list__selector u-fancy-scrollbar'>
            {this.props.beatmaps.map(this.beatmapListItem)}
          </div>
        </div>
      </div>
    );
  }

  private beatmapListItem = (beatmap: BeatmapExtendedJson) => {
    const count = this.props.getCount?.(beatmap);

    return (
      <div
        key={beatmap.id}
        className={classWithModifiers('beatmap-list__item', { current: beatmap.id === this.props.currentBeatmap.id })}
        data-id={beatmap.id}
        onClick={this.selectBeatmap}
      >
        <BeatmapListItem beatmap={beatmap} />
        {this.props.beatmapset.user_id !== beatmap.user_id && (
          <>
            {' '}
            <span className='beatmap-list__item-mapper'>
              <StringWithComponent
                mappings={{
                  mapper: <UserLink user={this.props.users[beatmap.user_id] ?? deletedUser.toJson()} />,
                }}
                pattern={osu.trans('beatmapsets.show.details.mapped_by')}
              />
            </span>
          </>
        )}
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
    if (isClickable(e.target)) return;
    if (
      this.selectorRef.current != null
      && e.originalEvent != null
      && e.originalEvent.composedPath().includes(this.selectorRef.current)
    ) return;

    this.hideSelector();
  };

  private selectBeatmap = (e: React.MouseEvent<HTMLElement>) => {
    if (e.button !== 0) return;
    if (isClickable(e.target)) return;

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
    if (isClickable(e.target)) return;

    this.setSelector(!this.state.showingSelector);
  };
}
