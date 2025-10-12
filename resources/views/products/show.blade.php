<x-gt-app-layout layout="{{ config('naykel.template') }}" :$pageTitle class="container py-2">
    <div class="flex space-between va-c">
        <h1>{{ $pageTitle ?? null }}</h1>
        <div>
            <a href="{{ route('products.edit', $product) }}" class="btn sm primary">Edit Product</a>
            <a href="{{ route('products.index') }}" class="btn sm dark">Back to Products</a>
        </div>
    </div>
    <div class="bx">
        <div class="grid gap-0 cols-2" style="grid-template-columns: max-content auto;">
            <span class="mr"><strong>ID:</strong> </span><span>{{ $product->id }}</span>
            <span class="mr"><strong>Product Name:</strong> </span><span>{{ Str::limit($product->name, 50) }}</span>
            <span class="mr"><strong>Product Code:</strong> </span><span>{{ $product->code }}</span>
        </div>
    </div>
</x-gt-app-layout>
