// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';

interface Props {
  mappings: any;
  pattern: string;
}

export function StringWithComponent(props: Props) {
  const keys = Object.keys(props.mappings);
  const regex = new RegExp(`(${keys.join('|')})`);
  const parts = props.pattern.split(regex);

  return (
    <>
      {
        parts.map((part) => {
          return props.mappings[part] ? props.mappings[part] : part;
        })
      }
    </>
  );
}
