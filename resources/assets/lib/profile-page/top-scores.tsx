// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import ExtraHeader from 'profile-page/extra-header';
import * as React from 'react';
import ExtraPageProps, { topScoreSections } from './extra-page-props';
import PlayDetailList from './play-detail-list';

@observer
export default class TopScores extends React.Component<ExtraPageProps> {
  render() {
    return (
      <div className='page-extra'>
        <ExtraHeader name={this.props.name} withEdit={this.props.controller.withEdit} />

        {this.props.controller.scoresNotice != null && (
          <div className='wiki-notice'>
            <span className='fas fa-exclamation-circle' />
            {' '}
            <div
              className='wiki-notice__markdown-inline-content'
              dangerouslySetInnerHTML={{ __html: this.props.controller.scoresNotice }}
            />
          </div>
        )}

        {topScoreSections.map((section) => (
          <PlayDetailList key={section} controller={this.props.controller} section={section} />
        ))}
      </div>
    );
  }
}
