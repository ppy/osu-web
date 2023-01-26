// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { action, observable, makeObservable, reaction } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { blackoutToggle } from 'utils/blackout';
import { classWithModifiers, Modifiers } from 'utils/css';

const bn = 'select-options';

export interface Option<T = string> {
  id: T | null;
  text: string;
}

export interface OptionRenderProps<T = string> {
  children: React.ReactNode;
  cssClasses: string;
  onClick: (event: React.SyntheticEvent) => void;
  option: Option<T>;
}

interface ComponentOptionRenderProps<T = string> {
  children: OptionRenderProps<T>['children'];
  onClick: OptionRenderProps<T>['onClick'];
  option: OptionRenderProps<T>['option'];
  selected?: boolean;
}

interface Props<T> {
  blackout?: boolean;
  modifiers: Modifiers;
  onChange: (option: Option<T>) => void;
  options: Option<T>[];
  renderOption?(props: OptionRenderProps<T>): JSX.Element;
  selected: Option<T>;
}

@observer
export default class SelectOptions<T = string> extends React.Component<Props<T>> {
  static readonly defaultProps = { blackout: true };

  private readonly blackoutAutoToggleDisposer;
  private readonly ref = React.createRef<HTMLDivElement>();
  @observable private showingSelector = false;

  constructor(props: Props<T>) {
    super(props);
    makeObservable(this);
    this.blackoutAutoToggleDisposer = reaction(
      () => this.showingSelector,
      (showing: typeof this.showingSelector) => {
        blackoutToggle(showing, 0.5);
      },
    );
  }

  componentDidMount() {
    document.addEventListener('click', this.hideSelector);
  }

  componentWillUnmount() {
    document.removeEventListener('click', this.hideSelector);
    this.blackoutAutoToggleDisposer();
  }

  render() {
    const className = classWithModifiers(
      bn,
      { selecting: this.showingSelector },
      this.props.modifiers,
    );

    return (
      <div ref={this.ref} className={className}>
        <div className={`${bn}__select`}>
          {this.renderOption({
            children: (
              <>
                <div className='u-ellipsis-overflow'>
                  {this.props.selected?.text}
                </div>

                <div className={`${bn}__decoration`}>
                  <span className='fas fa-chevron-down' />
                </div>
              </>
            ),
            onClick: this.toggleSelector,
            option: this.props.selected,
          })}
        </div>

        <div className={`${bn}__selector`}>
          {this.renderOptions()}
        </div>
      </div>
    );
  }

  // dismiss the selector if clicking anywhere outside of it.
  @action
  private readonly hideSelector = (e: MouseEvent) => {
    if (e.button === 0 && this.ref.current != null && !e.composedPath().includes(this.ref.current)) {
      this.showingSelector = false;
    }
  };

  @action
  private readonly optionSelected = (event: React.MouseEvent, option: Option<T>) => {
    if (event.button !== 0) return;

    event.preventDefault();
    this.showingSelector = false;
    this.props.onChange?.(option);
  };

  private renderOption({ children, onClick, option, selected = false }: ComponentOptionRenderProps<T>) {
    const cssClasses = classWithModifiers(`${bn}__option`, { selected });

    if (this.props.renderOption != null) {
      return this.props.renderOption({ children, cssClasses, onClick, option });
    }

    return (
      <a
        key={typeof option.id === 'string' ? option.id : ''}
        className={cssClasses}
        href='#'
        onClick={onClick}
      >
        {children}
      </a>
    );
  }

  private renderOptions() {
    return this.props.options.map((option) => this.renderOption({
      children: (
        <div className='u-ellipsis-overflow'>
          {option.text}
        </div>
      ),
      onClick: (event: React.MouseEvent) => {
        this.optionSelected(event, option);
      },
      option,
      selected: this.props.selected?.id === option.id,
    }));
  }

  @action
  private readonly toggleSelector = (event: React.MouseEvent) => {
    if (event.button !== 0) return;

    event.preventDefault();
    this.showingSelector = !this.showingSelector;
  };
}
