// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';

export interface Props {
  mappings: Partial<Record<string, React.ReactNode>>;
  pattern: string;
}

export default function StringWithComponent(props: Props) {
  const keys = Object.keys(props.mappings);

  if (keys.length === 0) {
    return <>{props.pattern}</>;
  }

  const regex = new RegExp(`(:${keys.join('|:')})`);
  const parts = props.pattern.split(regex);

  return (
    <>
      {parts.map((part) => {
        const key = part[0] === ':' ? part.slice(1) : null;
        const content = key == null || props.mappings[key] == null
          ? part
          : props.mappings[key];

        return typeof content === 'string'
          ? content
          : <React.Fragment key={part}>{content}</React.Fragment>;
      })}
    </>
  );
}
