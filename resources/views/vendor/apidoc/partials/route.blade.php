{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<?php
    use App\Libraries\ApidocRouteHelper;

    $uri = $route['uri'];
    $methods = $route['methods'];
    $descriptions = explode("\n---\n", $route['metadata']['description'] ?? '');

    $topDescription = $descriptions[0];
    $bottomDescription = $descriptions[1] ?? '';

    $displayUri = substr($uri, strlen('api/v2'));

    $helper = ApidocRouteHelper::instance();
?>
<!-- START_{{$route['id']}} -->
@if($route['metadata']['title'] != '')## {{ $route['metadata']['title']}}
@else## {{$uri}}@endif

@foreach($settings['languages'] as $language)
@include("apidoc::partials.example-requests.$language")

@endforeach

@if(in_array('GET',$methods) || (isset($route['showresponse']) && $route['showresponse']))
@if(is_array($route['responses']))
@foreach($route['responses'] as $response)
> Example response ({{$response['status']}}):

```json
@if(is_object($response['content']) || is_array($response['content']))
{!! json_encode($response['content'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
@else
{!! json_encode(json_decode($response['content']), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
@endif
```
@endforeach
@else
> Example response:

```json
@if(is_object($route['responses']) || is_array($route['responses']))
{!! json_encode($route['response'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
@else
{!! json_encode(json_decode($route['responses']), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
@endif
```
@endif
@endif

{!! $topDescription !!}

<span class="scope-list">
    @foreach($helper->getScopeTags($methods, $uri) as $scope)
        {{ ApidocRouteHelper::scopeBadge($scope) }}
    @endforeach
</span>

### HTTP Request
@foreach($methods as $method)
`{{$method}} {{ $displayUri }}`

@endforeach
@if(count($route['urlParameters']))
#### URL Parameters

Parameter | Status | Description
--------- | ------ | -----------
@foreach($route['urlParameters'] as $attribute => $parameter)
    {{ $attribute }} | @if($parameter['required']) required @else optional @endif | {!! $parameter['description'] !!}
@endforeach
@endif
@if(count($route['bodyParameters']))
#### Body Parameters

Parameter | Type | Status | Description
--------- | ---- | ------ | -----------
@foreach($route['bodyParameters'] as $attribute => $parameter)
    {{$attribute}} | {{$parameter['type']}} | @if($parameter['required']) required @else optional @endif | {!! $parameter['description'] !!}
@endforeach
@endif
@if(count($route['queryParameters']))
#### Query Parameters

Parameter | Status | Description
--------- | ------ | -----------
@foreach($route['queryParameters'] as $attribute => $parameter)
    {{$attribute}} | @if($parameter['required']) required @else optional @endif | {!! $parameter['description'] !!}
@endforeach
@endif

{!! $bottomDescription !!}

<!-- END_{{$route['id']}} -->
