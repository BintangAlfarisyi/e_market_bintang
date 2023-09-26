        @extends('templates.layout')

        @push('style')

        @endpush

        @section('content')
        <div>
            <section class="content">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pembelian</h3>

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

                        <form id="formTransaksi" method="post" action="pembelian">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <label for="kode_pembelian" class="col-4 col-form-label col-form-label-sm">Kode Pembelian</label>
                                    <div class="col-8">
                                        <input type="text" class="form-control form-control-sm" id="kode_pembelian" placeholder="" readonly value="{{ $kode }}" name="kode_masuk">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="tanggal_pembelian" class="control-label col-md-6 col-sm-6 col-xs-12">Tanggal Pembelian</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="date" class="date-picker form-control col-md-7 col-xs-12" required="required" value="{{ date('Y-m-d') }}" name="tanggal_masuk">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">&nbsp;</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <button type="button" class="btn btn-primary" id="tambahBarangBtn" data-toggle="modal" data-target="#tblBarangModal">Tambah Barang</button>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                    <label class="control-label col-md-6 col-sm-6 col-xs-12">Distributor</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control col-md-7 col-sm-7 col-xs-12" required="required" name="pemasok_id">
                                            @foreach($pemasok as $pems)
                                                <option value="{{ $pems->id }}">{{ $pems->nama_pemasok }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @include('pembelian.data')
                        </form>
                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        Footer
                    </div>
                    @include('pembelian.form')
            </section>
        </div>
        @endsection


        @push('script')
        <script>
            $('.alert-success').fadeTo(2000, 500).slideUp(500, function() {
                $('.alert-success').slideUp(500)
            })

            $('.alert-danger').fadeTo(2000, 500).slideUp(500, function() {
                $('.alert-danger').slideUp(500)
            })

            $(function() {
                $('#tblBarang2').DataTable();

                // Pemilihan barang
                $('#tblBarangModal').on('click', '.pilihBarangBtn', function() {
                    tambahBarang(this);
                });

                // Change qty
                $('#formTransaksi').on('change', '.qty', function() {
                    calcSubTotal(this);
                });

                // Remove Barang
                $('#formTransaksi').on('click', '.btnRemoveBarang', function() {
                    let subTotalAwal = parseFloat($(this).closest('tr').find('.subTotal').text());
                    totalHarga -= subTotalAwal;

                    $currentRow = $(this).closest('tr').remove();
                    $('#totalHarga').val(totalHarga.toFixed(2));

                    let tbody = $('#formTransaksi tbody tr').length;
                    if (tbody === 0) {
                        $('#formTransaksi tbody').append('<tr><td colspan="6" style="text-align:center; font-style: italic;">Belum Ada Data</td></tr>');
                    }
                });

                let totalHarga = 0;

                function tambahBarang(a) {
                    let d = $(a).closest('tr');
                    let kodeBarang = d.find('td:eq(0)').text();
                    let namaBarang = d.find('td:eq(1)').text();
                    let hargaBarang = parseFloat(d.find('td:eq(2)').text());
                    let idBarang = d.find('.idBarang').val();
                    let data = '';
                    let tbody = $('#formTransaksi tbody tr').length;
                    data += '<tr>';
                    data += '<td>' + kodeBarang + '</td>';
                    data += '<td>' + namaBarang + '</td>';
                    data += '<td>' + hargaBarang.toFixed(2) + '</td>';
                    data += '<input type="hidden" name="id[]" value="' + idBarang + '">';
                    data += '<input type="hidden" name="harga_beli[]" value="' + hargaBarang.toFixed(2) + '">';
                    data += '<td><input type="number" value="1" min="1" class="qty" name="jumlah[]"></td>';
                    data += '<td><span class="subTotal">' + hargaBarang.toFixed(2) + '</span></td>';
                    data += '<td><button type="button" class="btnRemoveBarang btn btn-danger">x</button></td>';
                    data += '</tr>';

                    if (tbody === 1 && $('#formTransaksi tbody tr td').text() === 'Belum Ada Data') {
                        $('#formTransaksi tbody tr').remove();
                    }

                    $('#formTransaksi tbody').append(data);
                    totalHarga += hargaBarang;
                    $('#totalHarga').val(totalHarga.toFixed(2));
                    $('#tblBarangModal').modal('hide');
                }

                function calcSubTotal(a) {
                    let qty = parseInt($(a).closest('tr').find('.qty').val());
                    let hargaBarang = parseFloat($(a).closest('tr').find('td:eq(2)').text());
                    let subTotalAwal = parseFloat($(a).closest('tr').find('.subTotal').text());
                    let subTotal = qty * hargaBarang;
                    totalHarga += subTotal - subTotalAwal;
                    $(a).closest('tr').find('.subTotal').text(subTotal.toFixed(2));
                    $('#totalHarga').val(totalHarga.toFixed(2));
                }
            });
        </script>
        @endpush