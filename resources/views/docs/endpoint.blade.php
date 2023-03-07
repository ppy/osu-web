{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    /** @var Knuckles\Camel\Output\OutputEndpointData $endpoint */
    use App\Libraries\ApidocRouteHelper;

    $uri = $endpoint->uri;
    $methods = $endpoint->httpMethods;
    $descriptions = explode("\n---\n", $endpoint->metadata->description ?? '');

    $topDescription = $descriptions[0];
    $bottomDescription = $descriptions[1] ?? '';

    $isApiUri = substr($uri, 0, 6) === 'api/v2';
    // either remove api/v2 prefix or add full url
    $displayUri = $isApiUri ? substr($uri, 6) : config('app.url').$uri;

    $helper = ApidocRouteHelper::instance();
@endphp

@if ($showEndpointTitle ?? true)
<h2 id="{!! $endpoint->fullSlug() !!}">{{ $endpoint->name() }}</h2>
@endif

@if ($isApiUri)
<p>
    @if ($helper->getAuth($methods, $uri))
        <a href="#resource-owner" class="badge badge-scope badge-user">requires user</a>
    @endif

    @foreach($helper->getScopeTags($methods, $uri) as $scope)
        {{ ApidocRouteHelper::scopeBadge($scope) }}
    @endforeach
</p>
@endif

{!! Parsedown::instance()->text($topDescription) !!}

<span id="example-requests-{!! $endpoint->endpointId() !!}">
<blockquote>Example request:</blockquote>

@foreach($metadata['example_languages'] as $language)

<div class="{{ $language }}-example">
    @include("scribe::partials.example-requests.$language")
</div>

@endforeach
</span>

<span id="example-responses-{!! $endpoint->endpointId() !!}">
@if($endpoint->isGet() || $endpoint->hasResponses())
    @foreach($endpoint->responses as $response)
        <blockquote>
            <p>Example response ({{ $response->fullDescription() }}):</p>
        </blockquote>
        @if(count($response->headers))
        <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">@foreach($response->headers as $header => $value)
{{ $header }}: {{ is_array($value) ? implode('; ', $value) : $value }}
@endforeach </code></pre></details> @endif
        <pre>@if(is_string($response->content) && Str::startsWith($response->content, "<<binary>>"))
<code>[Binary data] - {{ htmlentities(str_replace("<<binary>>", "", $response->content)) }}</code>
@elseif($response->status == 204)
<code>[Empty response]</code>
@else
@php($parsed = json_decode($response->content))
{{-- If response is a JSON string, prettify it. Otherwise, just print it --}}
<code class="language-json" style="max-height: 300px;">{!! htmlentities($parsed != null ? json_encode($parsed, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : $response->content) !!}</code>
@endif </pre>
    @endforeach
@endif
</span>
<span id="execution-results-{{ $endpoint->endpointId() }}" hidden>
    <blockquote>Received response<span
                id="execution-response-status-{{ $endpoint->endpointId() }}"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-{{ $endpoint->endpointId() }}" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-{{ $endpoint->endpointId() }}" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-{{ $endpoint->endpointId() }}"></code></pre>
</span>
@if ($showRequestTitle ?? true)
<h3>Request</h3>
@endif
@foreach($endpoint->httpMethods as $method)
    <p>
        @component('scribe::components.badges.http-method', ['method' => $method])@endcomponent
        <b><code>{{ $displayUri }}</code></b>
    </p>
@endforeach
<form>
@if(count($endpoint->headers))
    <h4 class="fancy-heading-panel"><b>Headers</b></h4>
    @foreach($endpoint->headers as $name => $example)
        <?php
            $htmlOptions = [];
            if ($endpoint->isAuthed() && $metadata['auth']['location'] == 'header' && $metadata['auth']['name'] == $name) {
                $htmlOptions = [ 'class' => 'auth-value', ];
            }
        ?>
        <div style="padding-left: 28px; clear: unset;">
            @component('scribe::components.field-details', [
              'name' => $name,
              'type' => null,
              'required' => true,
              'description' => null,
              'example' => $example,
              'endpointId' => $endpoint->endpointId(),
              'component' => 'header',
              'isInput' => true,
              'html' => $htmlOptions,
            ])
            @endcomponent
        </div>
    @endforeach
@endif
@if(count($endpoint->urlParameters))
    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
    @foreach($endpoint->urlParameters as $attribute => $parameter)
        <div style="padding-left: 28px; clear: unset;">
            @component('scribe::components.field-details', [
              'name' => $parameter->name,
              'type' => $parameter->type ?? 'string',
              'required' => $parameter->required,
              'description' => $parameter->description,
              // TODO: show correct example (from $parameter->example)
              'example' => '',
              'endpointId' => $endpoint->endpointId(),
              'component' => 'url',
              'isInput' => true,
            ])
            @endcomponent
        </div>
    @endforeach
@endif
@if(count($endpoint->queryParameters))
    <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
    @foreach($endpoint->queryParameters as $attribute => $parameter)
        <?php
            $htmlOptions = [];
            if ($endpoint->isAuthed() && $metadata['auth']['location'] == 'query' && $metadata['auth']['name'] == $attribute) {
                $htmlOptions = [ 'class' => 'auth-value', ];
            }
        ?>
        <div style="padding-left: 28px; clear: unset;">
            @component('scribe::components.field-details', [
              'name' => $parameter->name,
              'type' => $parameter->type,
              'required' => $parameter->required,
              'description' => $parameter->description,
              // TODO: show correct example (from $parameter->example)
              'example' => '',
              'endpointId' => $endpoint->endpointId(),
              'component' => 'query',
              'isInput' => true,
              'html' => $htmlOptions,
            ])
            @endcomponent
        </div>
    @endforeach
@endif
@if(count($endpoint->nestedBodyParameters))
    <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
    <x-docs.nested-fields
            :fields="$endpoint->nestedBodyParameters" :endpointId="$endpoint->endpointId()"
    />
@endif
</form>

@if(count($endpoint->responseFields))
    <h3>Response</h3>
    <h4 class="fancy-heading-panel"><b>Response Fields</b></h4>
    <x-docs.nested-fields
            :fields="$endpoint->nestedResponseFields" :endpointId="$endpoint->endpointId()"
            :isInput="false"
    />
@endif

{!! Parsedown::instance()->text($bottomDescription) !!}
