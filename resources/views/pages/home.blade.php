<x-gt-app-layout layout="{{ config('gotime.template') }}" hasContainer class="py-5-3-2-2">

    <div class="grid cols-3">
        <div class="bx dark txt-sm">
            <p>Use <code>$this->reset()</code> or set properties manually to reset form fields—calling <code>init()</code> again will not re-apply defaults.</p>
        </div>
    </div>

    <ul>
        <li>Convert empty strings to null in the model to avoid validation issues with empty selects.</li>
    </ul>
    <ul>
        <li>It is best to have a pagination property to make testing easier.</li>
    </ul>

    <livewire:widget-index />
    <livewire:widget-create-edit />

</x-gt-app-layout>
