// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { action } from 'mobx';
import { observer } from 'mobx-react';
import React, { useEffect, useRef } from 'react';
import BeatmapTag from '../models/beatmap-tag';
import core from '../osu-core-singleton';
import { TagGroup } from './user-tag-picker-controller';

const controller = core.beatmapTagPickerController;
const beatmapsetSearchController = core.beatmapsetSearchController;

const UserTagPicker = observer(() => {
  const inputRef = useRef<HTMLInputElement>(null);
  const scrollViewRef = useRef<HTMLDivElement>(null);
  const onChange = action((e: React.ChangeEvent<HTMLInputElement>) => controller.query = e.target.value);

  useEffect(() => {
    inputRef.current?.focus();
  }, [inputRef]);

  return (
    <div className='user-tag-picker'>
      <input
        ref={inputRef}
        className='user-tag-picker__search'
        name='tag-search'
        onChange={onChange}
        placeholder='type to search'
        value={controller.query ?? ''}
      />
      <div ref={scrollViewRef} className='user-tag-picker__list u-fancy-scrollbar'>
        {controller.groups.map((group) => <UserTagGroup key={group.name} group={group} />)}
      </div>
    </div>
  );
});
const UserTagGroup = observer(({ group }: { group: TagGroup }) => (
  <>
    <span className='user-tag-picker__category'>{group.name}</span>
    {group.tags.map((tag) => <UserTag key={tag.id} tag={tag} />)}
  </>
));

const UserTag = observer(({ tag }: { tag: BeatmapTag }) => {
  const onClick = action(() => {
    let tagString = tag.fullName;

    if (/\s/g.test(tagString)) {
      tagString = `"${tagString}"`;
    }

    const currentQuery = beatmapsetSearchController.filters.query;

    const newQuery = currentQuery !== null
      ? currentQuery + ` tag="${tagString}"`
      : `tag="${tagString}"`;

    beatmapsetSearchController.filters.update('query', newQuery);
  });

  return (<div className='user-tag-picker__tag' onClick={onClick}>
    <span className='user-tag-picker__tag-info user-tag-picker__tag-info--name'>{tag.name}</span>
    <span className='user-tag-picker__tag-info user-tag-picker__tag-info--description'>{tag.description}</span>
  </div>);
});

export default UserTagPicker;
