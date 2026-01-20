<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border=0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="{{ route('products.store') }}" class="font-weight-bold">Image</label>
                                <input type="file" class="form-control
                                @error('image') is-invalid
                                @enderror" name="image">

                                @error('image')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="font-weight-bold">Title</label>
                                <input type="text" class="form-control
                                @error('title') is-invalid
                                @enderror" name="title" 
                                value="{{ old('title', $product->title) }}" 
                                placeholder="Masukan Judul">

                                @error('title')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="font-weight-bold">Description</label>
                                <textarea type="text" class="form-control
                                @error('description') is-invalid
                                @enderror" name="description" 
                                rows="5" value="{{ old('description', $product->stock) }}" 
                                placeholder="Masukan Deskripsi">{{ old('description') }}</textarea>

                                @error('description')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="" class="font-weight-bold">Price</label>
                                        <input type="text" class="form-control
                                        @error('price') is-invalid
                                        @enderror" name="price" 
                                        value="{{ old('price', $product->price) }}" 
                                        placeholder="Masukan Harga">

                                        @error('price')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="" class="font-weight-bold">Stock</label>
                                        <input type="text" class="form-control
                                        @error('stock') is-invalid
                                        @enderror" name="stock" 
                                        value="{{ old('stock'$product->stock) }}" 
                                        placeholder="Masukan Stok">

                                        @error('price')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-md btn-primary mt-3">Update</button>
                            <button type="reset" class="btn btn-md btn-warning mt-3">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
  </body>
</html>