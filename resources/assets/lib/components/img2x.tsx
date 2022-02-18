// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { make2x } from 'utils/html';

interface Props extends React.DetailedHTMLProps<React.ImgHTMLAttributes<HTMLImageElement>, HTMLImageElement> {
  hideOnError?: boolean;
}

// hides img elements that have errored (hides native browser broken-image icons)
function handleError(e: React.SyntheticEvent<HTMLElement>) {
  e.currentTarget.style.display = 'none';
}

export default function Img2x(props: Props) {
  const { hideOnError = false, ...otherProps } = props;
  if (hideOnError) {
    otherProps.onError = handleError;
  }

  if (otherProps.src == null) {
    return <img style={{ display: 'none' }} {...otherProps} />;
  }

  return <img srcSet={`${otherProps.src} 1x, ${make2x(otherProps.src)} 2x`} {...otherProps} />;
}
