// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { FormErrors } from 'form-errors';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

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
          className={classWithModifiers(`${blockName}__input`, messages.length > 0 ? ['has-error'] : [])}
          name={name}
          {...otherProps}
        />
        {jsx}
      </>
    );
  }
}
