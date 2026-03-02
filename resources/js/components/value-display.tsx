// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { Modifiers, classWithModifiers } from 'utils/css';

const bn = 'value-display';

interface Props {
  description?: JSX.Element;
  label: string;
  modifiers?: Modifiers;
  value: string | number | JSX.Element;
}

export default function ValueDisplay({ description, label, modifiers, value }: Props) {
  return (
    <div className={classWithModifiers(bn, modifiers)}>
      <div className={`${bn}__label u-ellipsis-overflow`}>{label}</div>
      <div className={`${bn}__value u-ellipsis-overflow`}>{value}</div>
      {description != null && <div className={`${bn}__description`}>{description}</div>}
    </div>
  );
}
