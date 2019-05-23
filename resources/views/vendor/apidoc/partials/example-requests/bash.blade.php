<?php
    $authorization = '';

    if ($route['authenticated']) {
        $authorization .= '    -H "Authorization: Bearer {{token}}"';

        if(count($route['headers']) > 0) {
            $authorization .= ' \\';
        }
    }
?>
```bash
curl -X {{$route['methods'][0]}} {{$route['methods'][0] == 'GET' ? '-G ' : ''}}"{{ trim(config('app.docs_url') ?: config('app.url'), '/')}}/{{ ltrim($route['boundUri'], '/') }}" @if(count($route['headers']))\
{!! $authorization !!}
@foreach($route['headers'] as $header => $value)
    -H "{{$header}}: {{$value}}"@if(! ($loop->last) || ($loop->last && count($route['bodyParameters']))) \
@endif
@endforeach
@endif
@if(count($route['cleanBodyParameters']))
    -d '{!! json_encode($route['cleanBodyParameters']) !!}'
@endif

```
