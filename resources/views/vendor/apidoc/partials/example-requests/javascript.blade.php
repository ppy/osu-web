{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
```javascript
const url = new URL("{{ rtrim(config('app.docs_url') ?: config('app.url'), '/') }}/{{ ltrim($route['boundUri'], '/') }}");
@if(count($route['queryParameters']))

let params = {
@foreach($route['queryParameters'] as $attribute => $parameter)
@if (present($parameter['value']))
    "{{ $attribute }}": "{{ $parameter['value'] }}",
@endif
@endforeach
};
Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));
@endif

let headers = {
@if($route['metadata']['authenticated'])
    "Authorization": "Bearer @{{token}}"
@endif
@foreach($route['headers'] as $header => $value)
    "{{$header}}": "{{$value}}",
@endforeach
@if(!array_key_exists('Accept', $route['headers']))
    "Accept": "application/json",
@endif
@if(!array_key_exists('Content-Type', $route['headers']))
    "Content-Type": "application/json",
@endif
}
@if(count($route['bodyParameters']))

let body = {!! json_encode($route['cleanBodyParameters'], JSON_PRETTY_PRINT) !!}
@endif

fetch(url, {
    method: "{{$route['methods'][0]}}",
    headers: headers,
@if(count($route['bodyParameters']))
    body: body
@endif
})
.then(response => response.json())
.then(json => console.log(json));
```
