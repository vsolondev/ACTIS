<form id="frmExaminee">
    <input type="text" name="examinee_id" id="examinee_id" placeholder="Examinee ID" readonly>
    <input type="text" name="ornum" id="ornum" placeholder="OR Number">
    <input type="text" name="fullname" id="fullname" placeholder="Fullname">
    <input type="text" name="lastschool" id="lastschool" placeholder="Lastschool">
    <input type="text" name="code" id="code" readonly value="<?php echo $examineecode; ?>">

    <button id="btnAdd" type="submit">Add</button>
    <button id="btnUpdate" type="submit">Update</button>
    <button id="btnCancel" type="button">Cancel</button>
</form>

<table id="tblExaminee" class="datatable-table">
    <thead>
        <tr>
            <th>ornum</th>
            <th>fullname</th>
            <th>lastschool</th>
            <th>code</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        getExaminee();

        function getExaminee() {
            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("Examinee/get"); ?>',
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        var tbody = '';

                        response.data.forEach(function(examinee) {
                            tbody += '<tr>';
                            tbody +=    '<td>';
                            tbody +=        examinee.ornum;
                            tbody +=    '</td>';
                            tbody +=    '<td>';
                            tbody +=        examinee.fullname;
                            tbody +=    '</td>';
                            tbody +=    '<td>';
                            tbody +=        examinee.lastschool;
                            tbody +=    '</td>';
                            tbody +=    '<td>';
                            tbody +=        examinee.code;
                            tbody +=    '</td>';
                            tbody +=    '<td>';
                            tbody +=        '<button data-ornum="'+examinee.ornum+'" data-fullname="'+examinee.fullname+'" data-lastschool="'+examinee.lastschool+'" data-code="'+examinee.code+'" data-examinee-id="'+examinee.examinee_id+'" type="button" class="btnEdit">Edit</button>';
                            tbody +=    '</td>';
                            tbody += '</tr>';
                        });

                        $("#tblExaminee tbody").html(tbody);
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
                url: '<?php echo base_url("Examinee/add"); ?>',
                data: $("#frmExaminee").serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        alert("Examinee addded successfully!");
                        location.reload();
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
            $("#examinee_id").val($(this).attr("data-examinee-id"));
            $("#ornum").val($(this).attr("data-ornum"));
            $("#fullname").val($(this).attr("data-fullname"));
            $("#lastschool").val($(this).attr("data-lastschool"));
            $("#code").val($(this).attr("data-code"));

            $("#btnAdd").attr('disabled','disabled');
            $("#btnUpdate").removeAttr('disabled');
        });

        $("#btnUpdate").click(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("Examinee/update"); ?>',
                data: $("#frmExaminee").serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        alert("Examinee updated successfully!");
                        location.reload();
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
            $("#examinee_id").val("");
            $("#ornum").val("");
            $("#fullname").val("");
            $("#lastschool").val("");
            $("#lastschool").val("");
            
            $("#btnAdd").removeAttr('disabled');
            $("#btnUpdate").attr('disabled','disabled');
        });
    });
</script>