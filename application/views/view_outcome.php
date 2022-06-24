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
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" id="btnModalTambah" href="#modalForm" data-target="#modalForm"
                                data-toggle="modal">Tambah Outcome</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table width="100%" id="tableAjax" class="table table-bordered display nowrap">
                        <thead>
                            <tr class="text-center bg-primary text-white">
                                <th>No</th>
                                <th>Keterangan</th>
                                <th>Total Bayar</th>
                                <th>Waktu Bayar</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Data Outcome</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="dataForm">
                        <div class="form-group">
                            <label><strong>Kategori Outcome :</strong></label>
                            <select name="id_kat" class="form-control select2" id="id_kat">
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nominal Pengeluaran</label>
                            <input type="text" id="total_bayar" name="total_bayar" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="insertData()" id="insertData" class="btn btn-info">
                        <i class="la la-plus"></i> Tambahkan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function() {
        loadTable();
        dropKat();
    });

    function keTable() {
        resetData();
        $('#modalForm').modal('hide');
    }

    function resetData() {
        $('#dataForm').trigger('reset');
    }

    function loadTable() {
        $('#tableAjax').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: {
                url: '<?= base_url("Outcome/loadTable"); ?>'
            },
            columns: [{
                    name: 'id_o',
                    searchable: false,
                    className: 'text-center'
                },
                {
                    name: 'ket',
                    className: 'text-center'
                },
                {
                    name: 'total_bayar',
                    className: 'text-center'
                },
                {
                    name: 'time',
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

    function dropKat() {
    $.getJSON('<?= base_url("GetData/getKatO"); ?>', function(data) {
        $('#id_kat').append('<option value="">-- Pilih Kategor Outcome--</option>');
        $.each(data, function(key, value) {
        $('#id_kat').append('<option value="' + value.id_kat + '">' + value.ket +'</option>');
        });
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
                url: '<?= base_url("Outcome/insertData"); ?>',
                type: 'POST',
                dataType: 'JSON',
                data: $('#dataForm').serialize(),
                success: function(result) {
                    if (result.ping == 200) {
                        keTable();
                        loadTable();
                        toastr.success('Data pengeluaran telah ditambahkan!', 'Created!!', {
                            showMethod: 'slideDown',
                            hideMethod: 'slideUp',
                            timeOut: 4000
                        });
                    } else {
                        Swal.fire('Ooppss!!', 'Harap periksa proses tambah!', 'error');
                    }
                }
            });
        }
    }

    </script>