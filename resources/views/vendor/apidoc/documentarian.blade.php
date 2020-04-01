{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
---
{!! $frontmatter !!}
---
<!-- START_INFO -->
{!! $infoText !!}
<!-- END_INFO -->
{!! $prependMd !!}
@foreach($parsedRoutes as $group => $routes)
@if($group)
#{!! $group !!}
@endif
@foreach($routes as $parsedRoute)
@if($writeCompareFile === true)
{!! $parsedRoute['output'] !!}
@else
{!! isset($parsedRoute['modified_output']) ? $parsedRoute['modified_output'] : $parsedRoute['output'] !!}
@endif
@endforeach
@endforeach{!! $appendMd !!}
