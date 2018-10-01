<div class="row">
    <div class="col-md-12">
    <form class="form-control" id="frmExaminee" name="frmExaminee"><div class="text-primary text-center"><h1>Add and Update Examinee</h1></div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="examinee_id" style="display:none" id="examinee_id" placeholder="Examinee ID" readonly><br/>
                <label>Or Number</label><input type="number" class="form-control validate" name="ornum" id="ornum" placeholder="OR Number"><br/>
                <label>Fullname</label><input type="text" class="form-control lettersonly validate" name="fullname" id="fullname" placeholder="Fullname"><br/>
                <label>Last School Attended</label><input type="text" class="form-control validate" name="lastschool" id="lastschool" placeholder="Last School Attended"><br/>
                <label>Examinee Code</label><input type="text" class="form-control validate" name="code" id="code" readonly value="<?php echo $examineecode; ?>"><br/>
                <label class="d-none">Status</label><input type="text" class="form-control d-none" name="status" id="status" hidden readonly value="0">

                <button class="btn btn-primary" id="btnAdd" type="submit">Add</button>
                <button class="btn btn-primary" id="btnUpdate" type="submit" disabled>Update</button>
                <button class="btn btn-danger"id="btnCancel" type="button">Cancel</button>
            </div>
            <div class="col-md-4"></div>
        </div>
        <table id="tblExaminee" class="table table-striped table-hover datatable-table">
        <thead>
            <tr>
                <th>OR Number</th>
                <th>Fullname</th>
                <th>Last School Attended</th>
                <th>Examinee Code</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        </table>
    </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        var form = $('#frmExaminee');

        validate("#frmExaminee");
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
                            tbody +=        '<button data-ornum="'+examinee.ornum+'" data-fullname="'+examinee.fullname+'" data-lastschool="'+examinee.lastschool+'" data-code="'+examinee.code+'" data-examinee-id="'+examinee.examinee_id+'" type="button" class="btnEdit btn btn-secondary">Edit</button>';
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

            if (form.valid() === true) {
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
            }
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

            if (form.valid() === true) {
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
            }
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