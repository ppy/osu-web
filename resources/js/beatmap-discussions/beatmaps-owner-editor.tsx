// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import UserJson, { UserJsonMinimum } from 'interfaces/user-json';
import { observer } from 'mobx-react';
import { deletedUserJson } from 'models/user';
import * as React from 'react';
import { group as groupBeatmaps } from 'utils/beatmap-helper';
import { trans } from 'utils/lang';
import BeatmapOwnerEditor from './beatmap-owner-editor';
import DiscussionsState from './discussions-state';

interface Props {
  beatmapset: BeatmapsetWithDiscussionsJson;
  discussionsState: DiscussionsState;
  onClose: () => void;
  users: Map<number | null | undefined, UserJson>;
}

@observer
export default class BeatmapsOwnerEditor extends React.Component<Props> {
  render() {
    const groupedBeatmaps = [...groupBeatmaps((this.props.beatmapset.beatmaps ?? []).filter(
      (beatmap) => beatmap.deleted_at == null,
    ))];

    return (
      <div className='beatmaps-owner-editor u-fancy-scrollbar'>
        <div className='beatmaps-owner-editor__row beatmaps-owner-editor__row--content'>
          {/* header and its grid placeholder */}
          <div />
          <strong>
            {trans('beatmap_discussions.owner_editor.version')}
          </strong>
          <strong>
            {trans('beatmap_discussions.owner_editor.user')}
          </strong>
          <div />

          {groupedBeatmaps.map(([, beatmaps]) => (
            beatmaps.map((beatmap) => (
              <BeatmapOwnerEditor
                key={beatmap.id}
                beatmap={beatmap}
                beatmapset={this.props.beatmapset}
                discussionsState={this.props.discussionsState}
                mappers={beatmap.mappers.map(this.getUser)}
              />
            ))
          ))}
        </div>

        <div className='beatmaps-owner-editor__row beatmaps-owner-editor__row--footer'>
          <button
            className='btn-osu-big btn-osu-big--rounded-thin'
            onClick={this.props.onClose}
            type='button'
          >
            {trans('common.buttons.close')}
          </button>
        </div>
      </div>
    );
  }

  private readonly getUser = (json: UserJsonMinimum) => {
    let user = this.props.users.get(json.id);
    if (user == null) {
      user = structuredClone(deletedUserJson);
      user.id = json.id;
    }

    return user;
  };
}
