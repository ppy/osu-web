// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import SelectOptions, { OptionRenderProps } from 'components/select-options';
import SelectOptionJson from 'interfaces/select-option-json';
import * as React from 'react';
import { navigate } from 'utils/turbolinks';
import { updateQueryString } from 'utils/url';

function href(key: number) {
  return updateQueryString(null, { spotlight: key.toString() });
}

interface Props {
  options: SelectOptionJson[];
  selected: SelectOptionJson;
}

export default class SpotlightSelectOptions extends React.PureComponent<Props> {
  render() {
    return (
      <SelectOptions
        modifiers='spotlight'
        onChange={this.handleChange}
        options={this.props.options}
        renderOption={this.renderOption}
        selected={this.props.selected}
      />
    );
  }

  private handleChange(this: void, option: SelectOptionJson) {
    navigate(href(option.id));
  }

  private renderOption(this: void, { children, cssClasses, onClick, option }: OptionRenderProps<SelectOptionJson>) {
    return (
      <a
        key={option.id}
        className={cssClasses}
        href={href(option.id)}
        onClick={onClick}
      >
        {children}
      </a>
    );
  }
}
