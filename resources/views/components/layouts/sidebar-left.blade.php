<x-layouts.base :title="$title ?? null">

    {{-- @includeFirst(['components.layouts.partials.navbar', 'gotime::components.layouts.partials.navbar']) --}}

    {{ $slot }}

</x-layouts.base>
