// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import LazyLoad from 'components/lazy-load';
import ShowMoreLink from 'components/show-more-link';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import ExtraHeader from './extra-header';
import ExtraPageProps from './extra-page-props';

@observer
export default class Screenshots extends React.Component<ExtraPageProps> {
  @computed
  private get data() {
    return this.props.controller.state.lazy.screenshots;
  }

  @computed
  private get hasData() {
    return this.data != null;
  }

  constructor(props: ExtraPageProps) {
    super(props);

    makeObservable(this);
  }

  render() {
    return (
      <div className='page-extra'>
        <ExtraHeader name={this.props.name} withEdit={this.props.controller.withEdit} />
        <LazyLoad hasData={this.hasData} name={this.props.name} onLoad={this.handleOnLoad}>
          {this.renderScreenshots()}
        </LazyLoad>
      </div>
    );
  }

  private readonly handleOnLoad = () => this.props.controller.get('screenshots');

  private readonly onShowMore = () => this.props.controller.apiShowMore('screenshots');

  private renderScreenshots() {
    if (this.data == null) return;

    const galleryId = `profile-screenshots-${this.props.controller.state.user.id}`;

    return (
      <>
        <div className='page-extra__screenshots'>
          {this.data.items.map((item, index) => (
            <a
              key={item.id}
              className='page-extra__screenshots-item js-gallery'
              data-gallery-id={galleryId}
              data-height={item.height}
              data-index={index}
              data-width={item.width}
              href={item.url}
            >
              <img className='page-extra__screenshots-image' src={item.url} />
            </a>
          ))}
        </div>

        <ShowMoreLink
          {...this.data.pagination}
          callback={this.onShowMore}
          modifiers='profile-page'
        />
      </>
    );
  }
}
