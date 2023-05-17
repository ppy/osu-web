// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';
import { trans } from 'utils/lang';
import MessageLengthCounter from './message-length-counter';

interface CommonProps {
  extras?: React.ReactNode;
  for?: string;
  labelKey?: string;
  modifiers?: Modifiers;
}

export interface FormWithErrors<T extends string> {
  errors: Record<T, boolean>;
  inputs: Record<T, string>;
  showError: Record<T, boolean>;
}

// extra props when error marking support is used.
type Props<T extends string> =
  CommonProps & (
    { maxLength?: number; model: FormWithErrors<T>; name: T }
    | { model?: never; name?: never }
  );

// TODO: look at combining with ValidatingInput
const InputContainer = observer(<T extends string>(props: React.PropsWithChildren<Props<T>>) => {
  const error = props.model != null && props.model.errors[props.name] && props.model.showError[props.name];

  return (
    <label className={classWithModifiers('input-container', { error }, props.modifiers)} htmlFor={props.for}>
      {props.labelKey != null && (
        <div className='input-container__label'>
          <span>
            {trans(props.labelKey)}
            {props.extras != null && <span> {props.extras}</span>}
          </span>
          {props.model != null && props.maxLength != null && (
            <MessageLengthCounter maxLength={props.maxLength} message={props.model.inputs[props.name]} />
          )}
        </div>
      )}
      {props.children}
    </label>
  );
});

export default InputContainer;
