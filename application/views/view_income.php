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
                            <a class="dropdown-item" href="#FI" data-target="#FI"
                                data-toggle="modal">Tambah Income</a>
                            <a class="dropdown-item" id="modalFormOutcome" href="#modalFormOutcome" data-target="#modalFormOutcome"
                                data-toggle="modal">Tambah Outcome</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table width="100%" id="tableAjax" class="table table-bordered display nowrap">
                        <thead>
                            <tr class="text-center bg-primary text-white">
                                <th>No</th>
                                <th>Nomor Induk</th>
                                <th>Nama PD</th>
                                <th>Nama Guru</th>
                                <th>Keterangan</th>
                                <th>Total Bayar</th>
                                <th>Waktu Bayar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function() {
        loadTable();
    });

    function loadTable() {
        $('#tableAjax').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: {
                url: '<?= base_url("Income/loadTable"); ?>'
            },
            columns: [{
                    name: 'id_i',
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
                    name: 'nama_guru',
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

    function cetak_nota(id_i) {
        var win = window.open('<?= base_url("CetakNota?id_i="); ?>'+id_i, '_blank');
        if (win) {
            win.focus();
        } else {
            alert('Tolong "allows" popup pada browser ini');
        }
    }
    </script>