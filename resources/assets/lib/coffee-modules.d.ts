/* tslint:disable:max-classes-per-file */

// importable coffeescript modules
declare module 'back-to-top' {
  interface Props {
    anchor: React.RefObject<{}>;
    ref: React.RefObject<{}>;
  }

  class BackToTop extends React.PureComponent<Props> {
    reset(): void;
  }
}

declare module 'block-button' {
  interface Props {
    modifiers?: string[];
    onClick?: () => void;
    userId: number;
    wrapperClass?: string;
  }

  class BlockButton extends React.PureComponent<Props> {}
}

declare module 'big-button' {
  interface Props {
    extraClasses?: string[];
    icon: string;
    isBusy?: boolean;
    modifiers?: string[];
    props: any;
    text: string;
  }

  class BigButton extends React.PureComponent<Props> {}
}

declare module 'flag-country' {
  class FlagCountry extends React.PureComponent<any> {}
}

declare module 'friend-button' {
  class FriendButton extends React.PureComponent<any> {}
}

declare module 'img2x' {
  class Img2x extends React.PureComponent<any> {}
}

declare module 'show-more-link' {
  class ShowMoreLink extends React.PureComponent<any> {}
}

declare module 'spinner' {
  interface Props {
    modifiers?: string[];
  }

  class Spinner extends React.PureComponent<Props> {}
}
declare module 'user-avatar' {
  class UserAvatar extends React.PureComponent<any> {}
}

declare module 'comments' {
  class Comments extends React.PureComponent<any> {}
}

declare module 'comments-manager' {
  interface Props {
    commentableId?: number;
    commentableType?: string;
    component: any;
    componentProps: any;
  }

  class CommentsManager extends React.PureComponent<Props> {}
}

declare module 'modal' {
  interface Props {
    onClose?: () => void;
    visible: boolean;
  }
  class Modal extends React.PureComponent<Props> {}
}

declare module 'popup-menu' {
  type Children = (dismiss: () => void) => React.ReactFragment;

  interface Props {
    children: Children;
    onHide?: () => void;
    onShow?: () => void;
  }

  class PopupMenu extends React.PureComponent<Props, any> {}
}

declare module 'react/beatmaps/search-content' {
  import AvailableFilters from 'beatmaps/available-filters';

  interface Props {
    availableFilters: AvailableFilters;
    backToTopAnchor: React.RefObject<{}>;
  }

  class SearchContent extends React.PureComponent<Props> {}
}

declare module 'report-form' {
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

declare module 'report-score' {
  interface Props {
    score: Score;
  }

  class ReportScore extends React.PureComponent<Props> {}
}

declare module 'report-user' {
  interface Props {
    modifiers?: string[];
    onFormClose?: () => void;
    user: User;
    wrapperClass?: string;
  }

  class ReportUser extends React.PureComponent<Props> {}
}

declare module 'react/beatmap-discussions/post' {
  class Post extends React.PureComponent<any> {}
}
