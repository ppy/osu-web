// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { rulesetNames, rulesets } from 'interfaces/ruleset';
import { action } from 'mobx';
import { observer } from 'mobx-react';
import BeatmapTag from 'models/beatmap-tag';
import core from 'osu-core-singleton';
import React, { useCallback, useEffect, useRef } from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';

const controller = core.beatmapTagPickerController;

const onChange = action((e: React.ChangeEvent<HTMLInputElement>) => controller.query = e.target.value);

interface Props {
  isTagEnabled: (tag: BeatmapTag) => boolean;
  onDisabled: (tag: BeatmapTag) => void;
  onEnabled: (tag: BeatmapTag) => void;
  showAllRulesets: boolean;
}

export default observer(function BeatmapUserTagPicker(props: Props) {
  const inputRef = useRef<HTMLInputElement>(null);

  useEffect(() => {
    inputRef.current?.focus();
  }, []);

  return (
    <div className='beatmap-user-tag-picker'>
      <input
        ref={inputRef}
        className='beatmap-user-tag-picker__search'
        name='tag-search'
        onChange={onChange}
        placeholder={trans('beatmaps.listing.search.tag_picker.prompt')}
        value={controller.query}
      />
      <div className='beatmap-user-tag-picker__scroll-area u-fancy-scrollbar'>
        <div className='beatmap-user-tag-picker__list'>
          {controller.groups.map((group) => (
            <React.Fragment key={group.name}>
              <span className='beatmap-user-tag-picker__category'>{group.name}</span>
              {group.tags.map((tag) => <UserTag key={tag.id} props={props} tag={tag} />)}
            </React.Fragment>
          ))}
        </div>
      </div>
    </div>
  );
});

const UserTag = observer(function UserTag({ tag, props }: { props: Props; tag: BeatmapTag }) {
  const active = props.isTagEnabled(tag);

  const onClick = useCallback(() => {
    if (!active) {
      props.onEnabled(tag);
    } else {
      props.onDisabled(tag);
    }
  }, [tag, active, props]);

  const hasAllRulesets = tag.rulesetIds.length === rulesets.length;

  return (<div className={classWithModifiers('beatmap-user-tag-picker__tag', { active })} onClick={onClick}>
    <span className='beatmap-user-tag-picker__tag-info beatmap-user-tag-picker__tag-info--name'>{tag.tagName}</span>
    <span className='beatmap-user-tag-picker__tag-info beatmap-user-tag-picker__tag-info--description'>
      {props.showAllRulesets && !hasAllRulesets && tag.rulesetIds.map((rulesetId) => (<React.Fragment key={rulesetId}>
        <span className={`fal fa-extra-mode-${rulesetNames[rulesetId]}`} />{' '}
      </React.Fragment>))}
      {tag.description}
    </span>
  </div>);
});
