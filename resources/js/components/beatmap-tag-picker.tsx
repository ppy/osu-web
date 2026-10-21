// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { rulesetNames, rulesets } from 'interfaces/ruleset';
import { groupBy } from 'lodash';
import { action, computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import BeatmapTag from 'models/beatmap-tag';
import core from 'osu-core-singleton';
import React, { useCallback } from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import BeatmapTagPickerController from './beatmap-tag-picker-controller';

interface Props {
  controller: BeatmapTagPickerController;
}

@observer
export default class BeatmapTagPicker extends React.Component<Props> {
  private readonly inputRef = React.createRef<HTMLInputElement>();

  @computed
  private get groups() {
    const querySplit = this.props.controller.query.trim().toLowerCase().split(/\s+/);

    const filtered = core.beatmapTagStore.tags.filter((tag) => tag.match(querySplit, this.props.controller.rulesetId));
    const grouped = groupBy(filtered, (tag) => tag.categoryName);

    return Object.entries(grouped).map(([name, tags]) => ({ name, tags }));
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentDidMount() {
    setTimeout(() => this.inputRef.current?.focus(), 20);
  }

  render() {
    return (
      <div className='beatmap-tag-picker'>
        <input
          ref={this.inputRef}
          className='beatmap-tag-picker__search'
          name='tag-search'
          onChange={this.onInputChange}
          placeholder={trans('beatmaps.listing.search.tag_picker.prompt')}
          value={this.props.controller.query}
        />
        <div className='beatmap-tag-picker__scroll-area u-fancy-scrollbar'>
          <div className='beatmap-tag-picker__list'>
            {this.groups.map((group) => (
              <React.Fragment key={group.name}>
                <span className='beatmap-tag-picker__category'>{group.name}</span>
                {group.tags.map((tag) => <UserTag key={tag.id} props={this.props} tag={tag} />)}
              </React.Fragment>
            ))}
          </div>
        </div>
      </div>
    );
  }

  @action
  private readonly onInputChange = (e: React.ChangeEvent<HTMLInputElement>) => this.props.controller.query = e.target.value;
}

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
