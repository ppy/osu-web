{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@if($deadline)
  <div class='contest__countdown-timer'>
    <div class='js-react--countdownTimer' data-deadline='{{json_time($deadline)}}'></div>
  </div>
@endif
