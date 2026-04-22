<x-gotime::nav.base @class(['navbar', $navClass ?? null])>
    <div class="flex-centered gap-05">
        <a href="{{ url('/') }}" class="flex">
            <img src="{{ asset('favicon.svg') }}" alt="{{ config('app.name') }}"class="bg-yellow-50 pxy-025 rounded"
                height="{{ config('gotime.logo.height') }}" width="{{ config('gotime.logo.width') }}">
        </a>
        <div class="txt-2 font-bold">{{ Str::upper(config('app.name')) }}</div>
    </div>
    <ul {{ $attributes->merge(['class' => 'menu']) }}>
        @foreach ($menuItems as $item)
            @php
                $active = $isActive($item->url);
                $order = $item->order ?? $loop->index;
                $icon = $withIcons && $item->icon ? $item->icon : null;
                $iconType = $withIcons && $item->iconType ? $item->iconType : null;
            @endphp
            @canany($item->permissions)
                @if ($item->hasChildren)
                    <li x-data="{ open: @js($open) }" class="relative order-{{ $order }}"
                        @mouseenter="open = true"
                        @mouseleave="open = false"
                        @click.outside="open = false"
                        @keydown.escape="open = false">
                        <x-gotime::nav.partials.parent-button :label="$item->name" :$active :$icon :$iconType />
                        <div x-show="open" x-collapse class="absolute flex min-w-12 z-higher">
                            <ul class="bx pxy-0 w-full flex-col gap-0 mx-0 mt-05">
                                @include('gotime::components.nav.partials.children', ['children' => $item->children])
                            </ul>
                        </div>
                    </li>
                @else
                    <li class="order-{{ $order }}">
                        <a href="{{ $item->url }}" {{ $active ? 'class="active"' : '' }}>
                            <x-gotime::icon-label :label="$item->name" :$icon :$iconType />
                        </a>
                    </li>
                @endif
            @endcanany
        @endforeach
    </ul>

    {{-- from hide to --}}
    {{-- <div class="hidden md:flex items-center gap-1">
        <a href="#" class="txt-sm font-medium txt-primary" href="{{ route('login') }}">Login</a>
        <a href="#" class="btn primary rounded-full" href="{{ route('register') }}">Register</a>
    </div> --}}

</x-gotime::nav.base>

{{-- <hr>

<nav class="bg-white bdr-b bdr-gray-200 sticky top-0 z-50">
    <div class="container px-1 sm:px-1.5 lg:px-2">
        <div class="flex justify-between h-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 flex items-center">
                    <div class="h-2.5 w-10 flex items-center txt-primary">
                        <span class="font-bold txt-xl text-upper tracking-tighter">Lacta-Edu</span>
                    </div>
                </div>
                <div class="hidden md:ml-2.5 md:flex space-x-2">
                    <a href="#"
                        class="bdr-b-2 bdr-primary txt-gray-900 inline-flex items-center px-0.25 pt-0.25 txt-sm font-medium">Home</a>
                    <a href="#courses"
                        class="txt-gray-500 hover:txt-primary inline-flex items-center px-0.25 pt-0.25 txt-sm font-medium">Courses</a>
                    <a href="#certification"
                        class="txt-gray-500 hover:txt-primary inline-flex items-center px-0.25 pt-0.25 txt-sm font-medium">IBLCE
                        Programs</a>
                    <a href="#"
                        class="txt-gray-500 hover:txt-primary inline-flex items-center px-0.25 pt-0.25 txt-sm font-medium">Resources</a>
                </div>
            </div>
            <div class="hidden md:flex items-center gap-1">
                <a href="#" class="txt-sm font-medium txt-primary">Login</a>
                <a href="#" class="btn primary px-1.25 py-0.5 rounded-full txt-sm font-bold">Enroll Now</a>
            </div>
            <div class="flex items-center md:hidden">
                <button @click="mobileMenu = !mobileMenu" class="txt-gray-500 hover:txt-primary">
                    <svg class="h-1.5 w-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!mobileMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="mobileMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div x-show="mobileMenu" class="md:hidden bg-white px-1 pt-0.5 pb-1.5 gap-0.25 bdr-t">
        <a href="#" class="block px-0.75 py-0.5 txt-base font-medium txt-primary">Courses</a>
        <a href="#" class="block px-0.75 py-0.5 txt-base font-medium txt-gray-600">IBLCE Programs</a>
        <a href="#" class="block px-0.75 py-0.5 txt-base font-medium txt-gray-600">Resources</a>
        <div class="pt-1 bdr-t bdr-gray-100">
            <a href="#" class="block tac btn primary px-1.25 py-0.75 rounded-lg font-bold">Enroll Now</a>
        </div>
    </div>
</nav> --}}
