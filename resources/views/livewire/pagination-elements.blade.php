@php
    if (!isset($scrollTo)) {
        $scrollTo = 'body';
    }

    $scrollIntoViewJsSnippet = $scrollTo !== false ? "(\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()" : '';
@endphp

<div id="show-results-message" class="bx bdr-blue">
    <div class="bx-title txt-blue">Show Results Message</div>
    <p>Place the results message <strong>outside</strong> the <code>$paginator->hasPages()</code> condition to display it on all pages, including single-page results.</p>
    <div>
        <p class="txt-sm">
            Showing <span class="fw6">{{ $paginator->firstItem() }}</span>
            to <span class="fw6">{{ $paginator->lastItem() }}</span>
            of <span class="fw6">{{ $paginator->total() }}</span> results
        </p>
    </div>
    <!-- prettier-ignore-start -->
    <pre><x-torchlight-code language="blade">@verbatim
        <p class="txt-sm">
            Showing <span class="fw6">{{ $paginator->firstItem() }}</span>
            to <span class="fw6">{{ $paginator->lastItem() }}</span>
            of <span class="fw6">{{ $paginator->total() }}</span> results
        </p>

        @if ($paginator->hasPages())
            <!-- Pagination Links Here -->
        @endif
    @endverbatim </x-torchlight-code></pre>
    <!-- prettier-ignore-end -->
</div>

<div id="next-and-previous-buttons" class="bx bdr-blue space-y">
    <div class="bx-title txt-blue">Next and Previous Buttons</div>
    <div>
        <div>
            @if ($paginator->hasPages())
                <div class="flex gap-025">
                    {{-- Previous --}}
                    @if ($paginator->onFirstPage())
                        <button type="button" class="btn sm" disabled> Previous </button>
                    @else
                        <button wire:click="previousPage('{{ $paginator->getPageName() }}')"
                            x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled"
                            type="button" class="btn sm"> Previous </button>
                    @endif
                    {{-- Next --}}
                    @if ($paginator->hasMorePages())
                        <button wire:click="nextPage('{{ $paginator->getPageName() }}')"
                            x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled"
                            type="button" class="btn sm"> Next </button>
                    @else
                        <button type="button" class="btn sm" disabled> Next </button>
                    @endif
                </div>
            @endif
        </div>
        <!-- prettier-ignore-start -->
        <pre><x-torchlight-code language="blade">@verbatim
            @if ($paginator->hasPages())
                <div class="flex gap-025">
                    {{-- Previous --}}
                    @if ($paginator->onFirstPage())
                        <button type="button" class="btn sm" disabled> Previous </button>
                    @else
                        <button wire:click="previousPage('{{ $paginator->getPageName() }}')"
                            x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled"
                            type="button" class="btn sm"> Previous </button>
                    @endif
                    {{-- Next --}}
                    @if ($paginator->hasMorePages())
                        <button wire:click="nextPage('{{ $paginator->getPageName() }}')"
                            x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled"
                            type="button" class="btn sm"> Next </button>
                    @else
                        <button type="button" class="btn sm" disabled> Next </button>
                    @endif
                </div>
            @endif
        @endverbatim </x-torchlight-code></pre>
        <!-- prettier-ignore-end -->
    </div>
    <div>
        <div class="bx-title txt-blue">Icon Only</div>
        @if ($paginator->hasPages())
            <div class="flex gap-3 items-center">

                {{-- Icons Only --}}
                <div class="flex gap-025">
                    {{-- Previous Icon --}}
                    <div class="inline-flex">
                        @if ($paginator->onFirstPage())
                            <button type="button" class="btn wh-2.5 sm" disabled aria-label="Previous page">
                                <svg class="icon txt-muted" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        @else
                            <button wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}"
                                type="button" class="btn wh-2.5 sm" aria-label="Previous page">
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        @endif
                    </div>
                    {{-- Next Icon --}}
                    <div class="inline-flex">
                        @if ($paginator->hasMorePages())
                            <button wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}"
                                type="button" class="btn wh-2.5 sm" aria-label="Next page">
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        @else
                            <button type="button" class="btn wh-2.5 sm" disabled aria-label="Next page">
                                <svg class="icon txt-muted" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- prettier-ignore-start -->
    <pre><x-torchlight-code language="blade">@verbatim
        @if ($paginator->hasPages())
            <div class="flex gap-025">
                {{-- Previous Icon --}}
                <div class="inline-flex">
                    @if ($paginator->onFirstPage())
                        <button type="button" class="btn wh-2.5 sm" disabled aria-label="Previous page">
                            <svg class="txt-muted" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    @else
                        <button wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}"
                            type="button" class="btn wh-2.5 sm" aria-label="Previous page">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    @endif
                </div>
                {{-- Next Icon --}}
                <div class="inline-flex">
                    @if ($paginator->hasMorePages())
                        <button wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}"
                            type="button" class="btn wh-2.5 sm" aria-label="Next page">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    @else
                        <button type="button" class="btn wh-2.5 sm" disabled aria-label="Next page">
                            <svg class="txt-muted" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    @endif
                </div>
            </div>
        @endif
    @endverbatim </x-torchlight-code></pre>
    <!-- prettier-ignore-end -->
</div>

<div class="bx bdr-blue">
    <div class="bx-title txt-blue">Page Elements</div>
    <div>
        <div>
            @if ($paginator->hasPages())
                <div>
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <button type="button" class="btn wh-2.5 sm" disabled>{{ $element }}</button>
                            </span>
                        @endif
                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                <span wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}">
                                    @if ($page == $paginator->currentPage())
                                        <button type="button" class="btn wh-2.5 sm" disabled>{{ $page }}</button>
                                    @else
                                        <button wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                                            x-on:click="{{ $scrollIntoViewJsSnippet }}" aria-label="Go to page {{ $page }}"
                                            type="button" class="btn wh-2.5 sm"> {{ $page }} </button>
                                    @endif
                                </span>
                            @endforeach
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <!-- prettier-ignore-start -->
    <pre><x-torchlight-code language="blade">@verbatim

    @endverbatim </x-torchlight-code></pre>
    <!-- prettier-ignore-end -->
</div>
