<x-layouts.app title="Markdown Page">
    <div class="container-md py-2">
        <x-gt-markdown path="{{ resource_path('views/' . $data['path']) }}" />
    </div>
</x-layouts.app>

{{-- 
<x-layouts.app :$title>

    <section class="bg-blue-950 py-5-3-2 txt-white">
        <div class="container-md tac">
            <h1 class="txt-3 ">Show, don't tell.</h1>
            <p class="lead">A living, action-based reference for building with Laravel Livewire and Gotime</p>
            <p class="lead fw6 mt-0">Real examples, no waffle, ready to copy, tweak, and ship.</p>
        </div>
    </section>

</x-layouts.app> --}}
