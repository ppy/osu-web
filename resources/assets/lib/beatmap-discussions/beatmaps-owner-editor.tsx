// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetJson from 'interfaces/beatmapset-json';
import UserJson from 'interfaces/user-json';
import { makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import { deletedUser } from 'models/user';
import * as React from 'react';
import { group as groupBeatmaps } from 'utils/beatmap-helper';
import BeatmapOwnerEditor from './beatmap-owner-editor';

interface Props {
  beatmapset: BeatmapsetJson;
  onClose: () => void;
  users: Partial<Record<number, UserJson>>;
}

const deletedUserJson = deletedUser.toJson();

@observer
export default class BeatmapsOwnerEditor extends React.Component<Props> {
  @observable userByName = new Map<string, UserJson>();

  constructor(props: Props) {
    super(props);

    // this will be outdated on new props but it's fine
    // as there's separate process handling unknown users
    for (const user of Object.values(props.users)) {
      if (user != null) {
        this.userByName.set(user.username, user);
      }
    }

    makeObservable(this);
  }

  render() {
    const beatmapsetUser = this.getUser(this.props.beatmapset.user_id);
    const groupedBeatmaps = [...groupBeatmaps((this.props.beatmapset.beatmaps ?? []).filter(
      (beatmap) => beatmap.deleted_at == null,
    ))];

    return (
      <div className='beatmaps-owner-editor u-fancy-scrollbar'>
        <div className='beatmaps-owner-editor__row beatmaps-owner-editor__row--content'>
          {/* header and its grid placeholder */}
          <div />
          <strong>
            {osu.trans('beatmap_discussions.owner_editor.version')}
          </strong>
          <div />
          <strong>
            {osu.trans('beatmap_discussions.owner_editor.user')}
          </strong>
          <div />

          {groupedBeatmaps.map(([, beatmaps]) => (
            beatmaps.map((beatmap) => (
              <BeatmapOwnerEditor
                key={beatmap.id}
                beatmap={beatmap}
                beatmapsetUser={beatmapsetUser}
                user={this.getUser(beatmap.user_id)}
                userByName={this.userByName}
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
            {osu.trans('common.buttons.close')}
          </button>
        </div>
      </div>
    );
  }

  private getUser(userId: number) {
    return this.props.users[userId] ?? deletedUserJson;
  }
}
