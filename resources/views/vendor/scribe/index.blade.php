{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
---
{!! $frontmatter !!}
---
@include('docs.info')

<style>
    .badge.badge-scope {
        font-size: 80%;
        text-decoration: none;
        background: #87ad3a;
    }
    .badge.badge-scope-lazer {
        background: #ba6436;
    }
    .badge.badge-scope-oauth {
        background: #3a87ad;
    }
    .content table tr:nth-child(2n+1) > td {
        background: rgba(0, 0, 0, 0.02);
    }
    .content table td {
        padding-top: 5px;
        padding-bottom: 5px;
    }
    .logo {
        max-width: 70%;
        margin: auto;
    }
</style>

@if($isInteractive)
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>
<script>
    var baseUrl = "{{ $baseUrl }}";
</script>
<script src="js/tryitout-{{ \Knuckles\Scribe\Tools\Globals::SCRIBE_VERSION }}.js"></script>
@endif
