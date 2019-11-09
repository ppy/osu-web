/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

var trackingId = $('meta[name=ga-tracking-id]').attr('content');

if (trackingId !== undefined) {
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', trackingId, 'auto');
  ga('send', 'pageview');

  // turbolinks
  $(document).on('turbolinks:load', function() {
    ga('set', 'location', document.location.href);
    ga('send', 'pageview');
  });
};
