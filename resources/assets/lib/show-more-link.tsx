// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { Spinner } from 'spinner';

const bn = 'show-more-link';

interface Props {
  callback?: () => void;
  data?: any;
  direction?: string;
  event?: any;
  hasMore?: boolean;
  label?: string;
  loading?: boolean;
  modifiers?: string[];
  remaining?: number;
  url?: string;
}

// re RefObject<any>: this thing returns three different type of things and I couldn't figure out how to type it.
const ShowMoreLink = React.forwardRef((props: Props, ref: React.RefObject<any>) => {
  if (!props.hasMore && !props.loading) {
    return null;
  }

  const icon = <span className={`fas fa-angle-${props.direction ?? 'down'}`} />;

  const children = (
    <>
      <span className={`${bn}__spinner`}>
        <Spinner />
      </span>
      <span className={`${bn}__label`}>
        <span className={`${bn}__label-icon ${bn}__label-icon--left`}>
          {icon}
        </span>

        <span className={`${bn}__label-text`}>
          {props.label ?? osu.trans('common.buttons.show_more')}
          {props.remaining != null && ` (${props.remaining})`}
        </span>

        <span className={`${bn}__label-icon ${bn}__label-icon--right`}>
          {icon}
        </span>
      </span>
    </>
  );

  let onClick = props.callback;
  let url = props.url;

  if (props.loading) {
    onClick = undefined;
    url = undefined;
  } else {
    if (onClick == null && url == null) {
     onClick = () => $.publish(props.event, props.data);
    }
  }

  const sharedProps = {
    children,
    className: osu.classWithModifiers(bn, props.modifiers),
    ref,
  };

  if (onClick == null && url == null) {
    return <span data-disabled='1' {...sharedProps} />;
  } else {
    if (url == null) {
      return <button type='button' onClick={onClick} {...sharedProps} />;
    } else {
      return <a href={props.url} onClick={onClick} {...sharedProps} />;
    }
  }
});

export { ShowMoreLink };
