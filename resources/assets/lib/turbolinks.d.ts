// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare module 'turbolinks' {
  interface Controller {
    advanceHistory(url: string): void;
    currentVisit?: Visit;
  }

  interface Location {
    absoluteURL: string;
  }

  interface TurbolinksAction {
    action: 'advance' | 'replace' | 'restore';
  }

  interface TurbolinksLocation {
    getPath(): string;
    isHTML(): boolean;
  }

  interface Visit {
    location: Location;
    redirectedToLocation?: Location;
  }

  export default interface TurbolinksStatic {
    clearCache(): void;
    controller: Controller;
    setProgressBarDelay(delayInMilliseconds: number): void;
    supported: boolean;
    uuid(): string;
    visit(location: string, options?: TurbolinksAction): void;
  }
}
