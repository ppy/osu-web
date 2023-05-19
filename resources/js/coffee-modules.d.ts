// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

/* eslint-disable max-classes-per-file */

// importable coffeescript modules
declare module 'components/back-to-top' {
  interface Props {
    anchor: React.RefObject<HTMLElement>;
    ref: React.RefObject<BackToTop>;
  }

  class BackToTop extends React.PureComponent<Props> {
    reset(): void;
  }
}

declare module 'components/comments' {
  class Comments extends React.PureComponent<any> {}
}

declare module 'components/comments-manager' {
  interface Props {
    commentableId?: number;
    commentableType?: string;
    component: any;
    componentProps?: any;
  }

  class CommentsManager extends React.PureComponent<Props> {}
}
