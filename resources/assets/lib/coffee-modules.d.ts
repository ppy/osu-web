// importable coffeescript modules
declare module 'big-button' {
  class BigButton extends React.PureComponent<any> {}
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
  class Spinner extends React.PureComponent<any> {}
}
declare module 'user-avatar' {
  class UserAvatar extends React.PureComponent<any> {}
}

declare module 'comments' {
  class Comments extends React.PureComponent<any> {}
}

declare module 'comments-manager' {
  interface Props {
    commentableType: string
    commentableId: number
    commentBundle: any
    component: any
    componentProps: any
  }

  class CommentsManager extends React.PureComponent<Props> {}
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

declare module 'report-form' {
  interface ReportFormProps {
    allowOptions: boolean;
    completed: boolean;
    disabled: boolean;
    onClose: () => void;
    onSubmit: ({comments}: {comments: string}) => void;
    title: string;
    visible: boolean;
  }

  class ReportForm extends React.PureComponent<ReportFormProps, any> {}
}

declare module 'report-score' {
  interface Props {
    score: Score;
  }

  class ReportScore extends React.PureComponent<Props> {}
}
