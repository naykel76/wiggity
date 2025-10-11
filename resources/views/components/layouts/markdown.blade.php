<x-gt-app-layout layout="{{ config('naykel.template') }}" pageTitle="Markdown Page" class="container-md py-2">
    <x-gt-markdown path="{{ resource_path('views/' . $data['path']) }}" />
</x-gt-app-layout>
