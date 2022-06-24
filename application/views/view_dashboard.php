  <!-- Begin Page Content -->
<div class="container-fluid">
  	<!-- Page Heading -->
  	<div class="d-sm-flex align-items-center justify-content-between mb-4">
  		<h1 class="h3 mb-0 text-gray-800"><?php echo $title;?></h1>
  	</div>

      <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Income</h6>
                </div>
                <div class="card-body">
                    <span style="color:green" id="income"></span>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Outcome</h6>
                </div>
                <div class="card-body">
                    <span style="color:red" id="outcome"></span>
                </div>
            </div>
        </div>
    </div>

  	<div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Panduan</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-light">1. Masukkan Data Peserta Didik</li>
						<li class="list-group-item list-group-item-light">2. Tambahkan Kategori(Misal SPP, Donasi atau semacamnya)</li>
						<li class="list-group-item list-group-item-light">3. Outcome untuk melakukan pembukuan uang keluar</li>
                        <li class="list-group-item list-group-item-light">3. Income untuk melakukan pembukuan uang masuk</li>
					</ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
   $(document).ready(function() {
        dropIncome();
        dropOutcome();
    });

    function dropIncome() {
        total_i = 0;
        $.getJSON('<?= base_url("GetData/getI"); ?>', function(data) {
            $.each(data, function(key, value) {
                $('#income').append("Rp. "+value.income);
            });
        });
    }

    function dropOutcome() {
        total_o = 0;
        $.getJSON('<?= base_url("GetData/getO"); ?>', function(data) {
            $.each(data, function(key, value) {
                $('#outcome').append("Rp. "+value.outcome);
            });
        });
    }

</script>