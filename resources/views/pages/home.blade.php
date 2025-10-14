<x-gt-app-layout layout="{{ config('gotime.template') }}">

    <section class="bg-blue-950 py-5-3-2 txt-white">
        <div class="container-md tac">
            <h1 class="txt-3 ">Show, don't tell.</h1>
            <p class="lead">A living, action-based reference for building with Laravel Livewire and Gotime</p>
            <p class="lead fw6 mt-0">Real examples, no waffle, ready to copy, tweak, and ship.</p>
        </div>
    </section>

    <section class="py-3">
        <div class="container-lg">
            <livewire:products.index />
            <livewire:products.create-edit />
        </div>
    </section>

</x-gt-app-layout>
