<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title;?></h1>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $header;?></h6>
                </div>
                <div class="card-body">
                    <table width="100%" id="tableAjax" class="table table-bordered display nowrap">
                        <thead>
                        <tr class="text-center bg-primary text-white">
                                <th>No</th>
                                <th>Nomor Induk</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="FI" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title text-white" id="exampleModalCenterTitle">Tambah Data Income</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="dataForm">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" id="nama" name="nama" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label>Nomor Induk</label>
                            <input type="text" id="nomor_induk" name="nomer_induk" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label>Nominal Pembayaran</label>
                            <div class="row">
                                <div class="col">
                                <input type="text" id="total_bayar" name="total_bayar" class="form-control">
                                </div>
                                <div class="col">
                                    <select name="id_kat" class="form-control select2" id="id_kat">
                                    </select>
                                </div>
                             </div>
                        </div>
                        <input type=hidden name='id_pd' id='id_pd' >
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="insertData()" id="insertData" class="btn btn-info">
                        <i class="la la-pencil"></i> Bayar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function() {
        getKat();
        loadTable();
    });

    function keTable() {
        resetData();
        $('#FI').modal('hide');
    }

    function resetData() {
        $('#dataForm').trigger('reset');
    }


    function getKat() {
        $.getJSON('<?= base_url("GetData/getKat"); ?>', function(data) {
            $('#id_kat').append('<option value="">-- Pilih Kategori --</option>');
            $.each(data, function(key, value) {
            $('#id_kat').append('<option value="' + value.id_kat + '">' + value.ket + '</option>');
            });
        });
    }

    function showData(id) {
        $('#FI').modal('show');
        $.ajax({
            url: '<?= base_url("Bayar/showData/"); ?>' + id,
            dataType: 'JSON',
            success: function(result) {
                $('#nomor_induk').val(result.nomor_induk);
                $('#nama').val(result.nama);
                $('#id_pd').val(result.id_pd);
            }
        });
    }

    function insertData() {
        if ($('#total_bayar').val() == '') {
            Swal.fire('Ooppss!!', 'Mohon mengisi nominal pembayaran!', 'warning');
        } else if ($('#id_kat').val() == '') {
            Swal.fire('Ooppss!!', 'Mohon mengisi kategori!', 'warning');
        }
        else {
            $.ajax({
                url: '<?= base_url("Bayar/insertData"); ?>',
                type: 'POST',
                dataType: 'JSON',
                data: $('#dataForm').serialize(),
                success: function(result) {
                    if (result.ping == 200) {
                        keTable();
                        loadTable();
                        toastr.success('Data pembayaran telah ditambahkan!', 'Created!!', {
                            showMethod: 'slideDown',
                            hideMethod: 'slideUp',
                            timeOut: 4000
                        });
                        window.location.href = "<?php echo base_url('Income'); ?>";
                    } else {
                        Swal.fire('Ooppss!!', 'Harap periksa proses tambah!', 'error');
                    }
                }
            });
        }
    }

    function loadTable() {
        $('#tableAjax').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: {
                url: '<?= base_url("Bayar/loadTable"); ?>'
            },
            columns: [{
                    name: 'id_pd',
                    searchable: false,
                    className: 'text-center'
                },
                {
                    name: 'nomor_induk',
                    className: 'text-center'
                },
                {
                    name: 'nama',
                    className: 'text-center'
                },
                {
                    name: 'jk',
                    className: 'text-center'
                },
                {
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                },
            ],
            order: [
                [0, 'asc']
            ],
            iDisplayLength: 10,
            scrollX: true
        });
    }
    </script>