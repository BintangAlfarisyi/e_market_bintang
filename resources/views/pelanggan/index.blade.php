    @extends('templates.layout')

    @push('style')

    @endpush

    @section('content')
    <div>
        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pelanggan</h3>

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
                <button type="button" class="btn btn-primary btn-block btn-sm" style="width:150;" data-toggle="modal" data-target="#modalFormPelanggan">
                    Tambah Pelanggan
                </button>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode Pelanggan</th>
                            <th scope="col">Nama Pelanggan</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Ponsel</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pelanggan as $pel)
                        <tr>
                            <th scope="row">{{ $i = (!isset($i)?1:++$i) }}</th>
                            <td>{{ $pel->kode_pelanggan }}</td>
                            <td>{{ $pel->nama_pelanggan }}</td>
                            <td>{{ $pel->alamat }}</td>
                            <td>{{ $pel->no_telp }}</td>
                            <td>{{ $pel->email }}</td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalFormPelanggan" data-mode="edit" data-id="{{  $pel->id }}" data-nama_pelanggan="{{ $pel->nama_pelanggan }}" data-kode_pelanggan="{{ $pel->kode_pelanggan }}" data-alamat="{{ $pel->alamat }}" data-no_telp="{{ $pel->no_telp }}" data-email="{{ $pel->email }}"><i class="fas fa-edit"></i></button>

                                <form action="{{ route('pelanggan.destroy', $pel) }}" method="post" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-delete" data-id="{{ $pel->id }}"><i class="fas fa-trash"></i></button>
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

    @include('pelanggan.form')

    @push('script')
    <script>
        $('.alert-success').fadeTo(2000, 500).slideUp(500, function() {
            $('.alert-success').slideUp(500)
        })

        $('.alert-danger').fadeTo(2000, 500).slideUp(500, function() {
            $('.alert-danger').slideUp(500)
        })

        $(function() {
        $('#tbl-Pelanggan').DataTable()

        // dialog hapus data
        $('.btn-delete').on('click', function(e) {
            let nama = $(".Pelanggan" + $(this).attr('data-id')).text()
            console.log(nama)
            Swal.fire({
                icon: 'error',
                title: 'Hapus Data',
                html: `Apakah data <b> ${nama} </b> akan dihapus?`,
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
        $('#modalFormPelanggan').on('show.bs.modal', function(e){
            const btn = $(e.relatedTarget)
            const modal = $(this)
            const mode = btn.data('mode')
            const id = btn.data('id')
            const nama = btn.data('nama_pelanggan')
            const kode = btn.data('kode_pelanggan')
            const alamat = btn.data('alamat')
            const ponsel = btn.data('no_telp')
            const email = btn.data('email')

            // Membedakan Input Atau Edit
            if(mode === 'edit'){
                modal.find('.modal-title').text('Edit Data')
                modal.find('#nama_pelanggan').val(nama)
                modal.find('#kode_pelanggan').val(kode)
                modal.find('#alamat').val(alamat)
                modal.find('#no_telp').val(ponsel)
                modal.find('#email').val(email)
                modal.find('#method').html('@method("PATCH")')
                modal.find('form').attr('action',`{{ url('pelanggan') }}/${id}`)
            }else{
                modal.find('.modal-title').text('Form Pelanggan')
                modal.find('#nama_pelanggan').val('')
                modal.find('#kode_pelanggan').val('')
                modal.find('#alamat').val('')
                modal.find('#no_telp').val('')
                modal.find('#email').val('')
                modal.find('#method').html('')
                modal.find('form').attr('action','{{ url("pelanggan") }}')
            }
        })
        $('#modalFormPelanggan').on('shown.bs.modal', function(){
            $('#nama').delay(1000).focus().select();
        })
    })


    </script>
    @endpush