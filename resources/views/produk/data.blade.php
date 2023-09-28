<table class="table table-sm">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Produk</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produk as $prod)
        <tr>
            <th scope="row">{{ $i = (!isset($i)?1:++$i) }}</th>
            <td>{{ $prod->nama_produk }}</td>
            <td>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalFormProduk" data-mode="edit" data-id="{{  $prod->id }}" data-nama_produk="{{ $prod->nama_produk }}"><i class="fas fa-edit"></i></button>

                <form action="{{ route('produk.destroy', $prod) }}" method="post" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-delete" data-id="{{ $prod->id }}"><i class="fas fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>