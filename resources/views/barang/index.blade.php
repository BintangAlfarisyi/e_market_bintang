@extends('templates.layout')

@push('style')

@endpush

@section('content')
<div>
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Barang</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error )
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <button type="button" class="btn btn-primary btn-block btn-sm" style="width:120;" data-toggle="modal" data-target="#modalFormBarang">
                Tambah Barang
            </button>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode Barang</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Satuan</th>
                        <th scope="col">Harga Jual</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Ditarik</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Produk ID</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barang as $brg)
                    <tr>
                        <th scope="row">{{ $i = (!isset($i)?1:++$i) }}</th>
                        <td>{{ $brg->kode_barang }}</td>
                        <td>{{ $brg->nama_barang }}</td>
                        <td>{{ $brg->satuan }}</td>
                        <td>{{ $brg->harga_jual }}</td>
                        <td>{{ $brg->stok }}</td>
                        <td>{{ $brg->ditarik }}</td>
                        <td>{{ $brg->user_id }}</td>
                        <td>{{ $brg->produk_id }}</td>
                        <td>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalFormBarang" data-mode="edit" data-id="{{  $brg->id }}" data-nama_barang="{{ $brg->nama_barang }}" data-kode_barang="{{ $brg->kode_barang }}" data-satuan="{{ $brg->satuan }}" data-harga_jual="{{ $brg->harga_jual }}" data-stok="{{ $brg->stok }}" data-ditarik="{{ $brg->ditarik }}" data-user_id="{{ $brg->user_id }}" data-produk_id="{{ $brg->produk_id }}"><i class="fas fa-edit"></i></button>

                            <form action="{{ route('barang.destroy', $brg) }}" method="post" style="display: inline;">
                            @csrf
                            @method('DELETE')
                                <button type="button" class="btn btn-danger btn-delete" data-id="{{ $brg->id }}"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            Footer
        </div>
    </section>
</div>
@endsection

@include('barang.form')

@push('script')
<script>
    $('.alert-success').fadeTo(2000, 500).slideUp(500, function() {
        $('.alert-success').slideUp(500)
    })

    $('.alert-danger').fadeTo(2000, 500).slideUp(500, function() {
        $('.alert-danger').slideUp(500)
    })

    $(function() {
    $('#tbl-barang').DataTable()

    // dialog hapus data
    $('.btn-delete').on('click', function(e) {
        let nama_barang = $(".barang" + $(this).attr('data-id')).text()
        console.log(nama_barang)
        Swal.fire({
            icon: 'error',
            title: 'Hapus Data',
            html: `Apakah data <b> ${nama_barang} </b> akan dihapus?`,
            confirmButtonText: 'Ya',
            denyButtonText: 'Tidak',
            showDenyButton: true,
            focusConfirm: false
        }).then((result) => {
            if (result.isConfirmed) $(e.target).closest('form').submit()
            else swal.close()
        })
    })
     // Update or input
    $('#modalFormBarang').on('show.bs.modal', function(e){
        const btn = $(e.relatedTarget)
        const modal = $(this)
        const mode = btn.data('mode')
        const id = btn.data('id')
        const nama_barang = btn.data('nama_barang')
        const kode = btn.data('kode_barang')
        const satuan = btn.data('satuan')
        const harga = btn.data('harga_jual')
        const stok = btn.data('stok')
        const ditarik = btn.data('ditarik')
        const user = btn.data('user_id')
        const produk = btn.data('produk_id')

        // Membedakan Input Atau Edit
        if(mode === 'edit'){
            modal.find('.modal-title').text('Edit Data')
            modal.find('#nama_barang').val(nama_barang)
            modal.find('#kode_barang').val(kode)
            modal.find('#satuan').val(satuan)
            modal.find('#harga_jual').val(harga)
            modal.find('#stok').val(stok)
            modal.find('#ditarik').val(ditarik)
            modal.find('#user_id').val(user)
            modal.find('#produk_id').val(produk)
            modal.find('#method').html('@method("PATCH")')
            modal.find('form').attr('action',`{{ url('barang') }}/${id}`)
        }else{
            modal.find('.modal-title').text('Form barang')
            modal.find('#nama_barang').val('')
            modal.find('#method').html('')
            modal.find('form').attr('action','{{ url("barang") }}')
        }
    })
    $('#modalFormBarang').on('shown.bs.modal', function(){
        $('#nama_barang').delay(1000).focus().select();
    })
})


</script>
@endpush