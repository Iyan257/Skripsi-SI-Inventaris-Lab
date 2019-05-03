<script>
    //random string
    function random_string(){
      result = '';
      char = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      for(i=0; i<4; i++){
          result += char.charAt(Math.floor(Math.random() * char.length));
      }
      return result;
    }

    // untuk halaman ruangan agar sort secara desc, default adalah asc.
    $(document).ready(function(){
		  $("#kolom_no").click();
      $(".kolom_aksi").removeClass('sorting');
      $(".kolom_aksi").prop("onclick", null).off("click");
      $(".sorting").click(function(){
        $(".kolom_aksi").removeClass('sorting');
        $(".kolom_aksi").prop("onclick", null).off("click");
      });

      //untuk halaman aset (create)
      $("#btn_random").click(function(){
        $('#kode').val(random_string());
      });

      $("form").submit(function() {
        $(this).find(":input").filter(function(){ return !this.value; }).attr("disabled", "disabled");
        return true; // ensure form still submits
      });
      
      // Un-disable form fields when page loads, in case they click back after submission
      $( "form" ).find( ":input" ).prop( "disabled", false );
    });
</script>