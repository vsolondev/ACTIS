<div class="row">
    <div class="col-md-12">
        <form class="form-control" id="frmExamResult">
        <div class="text-primary text-center"><h1>Reports</h1></div>
            <div class="row">
            <div class="col-md-4"></div>
                <div class="col-md-4">
                    <select class="form-control" name="status" id="status">
                        <option value="all">All</option>
                        <option value="0">Did not take exam</option>
                        <option value="1">Failed</option>
                        <option value="2">Passed</option>
                    </select><br/>

                    <select class="form-control" name="lastschool" id="lastschool"></select>
                    <button class="btn btn-primary" type="submit" id="btnFilter">Filter</button>
                </div>            
            <div class="col-md-4"></div>
            </div>
        </form>
    </div>
</div>

<div>
    <button class="dt-button buttons-print" tabindex="0" aria-controls="tblExaminee" type="button"><span>Print</span></button>

    No of students: <span id="numOfStudents"></span>
</div>

<table id="tblExaminee" class="table table-striped table-hover datatable-table">
    <thead>
        <tr>
            <th>Fullname</th>
            <th>Last School</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<script>
    $(document).ready(function() {

        $("#btnPrint").click(function() {
            $('#example').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'print'
                ]
            } );
        });



        $.ajax({
            type: 'ajax',
            method: 'POST',
            url: '<?php echo base_url("ExamResult/getUniqueSchool"); ?>',
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    var html = '<option value="all">All</option>';

                    response.schools.forEach(function(school) {
                        html += '<option value="'+school.lastschool+'">'+school.lastschool+'</option>'
                    });

                    $("#lastschool").html(html);
                } else {
                    alert("Erorr on response!");
                }
            },
            error: function (response) {
                alert("Erorr on request!");
            }
        });


        $("#btnFilter").click(function(e) {
            e.preventDefault();
            $('#tblExaminee').DataTable().clear().destroy();

            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("ExamResult/filterExaminee"); ?>',
                data: $("#frmExamResult").serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        var html = '';

                        $("#numOfStudents").text(response.examinees.length);

                        response.examinees.forEach(function(examinee) {
                            var status = "";
                            if (examinee.status === "0") {
                                status = "Did not take exam"; 
                            } else if (examinee.status === "1") {
                                status = "Failed";
                            } else {
                                status = "Passed";
                            }

                            html += '<tr>';
                            html +=     '<td>';
                            html +=         examinee.fullname;
                            html +=     '</td>';
                            html +=     '<td>';
                            html +=         examinee.lastschool;
                            html +=     '</td>';
                            html +=     '<td>';
                            html +=         status;
                            html +=     '</td>';
                            html += '</tr>';
                        });

                        $("#tblExaminee tbody").html(html);
                        $('#tblExaminee').DataTable();
                    }
                },
                error: function (response) {
                    alert("Erorr on request!");
                }
            });
        });
    });
</script>