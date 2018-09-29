<form id="frmAdmin">
    <input type="text" name="admin_id" id="admin_id" placeholder="Admin ID" readonly>
    <input type="text" name="fullname" id="fullname" placeholder="Fullname">
    <input type="text" name="username" id="username" placeholder="Username">
    <input type="password" name="password" id="password" placeholder="Password">

    <button id="btnAdd" type="submit">Add</button>
    <button id="btnUpdate" type="submit" disabled>Update</button>
    <button id="btnCancel" type="button">Cancel</button>
</form>

<table id="tblAdmin" class="datatable-table">
    <thead>
        <tr>
            <th>Fullname</th>
            <th>Username</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        getAdmin();

        function getAdmin() {
            $(".datatable-table").DataTable().clear().destroy();

            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("Admin/get"); ?>',
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        var tbody = '';

                        response.data.forEach(function(admin) {
                            tbody += '<tr>';
                            tbody +=    '<td>';
                            tbody +=        admin.fullname;
                            tbody +=    '</td>';
                            tbody +=    '<td>';
                            tbody +=        admin.username;
                            tbody +=    '</td>';
                            tbody +=    '<td>';
                            tbody +=        '<button data-admin-id="'+admin.admin_id+'" data-fullname="'+admin.fullname+'" data-username="'+admin.username+'" type="button" class="btnEdit">Edit</button>';
                            tbody +=    '</td>';
                            tbody += '</tr>';
                        });

                        $("#tblAdmin tbody").html(tbody);
                        $(".datatable-table").DataTable();
                    } else {
                        alert("Erorr on response!");
                    }
                },
                error: function (response) {
                    alert("Erorr on request!");
                }
            });
        }

        $("#btnAdd").click(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("Admin/add"); ?>',
                data: $("#frmAdmin").serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        alert("Admin addded successfully!");
                        getAdmin();
                    } else {
                        alert("Erorr on response!");
                    }
                },
                error: function (response) {
                    alert("Erorr on request!");
                }
            });
        });

        $(document).on("click", ".btnEdit", function() {
            $("#admin_id").val($(this).attr("data-admin-id"));
            $("#fullname").val($(this).attr("data-fullname"));
            $("#username").val($(this).attr("data-username")).attr('disabled','disabled');
            $("#password").attr('disabled','disabled');

            $("#btnAdd").attr('disabled','disabled');
            $("#btnUpdate").removeAttr('disabled');
        });

        $("#btnUpdate").click(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("Admin/update"); ?>',
                data: $("#frmAdmin").serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        alert("Admin updated successfully!");
                        getAdmin();
                    } else {
                        alert("Erorr on response!");
                    }
                },
                error: function (response) {
                    alert("Erorr on request!");
                }
            });
        });

        $("#btnCancel").click(function(e) {
            $("#admin_id").val("");
            $("#fullname").val("");
            $("#username").val("").removeAttr('disabled');
            $("#password").removeAttr('disabled');
            
            $("#btnAdd").removeAttr('disabled');
            $("#btnUpdate").attr('disabled','disabled');
        });
    });
</script>