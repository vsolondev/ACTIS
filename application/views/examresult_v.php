<form id="frmExamResult">
    <select name="status" id="status">
        <option value="all">All</option>
        <option value="0">Did not take exam</option>
        <option value="1">Failed</option>
        <option value="2">Passed</option>
    </select>

    <select name="lastschool" id="lastschool"></select>

    <button type="submit" id="btnFilter">Filter</button>
</form>

<table id="tblExaminee" class="table table-striped table-hover datatable-table">
    <thead>
        <tr>
            <th>Fullname</th>
            <th>lastschool</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<script>
    $(document).ready(function() {
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