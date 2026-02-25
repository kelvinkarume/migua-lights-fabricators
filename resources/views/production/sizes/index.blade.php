@extends('layouts.public')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">📦 Manage Product Sizes</h2>

        {{-- BACK BUTTON ONLY --}}
        <a href="{{ route('production.dashboard') }}" class="btn btn-secondary btn-sm">
            ← Back to Dashboard
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($productTypes as $type)
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-dark text-white">
                    {{ strtoupper(str_replace('_', ' ', $type->name)) }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('production.sizes.store') }}">
                        @csrf
                        <input type="hidden" name="product_type_id" value="{{ $type->id }}">
                        <input type="number" name="price" class="form-control" placeholder="Enter price" required>

                        <div class="input-group mb-3">
                            <input type="text" name="size" class="form-control"
                                   placeholder="e.g 12x12 or 4x4x4" required>
                            <button class="btn btn-success">Add Size</button>
                        </div>
                    </form>

                    <ul class="list-group">
                        @forelse($type->sizes as $size)
                            <li class="list-group-item d-flex justify-content-between">
                                {{ $size->size }}
                                <a href="{{ route('production.sizes.delete', $size->id) }}"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Delete this size?')">
                                   Delete
                                </a>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">No sizes added yet</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection
