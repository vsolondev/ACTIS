<div class="row">
    <div class="col-md-12">
        <form class="form-control" id="frmSchedule">
        <div class="row">
            <div class="col-md-4"></div>
                <div class="col-md-4">
                    <select name="schoolyear_id" id="schoolyear_id" class="form-control"></select><br/>
                    <button class="btn btn-primary" id="btnFilter" type="button">Filter</button>
                </div>
            <div class="col-md-4"></div>
        </div><br/>
        <div class="row">
            <div class="col-md-4"></div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="schedule_id" id="schedule_id" placeholder="Schedule ID" readonly>
                    <label>Schedule</label>
                    <input type="date" class="form-control" name="dateofsched" id="dateofsched" placeholder="Date of Schedule">
                    <br/>

                    <button class="btn btn-primary" id="btnAdd" type="submit">Add</button>
                    <button class="btn btn-primary" id="btnUpdate" type="submit" disabled>Update</button>
                    <button class="btn btn-danger" id="btnCancel" type="button">Cancel</button>
                </div>
            <div class="col-md-4"></div>
        </div>
        </form>
        <table id="tblSchedule" class="table table-striped table-hover datatable-table">
            <thead>
                <tr>
                    <th>School year</th>
                    <th>Date of Schedule</th>
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
        getSchoolYear();

        function getSchoolYear() {
            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("SchoolYear/get"); ?>',
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        var options = '';

                        response.data.forEach(function(schoolyear) {
                            options +=  '<option value="'+schoolyear.schoolyear_id+'">';
                            options +=      schoolyear.schoolyear;
                            options +=  '</option>';
                        });

                        $("#schoolyear_id").html(options);
                    } else {
                        alert("Erorr on response!");
                    }
                },
                error: function (response) {
                    alert("Erorr on request!");
                }
            });
        }

        function getScheduleBySchoolYear(schoolyear_id) {
            $(".datatable-table").DataTable().clear().destroy();

            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("Schedule/getScheduleBySchoolYear"); ?>',
                data: 'schoolyear_id='+schoolyear_id,
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        var tbody = '';

                        response.data.forEach(function(schedule) {
                            tbody += '<tr>';
                            tbody +=    '<td>';
                            tbody +=        schedule.schoolyear;
                            tbody +=    '</td>';
                            tbody +=    '<td>';
                            tbody +=        schedule.dateofsched;
                            tbody +=    '</td>';
                            tbody +=    '<td>';
                            tbody +=        '<button data-schedule-id="'+schedule.schedule_id+'" data-dateofsched="'+schedule.dateofsched+'"  data-schoolyear-id="'+schedule.schoolyear_id+'" type="button" class="btnEdit btn btn-secondary">Edit</button>';
                            tbody +=    '</td>';
                            tbody += '</tr>';
                        });

                        $("#tblSchedule tbody").html(tbody);
                        $(".datatable-table").DataTable();
                    }
                },
                error: function (response) {
                    alert("Erorr on request!");
                }
            });
        }

        $("#btnFilter").click(function() {
            getScheduleBySchoolYear($("#schoolyear_id").val());
        });

        $("#btnAdd").click(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("Schedule/add"); ?>',
                data: $("#frmSchedule").serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        alert("Schedule addded successfully!");
                        $("#btnFilter").click();
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
            $("#schedule_id").val($(this).attr("data-schedule-id"));
            $("#dateofsched").val($(this).attr("data-dateofsched"));

            $("#btnAdd").attr('disabled','disabled');
            $("#btnUpdate").removeAttr('disabled');
        });

        $("#btnUpdate").click(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("Schedule/update"); ?>',
                data: $("#frmSchedule").serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        alert("Schedule updated successfully!");
                        $("#btnFilter").click();
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
            $("#schedule_id").val("");
            $("#dateofsched").val("");
            
            $("#btnAdd").removeAttr('disabled');
            $("#btnUpdate").attr('disabled','disabled');
        });
    });
</script>