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
                                data-toggle="modal">Tambah Kategori</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table width="100%" id="tableAjax" class="table table-bordered display nowrap">
                        <thead>
                            <tr class="text-center bg-primary text-white">
                                <th>No</th>
                                <th>Nama Guru</th>
                                <th>Aksi</th>
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
                    <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Data Guru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="dataForm">
                        <div class="form-group">
                            <label>Nama Guru</label>
                            <input type="text" id="nama_guru" name="nama_guru" class="form-control"
                                placeholder="Nama Guru, contoh Sukiyem">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="updateData()" id="updateData" class="btn btn-warning">
                        <i class="la la-pencil"></i> Update
                    </button>
                    <button type="button" onclick="insertData()" id="insertData" class="btn btn-info">
                        <i class="la la-plus"></i> Tambahkan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#btnModalTambah').on('click', function() {
            FormTambah();
        });
        loadTable();
    });

    function FormTambah() {
        $('#updateData').hide();
        $('#insertData').show();
        $('.modal-title').html('Tambah Data Kategori');
        $('.modal-title').addClass('text-white');
        $('.modal-header').removeClass('bg-warning');
        $('.modal-header').addClass('bg-info');
        resetData();
    }

    function FormEdit() {
        $('#modalForm').modal('show');
        $('#insertData').hide();
        $('#updateData').show();
        $('.modal-title').html('Edit Data Kategori');
        $('.modal-title').addClass('text-white');
        $('.modal-header').removeClass('bg-info');
        $('.modal-header').addClass('bg-warning');
        resetData();
    }

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
                url: '<?= base_url("Guru/loadTable"); ?>'
            },
            columns: [{
                    name: 'id_guru',
                    searchable: false,
                    className: 'text-center'
                },
                {
                    name: 'nama_guru',
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

    function showData(id) {
        FormEdit();
        $.ajax({
            url: '<?= base_url("Guru/showData/"); ?>' + id,
            dataType: 'JSON',
            success: function(result) {
                $('#nama_guru').val(result.nama_guru);
                $('#updateData').attr('onclick', 'updateData(' + id + ')');
            }
        });
    }

    function insertData() {
        if ($('#nama_guru').val() == '') {
            Swal.fire('Ooppss!!', 'Mohon mengisi nama guru!', 'warning');
        }
        else {
            $.ajax({
                url: '<?= base_url("Guru/insertData"); ?>',
                type: 'POST',
                dataType: 'JSON',
                data: $('#dataForm').serialize(),
                success: function(result) {
                    if (result.ping == 200) {
                        keTable();
                        loadTable();
                        toastr.success('Data kategori telah ditambahkan!', 'Created!!', {
                            showMethod: 'slideDown',
                            hideMethod: 'slideUp',
                            timeOut: 2000
                        });
                    } else {
                        Swal.fire('Ooppss!!', 'Harap periksa proses tambah!', 'error');
                    }
                }
            });
        }
    }

    function updateData(id) {
        if ($('#nama_guru').val() == '') {
            Swal.fire('Ooppss!!', 'Mohon mengisi nama guru!', 'warning');
        }
         else {
            $.ajax({
                url: '<?= base_url("Guru/updateData/"); ?>' + id,
                type: 'POST',
                dataType: 'JSON',
                data: $('#dataForm').serialize(),
                success: function(result) {
                    if (result.ping == 200) {
                        keTable();
                        loadTable();
                        toastr.success('Data guru telah diupdate!', 'Updated!!', {
                            showMethod: 'slideDown',
                            hideMethod: 'slideUp',
                            timeOut: 2000
                        });
                    } else {
                        Swal.fire('Ooppss!!', 'Harap periksa proses update!', 'error');
                    }
                }
            });
        }
    }

    function deleted(id) {
        Swal.fire({
            title: 'Menghapus Data?',
            text: 'Penghapusan data guru!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?= base_url("Guru/deleted/"); ?>' + id,
                    dataType: 'JSON',
                    success: function(result) {
                        if (result.ping == 200) {
                            loadTable();
                            Swal.fire({
                                type: 'success',
                                text: 'Data telah dihapus!',
                                title: 'Deleted!!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else {
                            Swal.fire({
                                type: 'error',
                                text: 'Data gagal dihapus!',
                                title: 'Error!!',
                                showConfirmButton: true
                            });
                        }
                    }
                });
            }
        });
    }
    </script>