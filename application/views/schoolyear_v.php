<form id="frmSchoolYear">
    <input type="text" name="schoolyear_id" id="schoolyear_id" placeholder="School Year ID" readonly>
    <input type="text" name="schoolyear" id="schoolyear">

    <button id="btnAdd" type="submit">Add</button>
    <button id="btnUpdate" type="submit" disabled>Update</button>
    <button id="btnCancel" type="button">Cancel</button>
</form>

<form id="frmIscurrent">
    <label>Current Schoolyear</label>
    <input type="text" name="schoolyear_id" id="schoolyear_id2">
    <input type="text" name="iscurrent" id="iscurrent" readonly>
</form>

<table id="tblSchoolYear" class="datatable-table">
    <thead>
        <tr>
            <th>SchoolYear</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        getSchoolYear();
        getCurrent();

        function getSchoolYear() {
            $(".datatable-table").DataTable().clear().destroy();

            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("SchoolYear/get"); ?>',
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        var tbody = '';

                        response.data.forEach(function(schoolyear) {
                            tbody += '<tr>';
                            tbody +=    '<td>';
                            tbody +=        schoolyear.schoolyear;
                            tbody +=    '</td>';
                            tbody +=    '<td>';
                            tbody +=        '<button data-schoolyear-id="'+schoolyear.schoolyear_id+'" data-schoolyear="'+schoolyear.schoolyear+'" type="button" class="btnEdit">Edit</button>';
                            tbody +=        '<button data-schoolyear-id="'+schoolyear.schoolyear_id+'" data-schoolyear="'+schoolyear.schoolyear+'" type="button" class="btnAssign">'+((schoolyear.iscurrent === "1") ? "Active" : "Assign")+'</button>';
                            tbody +=    '</td>';
                            tbody += '</tr>';
                        });

                        $("#tblSchoolYear tbody").html(tbody);
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

        function getCurrent(){
            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("SchoolYear/getCurrent"); ?>',
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        $("#iscurrent").val(response.data[0].schoolyear);
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
                url: '<?php echo base_url("SchoolYear/add"); ?>',
                data: $("#frmSchoolYear").serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        alert("Schoolyear addded successfully!");
                        getSchoolYear();
                        $("#btnCancel").click();
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
            $("#schoolyear_id").val($(this).attr("data-schoolyear-id"));
            $("#schoolyear").val($(this).attr("data-schoolyear"));

            $("#btnAdd").attr('disabled','disabled');
            $("#btnUpdate").removeAttr('disabled');
        });

        $(document).on("click", ".btnAssign", function() {
            $("#schoolyear_id2").val($(this).attr("data-schoolyear-id"));
            $("#iscurrent").val($(this).attr("data-schoolyear"));

            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("SchoolYear/assign"); ?>',
                data: $("#frmIscurrent").serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        alert("OK!");
                        getSchoolYear();
                        $("#btnCancel").click();
                    } else {
                        alert("Erorr on response!");
                    }
                },
                error: function (response) {
                    alert("Erorr on request!");
                }
            });
        });

        $("#btnUpdate").click(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("SchoolYear/update"); ?>',
                data: $("#frmSchoolYear").serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        alert("Schoolyear updated successfully!");
                        getSchoolYear();
                        $("#btnCancel").click();
                    } else {
                        alert("Erorr on response!");
                    }
                },
                error: function (response) {
                    alert("Erorr on request!");
                }
            });
        });

        $("#btnCancel").click(function() {
            $("#schoolyear_id").val($(this).attr(""));
            $("#schoolyear").val($(this).attr(""));

            $("#btnAdd").removeAttr('disabled');
            $("#btnUpdate").attr('disabled','disabled');
        });
    });
</script>