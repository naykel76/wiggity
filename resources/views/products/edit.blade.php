<x-gt-app-layout layout="{{ config('naykel.template') }}" :$pageTitle class="container py-2">
    <div class="flex space-between va-c">
        <h1>{{ $pageTitle ?? null }}</h1>
        <div>
            <a href="{{ route('products.show', $product) }}" class="btn sm primary">View Product</a>
            <a href="{{ route('products.index') }}" class="btn sm dark">Back to Products</a>
        </div>
    </div>
    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')

        <x-gotime::v2.input.partials.form-row>
            <x-gotime::v2.input.partials.label for="name" label="Product Name" />
            <x-gotime::v2.input.controls.input for="name" value="{{ old('name', $product->name) }}" />
            <x-gotime::v2.input.partials.error for="name" />
        </x-gotime::v2.input.partials.form-row>

        <x-gotime::v2.input.partials.form-row>
            <x-gotime::v2.input.partials.label for="code" label="Product Code" />
            <x-gotime::v2.input.controls.input for="code" value="{{ old('code', $product->code) }}" />
            <x-gotime::v2.input.partials.error for="code" />
        </x-gotime::v2.input.partials.form-row>

        <x-gotime::v2.input.partials.form-row>
            <x-gotime::v2.input.partials.label for="description" label="Description" />
            <textarea id="description" name="description" rows="4">{{ old('description', $product->productDetail?->description) }}</textarea>
            <x-gotime::v2.input.partials.error for="description" />
        </x-gotime::v2.input.partials.form-row>

        <div class="tar">
            <button type="submit" class="btn primary">Update Product</button>
            <a href="{{ route('products.show', $product) }}" class="btn">Cancel</a>
        </div>
    </form>
</x-gt-app-layout>
