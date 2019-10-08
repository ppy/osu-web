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

import { FormErrors } from 'form-errors';
import { observer } from 'mobx-react';
import * as React from 'react';

interface Props extends React.InputHTMLAttributes<HTMLInputElement> {
  blockName: string;
  errors: FormErrors;
  name: string;
}

@observer
export class ValidatingInput extends React.Component<Props> {
  render() {
    const {
      blockName,
      errors,
      name,
      ...otherProps
    } = this.props;

    const messages = errors.get(name) || [];
    const jsx = messages.map((message, index) => <div key={index} className={`${blockName}__error`}>{message}</div>);

    return (
      <>
        <input
          className={osu.classWithModifiers(`${blockName}__input`, messages.length > 0 ? ['has-error'] : [])}
          name={name}
          {...otherProps}
        />
        {jsx}
      </>
    );
  }
}
