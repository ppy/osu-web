/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import { Comment } from 'models/comment';
import * as React from 'react';

interface Props {
  comments: Comment[];
  modifiers: string[] | undefined;
  showDeleted: boolean;
}

export default class DeletedCommentsCount extends React.Component<Props> {
  render() {
    const deletedCount = this.props.comments.filter((c) => c.deletedAt != null).length;

    if (this.props.showDeleted || deletedCount === 0) {
      return null;
    }

    return (
      <div className={osu.classWithModifiers('deleted-comments-count', this.props.modifiers)}>
        <span className='deleted-comments-count__icon'>
          <span className='far fa-trash-alt' />
        </span>
          {osu.transChoice('comments.deleted_count', deletedCount)}
      </div>
    );
  }
}
