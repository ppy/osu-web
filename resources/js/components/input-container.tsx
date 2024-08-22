// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';
import { trans } from 'utils/lang';
import MessageLengthCounter from './message-length-counter';

interface CommonProps {
  for?: string;
  hasError?: boolean;
  labelKey?: string;
  modifiers?: Modifiers;
  showError?: boolean;
}

type Props = CommonProps & ({
  input: string;
  maxLength: number;
} | {
  input?: string;
  maxLength?: never;
});

// TODO: look at combining with ValidatingInput
// TODO: show error message
const InputContainer = observer((props: React.PropsWithChildren<Props>) => {
  const error = props.hasError && props.showError;

  return (
    <label className={classWithModifiers('input-container', { error }, props.modifiers)} htmlFor={props.for}>
      {props.labelKey != null && (
        <div className='input-container__label'>
          {trans(props.labelKey)}
          {props.maxLength != null && (
            <MessageLengthCounter
              maxLength={props.maxLength}
              message={props.input}
            />
          )}
        </div>
      )}
      {props.children}
    </label>
  );
});

export default InputContainer;
