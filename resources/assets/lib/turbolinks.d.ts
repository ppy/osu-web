// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare module 'turbolinks' {
  interface TurbolinksAction {
    action: 'advance' | 'replace' | 'restore';
  }

  interface TurbolinksLocation {
    getPath(): string;
    isHTML(): boolean;
  }

  export default interface TurbolinksStatic {
    controller: any;
    supported: boolean;

    clearCache(): void;
    setProgressBarDelay(delayInMilliseconds: number): void;
    uuid(): string;
    visit(location: string, options?: TurbolinksAction): void;
  }
}
