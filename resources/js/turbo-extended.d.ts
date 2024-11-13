// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import '@hotwired/turbo';

declare module '@hotwired/turbo' {
  type LocationOrURL = Location | URL;

  interface FormSubmission {
    formElement: HTMLFormElement;
  }

  interface PageSnapshot {
    clone(): PageSnapshot;
  }

  interface SnapshotCache {
    put(location: LocationOrURL, snapshot: PageSnapshot): void;
  }

  interface TurboGlobal {
    cache: {
      clear(): void;
    };
    config: {
      drive: {
        progressBarDelay: number;
      };
    };
  }

  interface TurboHistory {
    push(location: LocationOrURL, uuid: string): void;
    replace(location: LocationOrURL, uuid: string): void;
  }

  interface TurboSession {
    history: TurboHistory;
    navigator: {
      currentVisit?: {
        location: LocationOrURL;
        redirectedToLocation?: LocationOrURL;
      };
      rootLocation: LocationOrURL;
    };
    view: {
      lastRenderedLocation: LocationOrURL;
      snapshot: PageSnapshot;
      snapshotCache: SnapshotCache;
    };
  }
}
