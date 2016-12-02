@if($deadline)
  <div class='contest__countdown-timer'>
    <div class='js-react--countdownTimer' data-deadline='{{json_time($deadline)}}'></div>
  </div>
@endif
