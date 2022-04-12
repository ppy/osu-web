// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import { FancyForm, InputKey } from 'models/chat/create-announcement';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  labelKey?: string;
  model: FancyForm<InputKey>;
  name: InputKey;
}

// TODO: look at combining with ValidatingInput
const InputContainer = observer((props: React.PropsWithChildren<Props>) => {
  const error = props.model.errors[props.name] && props.model.showError[props.name];
  return (
    <label className={classWithModifiers('input-container', { error })}>
      {props.labelKey != null && (
        <div className='input-container__label'>
          {osu.trans(props.labelKey)}
        </div>
      )}
      {props.children}
    </label>
  );
});

export default InputContainer;
