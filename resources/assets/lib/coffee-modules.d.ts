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
    componentProps: any;
  }

  class CommentsManager extends React.PureComponent<Props> {}
}

declare module 'components/modal' {
  interface Props {
    onClose?: () => void;
    visible: boolean;
  }

  class Modal extends React.PureComponent<Props> {
    static isOpen(): boolean;
  }
}

declare module 'components/notification-banner' {
  interface Props {
    message: React.ReactFragment;
    title: string;
    type: string;
  }

  class NotificationBanner extends React.PureComponent<Props> {}
}

declare module 'components/popup-menu' {
  type Children = (dismiss: () => void) => React.ReactFragment;

  interface Props {
    children: Children;
    customRender?: (children: JSX.Element[], ref: React.RefObject<HTMLElement>, toggle: (event: React.MouseEvent<HTMLElement>) => void) => JSX.Element;
    direction?: 'left' | 'right';
    onHide?: () => void;
    onShow?: () => void;
  }

  class PopupMenu extends React.PureComponent<Props, any> {}
}

declare module 'react/beatmaps/search-content' {
  import AvailableFilters from 'beatmaps/available-filters';

  interface Props {
    availableFilters: AvailableFilters;
    backToTopAnchor: React.RefObject<HTMLElement>;
  }

  class SearchContent extends React.PureComponent<Props> {}
}

declare module 'components/report-form' {
  interface ReportFormProps {
    completed: boolean;
    disabled: boolean;
    onClose: () => void;
    onSubmit: ({comments}: {comments: string}) => void;
    title: string;
    visible: boolean;
    visibleOptions?: string[];
  }

  class ReportForm extends React.PureComponent<ReportFormProps, any> {}
}

declare module 'components/select-options' {
  interface Option<T = string> {
    id: T | null;
    text: string;
  }

  interface OptionRenderProps<T = string> {
    children: React.ReactNode[];
    cssClasses: string;
    onClick: (event: React.SyntheticEvent) => void;
    option: Option<T>;
  }

  interface Props<T> {
    bn?: string;
    onChange: (option: Option<T>) => void;
    options: Option<T>[];
    renderOption: (props: OptionRenderProps<T>) => React.ReactNode;
    selected: Option<T>;
  }

  class SelectOptions<T = string> extends React.PureComponent<Props<T>> {}
}
