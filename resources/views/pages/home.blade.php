<x-gt-app-layout layout="{{ config('gotime.template') }}" hasContainer class="py-5-3-2-2">

    <h1>{{ $pageTitle ?? null }}</h1>

    <div class="grid cols-3">
        <div class="bx dark txt-sm">
            <p>Use <code>$this->reset()</code> or set properties manually to reset form fields—calling <code>init()</code> again will not re-apply defaults.</p>
        </div>
    </div>

    <livewire:widget-index />
    <livewire:widget-create-edit />

</x-gt-app-layout>
