      </div>
      <!-- End of Main Content -->
	  <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span id="ketapp"></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

<script type="text/javascript">
  $(document).ready(function() {
    var ketapp= document.getElementById('ketapp');
    $.getJSON('<?= base_url("GetData/getKetApp"); ?>', function(data) {
      $.each(data, function(key, value) {
        console.log();
        $("#ketapp").text('Copyright oleh '+value.produsen+' pada '+value.tahun+' - '+value.namaapp+' '+value.versi);
      });
    });
  });
</script>