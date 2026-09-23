// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { rulesetNames, rulesets } from 'interfaces/ruleset';
import { action } from 'mobx';
import { observer } from 'mobx-react';
import BeatmapTag from 'models/beatmap-tag';
import React, { useCallback, useEffect, useRef } from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import BeatmapTagPickerController from './beatmap-tag-picker-controller';

interface Props {
  controller: BeatmapTagPickerController;
}

export default observer(function BeatmapUserTagPicker(props: Props) {
  const inputRef = useRef<HTMLInputElement>(null);
  const onChange = action((e: React.ChangeEvent<HTMLInputElement>) => props.controller.query = e.target.value);

  useEffect(() => {
    inputRef.current?.focus();
  }, []);

  return (
    <div className='beatmap-tag-picker'>
      <input
        ref={inputRef}
        className='beatmap-tag-picker__search'
        name='tag-search'
        onChange={onChange}
        placeholder={trans('beatmaps.listing.search.tag_picker.prompt')}
        value={props.controller.query}
      />
      <div className='beatmap-tag-picker__scroll-area u-fancy-scrollbar'>
        <div className='beatmap-tag-picker__list'>
          {props.controller.groups.map((group) => (
            <React.Fragment key={group.name}>
              <span className='beatmap-tag-picker__category'>{group.name}</span>
              {group.tags.map((tag) => <UserTag key={tag.id} props={props} tag={tag} />)}
            </React.Fragment>
          ))}
        </div>
      </div>
    </div>
  );
});

const UserTag = observer(function UserTag({ tag, props }: { props: Props; tag: BeatmapTag }) {
  const active = props.controller.isTagEnabled(tag);

  const onClick = useCallback(() => {
    if (!active) {
      props.controller.enableTag(tag);
    } else {
      props.controller.disableTag(tag);
    }
  }, [tag, active, props]);

  const showAllRulesets = props.controller.rulesetId == null;
  const hasAllRulesets = tag.rulesetIds.length === rulesets.length;

  return (<div className={classWithModifiers('beatmap-tag-picker__tag', { active })} onClick={onClick}>
    <span className='beatmap-tag-picker__tag-info beatmap-tag-picker__tag-info--name'>{tag.tagName}</span>
    <span className='beatmap-tag-picker__tag-info beatmap-tag-picker__tag-info--description'>
      {showAllRulesets && !hasAllRulesets && tag.rulesetIds.map((rulesetId) => (<React.Fragment key={rulesetId}>
        <span className={`fal fa-extra-mode-${rulesetNames[rulesetId]}`} />{' '}
      </React.Fragment>))}
      {tag.description}
    </span>
  </div>);
});
