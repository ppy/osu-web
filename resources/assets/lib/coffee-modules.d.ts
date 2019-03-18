// importable coffeescript modules
declare module 'play-detail-menu' {
  interface PlayDetailMenuProps {
    items: (toggle: () => void) => React.ReactFragment;
    onHide?: () => void;
    onShow?: () => void;
  }

  class PlayDetailMenu extends React.PureComponent<PlayDetailMenuProps, any> {}
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
