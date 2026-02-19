// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { rulesetIds, rulesetIdToName } from 'interfaces/ruleset';
import { reduce } from 'lodash';
import { runInAction } from 'mobx';
import { observer } from 'mobx-react';
import BeatmapTag from 'models/beatmap-tag';
import core from 'osu-core-singleton';
import React, { useCallback, useEffect, useRef } from 'react';
import { trans } from 'utils/lang';
import { TagGroup } from './user-tag-picker-controller';

const controller = core.beatmapTagPickerController;
const beatmapsetSearchController = core.beatmapsetSearchController;

export default observer(function UserTagPicker() {
  const inputRef = useRef<HTMLInputElement>(null);
  const onChange = useCallback(
    (e: React.ChangeEvent<HTMLInputElement>) => runInAction(() => controller.query = e.target.value),
    [],
  );

  useEffect(() => {
    inputRef.current?.focus();
  }, []);

  return (
    <div className='user-tag-picker'>
      <input
        ref={inputRef}
        className='user-tag-picker__search'
        name='tag-search'
        onChange={onChange}
        placeholder={trans('beatmaps.listing.search.tag_picker.prompt')}
        value={controller.query ?? ''}
      />
      <div className='user-tag-picker__scroll-area u-fancy-scrollbar'>
        <div className='user-tag-picker__list'>
          {controller.groups.map((group) => <UserTagGroup key={group.name} group={group} />)}
        </div>
      </div>
    </div>
  );
});

const UserTagGroup = observer(function UserTagGroup({ group }: { group: TagGroup }) {
  return (
    <>
      <span className='user-tag-picker__category'>{group.name}</span>
      {group.tags.map((tag) => <UserTag key={tag.id} tag={tag} />)}
    </>
  );
});

const UserTag = observer(function UserTag({ tag }: { tag: BeatmapTag }) {
  const onClick = useCallback(() => {
    const tagString = `tag="${tag.fullName}"`;
    const currentQuery = beatmapsetSearchController.filters.query;

    const newQuery = currentQuery !== null
      ? currentQuery + ` ${tagString}`
      : tagString;

    beatmapsetSearchController.filters.update('query', newQuery);
  }, [tag]);

  const hasAllRulesets = reduce(
    rulesetIds,
    (hasAll, id) => hasAll && (tag.rulesetIds as readonly number[]).includes(id),
    true,
  );

  return (<div className='user-tag-picker__tag' onClick={onClick}>
    <span className='user-tag-picker__tag-info user-tag-picker__tag-info--name'>{tag.name}</span>
    <div>
      {beatmapsetSearchController.filters.mode === null && !hasAllRulesets && tag.rulesetIds.map((ruleset) => (
        <span key={rulesetIdToName[ruleset]} className={`user-tag-picker__tag-info user-tag-picker__tag-info--ruleset fal fa-extra-mode-${rulesetIdToName[ruleset]}`} />
      ))}
      <span className='user-tag-picker__tag-info user-tag-picker__tag-info--description'>{tag.description}</span>
    </div>
  </div>);
});
