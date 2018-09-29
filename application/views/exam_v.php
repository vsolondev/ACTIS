asdasd

<script>
    $(document).ready(function() {
        $("#btnLogin").click(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("ExamineeLogin/login"); ?>',
                data: $("#frmLogin").serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        alert("Login!");
                    } else {
                        alert("Erorr on response!");
                    }
                },
                error: function (response) {
                    alert("Erorr on request!");
                }
            });
        });
        
    });
</script>