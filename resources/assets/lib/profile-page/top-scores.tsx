// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import LazyLoad from 'components/lazy-load';
import { computed } from 'mobx';
import { observer } from 'mobx-react';
import ExtraHeader from 'profile-page/extra-header';
import * as React from 'react';
import ExtraPageProps, { topScoreSections } from './extra-page-props';
import PlayDetailList from './play-detail-list';

@observer
export default class TopScores extends React.Component<ExtraPageProps> {
  @computed
  private get hasData() {
    return this.props.controller.state.lazy.top_ranks != null;
  }

  render() {
    return (
      <div className='page-extra'>
        <ExtraHeader name={this.props.name} withEdit={this.props.controller.withEdit} />

        {this.props.controller.scoresNotice != null && (
          <div className='wiki-notice wiki-notice--profile-page-extra'>
            <span className='fas fa-exclamation-circle' />
            {' '}
            <div
              className='wiki-notice__markdown-inline-content'
              dangerouslySetInnerHTML={{ __html: this.props.controller.scoresNotice }}
            />
          </div>
        )}

        <LazyLoad hasData={this.hasData} name={this.props.name} onLoad={this.handleLazyLoad}>
          {topScoreSections.map((section) => (
            <PlayDetailList key={section} controller={this.props.controller} section={section} />
          ))}
        </LazyLoad>
      </div>
    );
  }

  private readonly handleLazyLoad = () => this.props.controller.get('top_ranks');
}
