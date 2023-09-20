{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<script data-turbolinks-eval="always">
    var csrf = "{{ csrf_token() }}";
    var canonicalUrl = "{{ $canonicalUrl ?? '' }}";
</script>

@include ('layout._current_user')
