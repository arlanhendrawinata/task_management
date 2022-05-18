<div class="text-center">
    <div class="card-header">
        <h4 class="card-title">Edit Category</h4>
    </div>
    <div class="card-body">
        <form class="form-valide" action="/editcategory{{ $category_clients->id }}" method="post">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-xl-12">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="nama_kategori">Category Name  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Masukkan Nama Kategori" value="{{ $category_clients->nama_kategori }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
