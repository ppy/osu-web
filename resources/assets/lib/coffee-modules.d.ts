// importable coffeescript modules
declare module 'popup-menu' {
  interface PopupMenuProps {
    items: (toggle: () => void) => React.ReactFragment;
    onHide?: () => void;
    onShow?: () => void;
  }

  class PopupMenu extends React.PureComponent<PopupMenuProps, any> {}
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
