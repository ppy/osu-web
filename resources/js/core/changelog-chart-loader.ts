// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ChangelogChart from 'charts/changelog-chart';

export default class ChangelogChartLoader {
  private chart: ChangelogChart | null = null;

  constructor() {
    document.addEventListener('turbo:load', this.initialize);
    document.addEventListener('turbo:before-cache', this.reset);
  }

  private readonly initialize = () => {
    const container = document.querySelector('.js-changelog-chart');

    if (!(container instanceof HTMLElement)) return;

    // reset existing chart
    container.innerHTML = '';

    this.chart = new ChangelogChart(container);
    this.chart.loadData();
    window.addEventListener('resize', this.resize);
  };

  private readonly reset = () => {
    this.chart = null;
    window.removeEventListener('resize', this.resize);
  };

  private readonly resize = () => {
    this.chart?.resize();
  };
}
