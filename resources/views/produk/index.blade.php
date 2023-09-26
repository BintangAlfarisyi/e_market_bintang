    @extends('templates.layout')

    @push('style')

    @endpush

    @section('content')
    <div>
        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Produk</h3>

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
                <button type="button" class="btn btn-primary btn-block btn-sm" style="width:120;" data-toggle="modal" data-target="#modalFormProduk">
                    Tambah Produk
                </button>
                @include('produk.data')
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                Footer
            </div>
        </section>
    </div>
    @endsection

    @include('produk.form')

    @push('script')
    <script>
        $('.alert-success').fadeTo(2000, 500).slideUp(500, function() {
            $('.alert-success').slideUp(500)
        })

        $('.alert-danger').fadeTo(2000, 500).slideUp(500, function() {
            $('.alert-danger').slideUp(500)
        })

        $(function() {
            $('#tbl-produk').DataTable()

            // dialog hapus data
            $('.btn-delete').on('click', function(e) {
                let nama_produk = $(".produk" + $(this).attr('data-id')).text()
                console.log(nama_produk)
                Swal.fire({
                    icon: 'error',
                    title: 'Hapus Data',
                    html: `Apakah data <b> ${nama_produk} </b> akan dihapus?`,
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
            $('#modalFormProduk').on('show.bs.modal', function(e) {
                const btn = $(e.relatedTarget)
                const modal = $(this)
                const mode = btn.data('mode')
                const id = btn.data('id')
                const nama_produk = btn.data('nama_produk')

                // Membedakan Input Atau Edit
                if (mode === 'edit') {
                    modal.find('.modal-title').text('Edit Data')
                    modal.find('#nama_produk').val(nama_produk)
                    modal.find('#method').html('@method("PATCH")')
                    modal.find('form').attr('action', `{{ url('produk') }}/${id}`)
                } else {
                    modal.find('.modal-title').text('Form Produk')
                    modal.find('#nama_produk').val('')
                    modal.find('#method').html('')
                    modal.find('form').attr('action', '{{ url("produk") }}')
                }
            })
            $('#modalFormProduk').on('shown.bs.modal', function() {
                $('#nama_produk').delay(1000).focus().select();
            })
        })
    </script>
    @endpush