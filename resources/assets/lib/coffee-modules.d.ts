// importable coffeescript modules
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
