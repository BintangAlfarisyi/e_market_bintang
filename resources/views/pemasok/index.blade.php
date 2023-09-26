    @extends('templates.layout')

    @push('style')

    @endpush

    @section('content')
    <div>
        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pemasok</h3>

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
                <button type="button" class="btn btn-primary btn-block btn-sm" style="width:150;" data-toggle="modal" data-target="#modalFormPemasok">
                    Tambah Pemasok
                </button>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Pemasok</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemasok as $pems)
                        <tr>
                            <th scope="row">{{ $i = (!isset($i)?1:++$i) }}</th>
                            <td>{{ $pems->nama_pemasok }}</td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalFormPemasok" data-mode="edit" data-id="{{  $pems->id }}" data-nama_pemasok="{{ $pems->nama_pemasok }}"><i class="fas fa-edit"></i></button>

                                <form action="{{ route('pemasok.destroy', $pems) }}" method="post" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-delete" data-id="{{ $pems->id }}"><i class="fas fa-trash"></i></button>
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

    @include('pemasok.form')

    @push('script')
    <script>
        $('.alert-success').fadeTo(2000, 500).slideUp(500, function() {
            $('.alert-success').slideUp(500)
        })

        $('.alert-danger').fadeTo(2000, 500).slideUp(500, function() {
            $('.alert-danger').slideUp(500)
        })

        $(function() {
            $('#tbl-Pemasok').DataTable()

            // dialog hapus data
            $('.btn-delete').on('click', function(e) {
                let nama_Pemasok = $(".Pemasok" + $(this).attr('data-id')).text()
                console.log(nama_Pemasok)
                Swal.fire({
                    icon: 'error',
                    title: 'Hapus Data',
                    html: `Apakah data <b> ${nama_Pemasok} </b> akan dihapus?`,
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
            $('#modalFormPemasok').on('show.bs.modal', function(e) {
                const btn = $(e.relatedTarget)
                const modal = $(this)
                const mode = btn.data('mode')
                const id = btn.data('id')
                const nama_pemasok = btn.data('nama_pemasok')

                // Membedakan Input Atau Edit
                if (mode === 'edit') {
                    modal.find('.modal-title').text('Edit Data')
                    modal.find('#nama_pemasok').val(nama_pemasok)
                    modal.find('#method').html('@method("PATCH")')
                    modal.find('form').attr('action', `{{ url('pemasok') }}/${id}`)
                } else {
                    modal.find('.modal-title').text('Form Pemasok')
                    modal.find('#nama_pemasok').val('')
                    modal.find('#method').html('')
                    modal.find('form').attr('action', '{{ url("pemasok") }}')
                }
            })
            $('#modalFormPemasok').on('shown.bs.modal', function() {
                $('#nama_pemasok').delay(1000).focus().select();
            })
        })
    </script>
    @endpush