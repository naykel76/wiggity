<x-gt-app-layout layout="{{ config('naykel.template') }}" :$pageTitle class="container py-2">
    <div class="flex space-between va-c">
        <h1>{{ $pageTitle ?? null }}</h1>
        <a href="{{ route('products.create') }}" class="btn primary">Create Product</a>
    </div>
    @if (session('success'))
        <x-gt-alert type="success">
            {{ session('success') }}
        </x-gt-alert>
    @endif
    @if ($products->count())
        <div class="grid md:cols-2">
            @foreach ($products as $product)
                <div class="bx pxy-1">
                    <div class="grid gap-0 cols-2" style="grid-template-columns: max-content auto;">
                        <span class="mr"><strong>Product Name:</strong> </span><span>{{ Str::limit($product->name, 50) }}</span>
                        <span class="mr"><strong>Product Code:</strong> </span><span>{{ $product->code }}</span>
                        <span class="mr"><strong>Date Created:</strong> </span><span>{{ $product->created_at }}</span>
                    </div>
                    <div class="flex space-x-05 ha-r">
                        <a href="{{ route('products.show', $product) }}" class="btn secondary xs">View</a>
                        <a href="{{ route('products.edit', $product) }}" class="btn primary xs">Edit</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn xs danger">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <x-gt-alert type="info">
            No products found. <a href="{{ route('products.create') }}">Create the first one!</a>
        </x-gt-alert>
    @endif
</x-gt-app-layout>
