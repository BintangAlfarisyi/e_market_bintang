    @extends('templates.layout')

    @push('style')

    @endpush

    @section('content')
    <div>
        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">User</h3>

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
                <button type="button" class="btn btn-primary btn-block btn-sm" style="width:150;" data-toggle="modal" data-target="#modalFormUser">
                    Tambah User
                </button>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user as $us)
                        <tr>
                            <th scope="row">{{ $i = (!isset($i)?1:++$i) }}</th>
                            <td>{{ $us->name }}</td>
                            <td>{{ $us->email }}</td>
                            <td>{{ $us->password }}</td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalFormUser" data-mode="edit" data-id="{{  $us->id }}" data-name="{{ $us->name }}" data-email="{{ $us->email }}" data-password="{{ $us->password }}"><i class="fas fa-edit"></i></button>

                                <form action="{{ route('user.destroy', $us) }}" method="post" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-delete" data-id="{{ $us->id }}"><i class="fas fa-trash"></i></button>
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

    @include('user.form')

    @push('script')
    <script>
        $('.alert-success').fadeTo(2000, 500).slideUp(500, function() {
            $('.alert-success').slideUp(500)
        })

        $('.alert-danger').fadeTo(2000, 500).slideUp(500, function() {
            $('.alert-danger').slideUp(500)
        })

        $(function() {
        $('#tbl-User').DataTable()

        // dialog hapus data
        $('.btn-delete').on('click', function(e) {
            let name = $(".User" + $(this).attr('data-id')).text()
            console.log(name)
            Swal.fire({
                icon: 'error',
                title: 'Hapus Data',
                html: `Apakah data <b> ${name} </b> akan dihapus?`,
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
        $('#modalFormUser').on('show.bs.modal', function(e){
            const btn = $(e.relatedTarget)
            const modal = $(this)
            const mode = btn.data('mode')
            const id = btn.data('id')
            const nama = btn.data('name')
            const email = btn.data('email')
            const password = btn.data('password')

            // Membedakan Input Atau Edit
            if(mode === 'edit'){
                modal.find('.modal-title').text('Edit Data')
                modal.find('#name').val(nama)
                modal.find('#email').val(email)
                modal.find('#password').val(password)
                modal.find('#method').html('@method("PATCH")')
                modal.find('form').attr('action',`{{ url('user') }}/${id}`)
            }else{
                modal.find('.modal-title').text('Form User')
                modal.find('#name').val('')
                modal.find('#email').val('')
                modal.find('#password').val('')
                modal.find('#method').html('')
                modal.find('form').attr('action','{{ url("user") }}')
            }
        })
        $('#modalFormUser').on('shown.bs.modal', function(){
            $('#name').delay(1000).focus().select();
        })
    })


    </script>
    @endpush