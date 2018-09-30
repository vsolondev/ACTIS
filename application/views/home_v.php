<div class="modal fade" id="modalAdmin" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="frmAdmin">
                    <div class="form-group">
                       <label>Username</label><input  class="form-control" type="text" name="username" id="username" placeholder="Enter Username">
                       <label>Password</label><input  class="form-control" type="password" name="password" id="password" placeholder="Enter Password">
                        <button id="btnLoginAdmin" type="submit" class="btn btn-primary" style="cursor:pointer">OK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalExaminee" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="frmExaminee">
                    <div class="form-group">
                        <label>Examinee Code</label><input  class="form-control" type="text" name="code" id="code" placeholder="Enter Code">
                    </div>
                    <button id="btnLoginExaminee" type="submit" class="btn btn-primary" style="cursor:pointer">OK</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#btnLoginAdmin").click(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("Home/adminLogin"); ?>',
                data: $("#frmAdmin").serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        alert("Success!");
                        document.location.href = '<?php echo base_url("Admin");?>';
                    } else {
                        alert("Username or password is not match!");
                    }
                },
                error: function (response) {
                    alert("Erorr on request!");
                }
            });
        });

        $("#btnLoginExaminee").click(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("Home/examineeLogin"); ?>',
                data: $("#frmExaminee").serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        alert("Success!");
                        document.location.href = '<?php echo base_url("Exam");?>';
                    } else {
                        alert("Code is not exist!");
                    }
                },
                error: function (response) {
                    alert("Erorr on request!");
                }
            });
        });
    });
</script>