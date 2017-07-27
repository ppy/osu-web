@extends('master')

@section('content')


<script>
    var options = {
        access_token: "{{ $token }}", //TODO use access token, received on previous step
        sandbox: true //TODO please do not forget to remove this setting when going live
    };
    var s = document.createElement('script');
    s.type = "text/javascript";
    s.async = true;
    s.src = "https://static.xsolla.com/embed/paystation/1.0.7/widget.min.js";
    s.addEventListener('load', function (e) {
        XPayStationWidget.init(options);
    }, false);
    var head = document.getElementsByTagName('head')[0];
    head.appendChild(s);
</script>

<button data-xpaystation-widget-open>Buy Credits</button>
@endsection
