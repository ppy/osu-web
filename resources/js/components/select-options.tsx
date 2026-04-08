// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { action, autorun, isObservableSet, makeObservable, observable } from 'mobx';
import { disposeOnUnmount, observer } from 'mobx-react';
import * as React from 'react';
import { blackoutToggle } from 'utils/blackout';
import { classWithModifiers, Modifiers, ModifiersExtended } from 'utils/css';

const bn = 'select-options';

interface RenderableOption<T> {
  href: string;
  id: T | null;
  text: React.ReactNode;
}

interface Props<T> {
  blackout: boolean;

  href: string;
  modifiers?: Modifiers;
  // the callback should return the display state the selector should go into after the click, or undefined for the default.
  // the typing of id is to match dataset, so the component doesn't handle the parsing.
  onSelect?: (id?: string) => boolean | void;
  options: Iterable<RenderableOption<T>>;
  selected: RenderableOption<T>['id'] | Set<RenderableOption<T>['id']>;
  text: React.ReactNode;
}

@observer
export default class SelectOptions<T extends string | number> extends React.PureComponent<Props<T>> {
  static readonly defaultProps = { blackout: true };

  private readonly ref = React.createRef<HTMLDivElement>();
  @observable private showingSelector = false;

  constructor(props: Props<T>) {
    super(props);
    makeObservable(this);
    disposeOnUnmount(this, autorun(() => {
      blackoutToggle(this, this.props.blackout && this.showingSelector);
    }));
  }

  componentDidMount() {
    document.addEventListener('click', this.hideSelector);
  }

  componentWillUnmount() {
    document.removeEventListener('click', this.hideSelector);
    blackoutToggle(this, false);
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
          <a className={`${bn}__option`} href={this.props.href} onClick={this.toggleSelector}>
            {this.renderText(this.props.text)}
            <div className={`${bn}__decoration`}>
              <span className='fas fa-chevron-down' />
            </div>
          </a>
        </div>

        <div className={`${bn}__selector`}>
          {[...this.renderOptions()]}
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
  private readonly optionSelected = (event: React.MouseEvent<HTMLAnchorElement>) => {
    if (event.button !== 0) return;
    if (this.props.onSelect != null) {
      event.preventDefault();
      const id = event.currentTarget.dataset.id;
      this.showingSelector = this.props.onSelect(id) ?? false;
      if (this.showingSelector) {
        event.currentTarget.blur(); // deactivate element is selector if still open.
      }
    }
  };

  private renderOption(option: RenderableOption<T>, modifiers?: ModifiersExtended) {
    return (
      <a
        key={option.id}
        className={classWithModifiers(`${bn}__option`, modifiers)}
        data-id={option.id ?? undefined}
        href={option.href}
        onClick={this.optionSelected}
      >
        {this.renderText(option.text)}
      </a>
    );
  }

  private *renderOptions() {
    const isSet = this.props.selected instanceof Set || isObservableSet(this.props.selected);
    for (const option of this.props.options) {
      const selected = isSet
        ? this.props.selected.has(option.id)
        : this.props.selected === option.id;

      yield this.renderOption(option, { selected });
    }
  }

  private renderText(text: RenderableOption<T>['text']) {
    return typeof text === 'string' ? (
      <div className='u-ellipsis-overflow'>
        {text}
      </div>
    ) : text;
  }

  @action
  private readonly toggleSelector = (event: React.MouseEvent) => {
    if (event.button !== 0) return;

    event.preventDefault();
    this.showingSelector = !this.showingSelector;
  };
}
