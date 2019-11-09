{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<footer class="no-print {{ class_with_modifiers('footer', $modifiers ?? []) }}">
    @if ($withLinks ?? true)
        <div class="footer__row">
            @foreach (footer_legal_links() as $action => $link)
                <a class="footer__link" href="{{ $link }}">
                    {{ trans("layout.footer.legal.{$action}") }}
                </a>
            @endforeach

            @foreach ($extraFooterLinks ?? [] as $label => $link)
                <a class="footer__link" href="{{ $link }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>
    @endif
    <div class="footer__row">ppy powered 2007-{{ date('Y') }}</div>

    <div class="js-sync-height--target" data-sync-height-id="permanent-fixed-footer"></div>
</footer>
