// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetCardSizeSelector from 'beatmaps/beatmapset-card-size-selector';
import VirtualListMeta from 'beatmaps/virtual-list-meta';
import BeatmapsetPanel, { beatmapsetCardSizes } from 'components/beatmapset-panel';
import Img2x from 'components/img2x';
import StringWithComponent from 'components/string-with-component';
import { route } from 'laroute';
import { chunk } from 'lodash';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import VirtualList, { RenderProps } from 'virtual-list/virtual-list';
import AvailableFilters from './available-filters';
import { Paginator } from './paginator';
import { SearchPanel } from './search-panel';
import { SearchSort } from './search-sort';

interface Props {
  availableFilters: AvailableFilters;
  backToTopAnchor: React.RefObject<HTMLDivElement>;
}

// Rendered as a vertical list of flexbox rows instead of css grid as it repaints faster.
// With CSS grid, every item has to be re-layout and re-painted when the virtual window is updated.
// The current method only has to paint new rows and shift the layout of the other rows.
const BeatmapList = ({ items }: RenderProps<number[]>) => (
  <div className='beatmapsets__items'>
    {items.map((row) => (
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
);

const EmptyList = () => (
  <div className='beatmapsets__empty'>
    <Img2x
      alt={trans('beatmaps.listing.search.not-found')}
      src='/images/layout/beatmaps/not-found.png'
      title={trans('beatmaps.listing.search.not-found')}
    />
    {trans('beatmaps.listing.search.not-found-quote')}
  </div>
);

@observer
export class SearchContent extends React.Component<Props> {
  private readonly virtualListMeta = new VirtualListMeta();

  private get beatmapsetIds() {
    return this.controller.currentBeatmapsetIds;
  }

  @computed
  private get chunkedItems() {
    return chunk(this.beatmapsetIds, this.virtualListMeta.numberOfColumns);
  }

  private get controller() {
    return core.beatmapsetSearchController;
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  render() {
    const listCssClasses = classWithModifiers('beatmapsets', { dimmed: this.controller.isBusy });

    return (
      <>
        <SearchPanel
          availableFilters={this.props.availableFilters}
          firstBeatmapset={core.dataStore.beatmapsetStore.get(this.beatmapsetIds[0])}
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
              {this.controller.isSupporterMissing ? this.renderSupporterRequired() : this.renderList() }
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

  private renderList() {
    return this.beatmapsetIds.length > 0 ? (
      <VirtualList
        itemBuffer={5}
        itemHeight={this.virtualListMeta.itemHeight}
        items={this.chunkedItems}
      >
        {BeatmapList}
      </VirtualList>
    ) : <EmptyList />;
  }

  private renderSupporterRequired() {
    const filters = this.controller.supporterRequiredFilterText;
    const link = (
      <a href={route('store.products.show', { product: 'supporter-tag' })}>
        {trans('beatmaps.listing.search.supporter_filter_quote.link_text')}
      </a>
    );

    return (
      <div className='beatmapsets__empty'>
        <Img2x
          alt={trans('beatmaps.listing.search.supporter_filter', { filters })}
          src='/images/layout/beatmaps/supporter-required.png'
          title={trans('beatmaps.listing.search.supporter_filter', { filters })}
        />
        <p>
          <StringWithComponent
            mappings={{ filters, link }}
            pattern={trans('beatmaps.listing.search.supporter_filter_quote._')}
          />
        </p>
      </div>
    );
  }
}
