<div class="row">
   <div class="col-md-12">
      <form class="form-control" id="frmSchoolYear" name="frmSchoolYear"><div class="text-primary text-center"><h1>Add and Update School Year</h1></div>
         <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
               <input class="form-control" type="text" name="schoolyear_id" id="schoolyear_id" style="display:none" placeholder="School Year ID" readonly>
               <label>School Year</label><input class="form-control validate" type="text" name="schoolyear" id="schoolyear"><br/>
               <button class="btn btn-primary" id="btnAdd" type="submit">Add</button>
               <button class="btn btn-primary" id="btnUpdate" type="submit" disabled>Update</button>
               <button class="btn btn-danger" id="btnCancel" type="button">Cancel</button>
            </div>
            <div class="col-md-4"></div>
         </div>
      </form>
      <form class="form-control" id="frmIscurrent">
         <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
               <label>Current Schoolyear</label>
               <input class="form-control" type="text" name="schoolyear_id" id="schoolyear_id2"><br/>
               <input class="form-control" type="text" name="iscurrent" id="iscurrent" readonly>
            </div>
            <div class="col-md-4"></div>
         </div>
      </form>
      <table id="tblSchoolYear" class="table table-striped table-hover datatable-table">
         <thead>
            <tr>
               <th>SchoolYear</th>
               <th>action</th>
            </tr>
         </thead>
         <tbody>
         </tbody>
      </table>
   </div>
</div>

<script>
    $(document).ready(function() {
        var form = $("#frmSchoolYear");

        validate("#frmSchoolYear");
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
                            tbody +=        '<button data-schoolyear-id="'+schoolyear.schoolyear_id+'" data-schoolyear="'+schoolyear.schoolyear+'" type="button" class="btnEdit btn btn-secondary">Edit</button>';
                            tbody +=        '<button data-schoolyear-id="'+schoolyear.schoolyear_id+'" data-schoolyear="'+schoolyear.schoolyear+'" type="button" class="btnAssign btn btn-info">'+((schoolyear.iscurrent === "1") ? "Active" : "Assign")+'</button>';
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
            
            if (form.valid() === true) {
                var schoolyear = $("#schoolyear").val();
                if (/[0-9]{4}-[0-9]{4}/.test(schoolyear) === false) {
                    alert("Schoolyear invalid format");
                    return false;
                }

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
            }
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

            if (form.valid() === true) {
                var schoolyear = $("#schoolyear").val();
                if (! /\d{4}-\d{4}/.test(schoolyear)) {
                    alert("Schoolyear invalid format");
                    return false;
                }

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
            }
        });

        $("#btnCancel").click(function() {
            $("#schoolyear_id").val($(this).attr(""));
            $("#schoolyear").val($(this).attr(""));

            $("#btnAdd").removeAttr('disabled');
            $("#btnUpdate").attr('disabled','disabled');
        });
    });
</script>