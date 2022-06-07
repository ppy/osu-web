// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetCardSizeSelector from 'beatmaps/beatmapset-card-size-selector';
import VirtualListMeta from 'beatmaps/virtual-list-meta';
import BeatmapsetPanel, { beatmapsetCardSizes } from 'components/beatmapset-panel';
import Img2x from 'components/img2x';
import { route } from 'laroute';
import { chunk } from 'lodash';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import VirtualList from 'react-virtual-list';
import { classWithModifiers } from 'utils/css';
import AvailableFilters from './available-filters';
import { Paginator } from './paginator';
import { SearchPanel } from './search-panel';
import { SearchSort } from './search-sort';

// Don't care about the typing of virtual, we're going to replace it.
interface ListRenderProps {
  itemHeight: number;
  virtual: {
    items: number[][];
    style: React.CSSProperties;
  };
}

interface Props {
  availableFilters: AvailableFilters;
  backToTopAnchor: React.RefObject<HTMLDivElement>;
}

const ListRender = ({ virtual }: ListRenderProps) => (
  <div style={virtual.style}>
    <div className='beatmapsets__items'>
      {virtual.items.map((row) => (
        <div key={row.join('-')} className='beatmapsets__items-row'>
          {row.map((beatmapsetId) => {
            const beatmapset = core.dataStore.beatmapsetStore.get(beatmapsetId);
            return (
              <div key={beatmapsetId} className='beatmapsets__item'>
                {beatmapset != null && <BeatmapsetPanel beatmapset={beatmapset} />}
              </div>
            );
          })}
        </div>
      ))}
    </div>
  </div>
);

const BeatmapList = VirtualList()(ListRender);

function renderLinkToSupporterTag(filterText: string) {
  const url = route('store.products.show', { product: 'supporter-tag' });
  const link = `<a href="${url}">${osu.trans('beatmaps.listing.search.supporter_filter_quote.link_text')}</a>`;

  return (
    <p dangerouslySetInnerHTML={{
      __html: osu.trans('beatmaps.listing.search.supporter_filter_quote._', { filters: filterText, link }),
    }}/>
  );
}

@observer
export class SearchContent extends React.Component<Props> {
  private readonly virtualListMeta = new VirtualListMeta();

  private get controller() {
    return core.beatmapsetSearchController;
  }

  render() {
    const beatmapsetIds = this.controller.currentBeatmapsetIds;
    const listCssClasses = classWithModifiers('beatmapsets', { dimmed: this.controller.isBusy });

    return (
      <>
        <SearchPanel
          availableFilters={this.props.availableFilters}
          firstBeatmapset={core.dataStore.beatmapsetStore.get(beatmapsetIds[0])}
          innerRef={this.props.backToTopAnchor}
        />
        <div className='js-sticky-header' />
        <div className='osu-layout__row osu-layout__row--page-compact'>
          <div className={listCssClasses}>
            {this.controller.advancedSearch && (
              <div className='beatmapsets__toolbar'>
                <div className='beatmapsets__toolbar-item'>
                  <SearchSort />
                </div>
                <div className='beatmapsets__toolbar-item'>
                  <div className='sort hidden-xs'>
                    <div className='sort__items'>
                      {beatmapsetCardSizes.map((size) => (
                        <BeatmapsetCardSizeSelector key={size} classElement='sort__item' size={size} />
                      ))}
                    </div>
                  </div>
                </div>
              </div>
            )}
            <div className='beatmapsets__content js-audio--group'>
              {this.controller.isSupporterMissing ? this.renderSupporterRequired() : beatmapsetIds.length > 0 ? (
                <BeatmapList
                  itemBuffer={5}
                  itemHeight={this.virtualListMeta.itemHeight}
                  items={chunk(beatmapsetIds, this.virtualListMeta.numberOfColumns)}
                />
              ) : this.renderEmptyList()}
            </div>
            {!this.controller.isSupporterMissing && (
              <div className='beatmapsets__paginator'>
                <Paginator />
              </div>
            )}
          </div>
        </div>
      </>
    );
  }

  private renderEmptyList() {
    return (
      <div className='beatmapsets__empty'>
        <Img2x
          alt={osu.trans('beatmaps.listing.search.not-found')}
          src='/images/layout/beatmaps/not-found.png'
          title={osu.trans('beatmaps.listing.search.not-found')}
        />
        {osu.trans('beatmaps.listing.search.not-found-quote')}
      </div>
    );
  }

  private renderSupporterRequired() {
    const supporterRequiredFilterText = this.controller.supporterRequiredFilterText;
    return (
      <div className='beatmapsets__empty'>
        <Img2x
          alt={osu.trans('beatmaps.listing.search.supporter_filter', { filters: supporterRequiredFilterText })}
          src='/images/layout/beatmaps/supporter-required.png'
          title={osu.trans('beatmaps.listing.search.supporter_filter', { filters: supporterRequiredFilterText })}
        />
        {renderLinkToSupporterTag(supporterRequiredFilterText)}
      </div>
    );
  }
}
