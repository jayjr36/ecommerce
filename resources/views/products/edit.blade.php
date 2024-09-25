<div class="mb-3">
    <label for="name" class="form-label">Product Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
</div>
<div class="mb-3">
    <label for="quantity" class="form-label">Quantity</label>
    <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $product->quantity }}" required>
</div>
<div class="mb-3">
    <label for="price" class="form-label">Price</label>
    <input type="text" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
</div>
<div class="mb-3">
    <label for="category_id" class="form-label">Category</label>
    <select class="form-control" id="category_id" name="category_id" required>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
    </select>
</div>
