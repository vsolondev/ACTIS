<div class="row">
    <div class="col-md-12">
    <form class="form-control" id="frmQuestion">
    <div class="text-primary text-center"><h1>Add and Update Questions</h1></div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <select class="form-control" name="schoolyear_id" id="schoolyear_id"></select><br/>
            <select class="form-control" name="category_id" id="category_id"></select><br/>
            <button class="btn btn-primary" id="btnFilter" type="button">Filter</button>
            <input class="form-control" type="text" style="display:none" name="question_id" id="question_id" placeholder="Question ID" readonly><br/>
            <label>Question</label><input class="form-control" type="text" name="question" id="question" placeholder="Question"><br/>
            <input type="radio" name="answer" id="answer_a" value="a" class="answers"><input class="form-control" type="text" name="choice_a" id="choice_a" placeholder="Choice A" class="choices"><br/>
            <input type="radio" name="answer" id="answer_b" value="b" class="answers"><input class="form-control" type="text" name="choice_b" id="choice_b" placeholder="Choice B" class="choices"><br/>
            <input type="radio" name="answer" id="answer_c" value="c" class="answers"><input class="form-control" type="text" name="choice_c" id="choice_c" placeholder="Choice C" class="choices"><br/>
            <input type="radio" name="answer" id="answer_d" value="d" class="answers"><input class="form-control" type="text" name="choice_d" id="choice_d" placeholder="Choice D" class="choices"><br/>

            <button class="btn btn-primary" id="btnAdd" type="submit">Add</button>
            <button class="btn btn-primary" id="btnUpdate" type="submit" disabled>Update</button>
            <button class="btn btn-danger" id="btnCancel" type="button">Cancel</button>
        </div>
        <div class="col-md-4"></div>
    </div>
    </form>
    <table id="tblQuestion" class="table table-striped table-hover datatable-table">
    <thead>
        <tr>
            <th>Question</th>
            <th>Choice A</th>
            <th>Choice B</th>
            <th>Choice C</th>
            <th>Choice D</th>
            <th>Answer</th>
            <th>Action</th>
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

        function getCategoryBySchoolYear(schoolyear_id) {
            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("Category/getCategoryBySchoolYear"); ?>',
                data: "schoolyear_id="+schoolyear_id,
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        var options = '';

                        response.data.forEach(function(category) {
                            options +=  '<option value="'+category.category_id+'">';
                            options +=      category.category_name;
                            options +=  '</option>';
                        });

                        $("#category_id").html(options);
                    }
                },
                error: function (response) {
                    alert("Erorr on request!");
                }
            });
        }

        $("#schoolyear_id").change(function() {
            getCategoryBySchoolYear($(this).val());
        });

        $("#btnFilter").click(function() {
            $(".datatable-table").DataTable().clear().destroy();

            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("Question/filter"); ?>',
                data: [
                    { "name": "schoolyear_id", "value": $("#schoolyear_id").val() },
                    { "name": "category_id", "value": $("#category_id").val() }
                ],
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        var tbody = '';

                        response.data.forEach(function(question) {
                            tbody += '<tr>';
                            tbody +=    '<td>';
                            tbody +=        question.question;
                            tbody +=    '</td>';
                            tbody +=    '<td>';
                            tbody +=        question.choice_a;
                            tbody +=    '</td>';
                            tbody +=    '<td>';
                            tbody +=        question.choice_b;
                            tbody +=    '</td>';
                            tbody +=    '<td>';
                            tbody +=        question.choice_c;
                            tbody +=    '</td>';
                            tbody +=    '<td>';
                            tbody +=        question.choice_d;
                            tbody +=    '</td>';
                            tbody +=    '<td>';
                            tbody +=        question.answer;
                            tbody +=    '</td>';
                            tbody +=    '<td>';
                            tbody +=        '<button' +
                                            ' data-schoolyear-id="' + question.schoolyear_id + '" ' +
                                            ' data-category-id="' + question.category_id + '" ' +
                                            ' data-question-id="' + question.question_id + '" ' +
                                            ' data-question="' + question.question + '" ' +
                                            ' data-choice-a="' + question.choice_a + '" ' +
                                            ' data-choice-b="' + question.choice_b + '" ' +
                                            ' data-choice-c="' + question.choice_c + '" ' +
                                            ' data-choice-d="' + question.choice_d + '" ' +
                                            ' data-answer="' + question.answer + '" ' +
                                            'type="button" class="btnEdit btn btn-secondary">Edit</button>';
                            tbody +=    '</td>';
                            tbody += '</tr>';
                        });

                        $("#tblQuestion tbody").html(tbody);
                        $(".datatable-table").DataTable();
                    }
                },
                error: function (response) {
                    alert("Erorr on request!");
                }
            });
        });

        $("#btnAdd").click(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("Question/add"); ?>',
                data: $("#frmQuestion").serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        alert("Question addded successfully!");
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
            $("#category_id").val($(this).attr("data-category-id"));
            $("#question_id").val($(this).attr("data-question-id"));
            $("#question").val($(this).attr("data-question"));
            $("#choice_a").val($(this).attr("data-choice-a"));
            $("#choice_b").val($(this).attr("data-choice-b"));
            $("#choice_c").val($(this).attr("data-choice-c"));
            $("#choice_d").val($(this).attr("data-choice-d"));
            
            $("#answer_" + $(this).attr("data-answer")).prop("checked", true);

            $("#btnAdd").attr('disabled','disabled');
            $("#btnUpdate").removeAttr('disabled');
        });

        $("#btnUpdate").click(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("Question/update"); ?>',
                data: $("#frmQuestion").serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        alert("Question updated successfully!");
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
            $("#question_id").val("");
            $("#question").val("");
            $(".choices").val("");
            $(".answers").prop("checked",false);
            
            $("#btnAdd").removeAttr('disabled');
            $("#btnUpdate").attr('disabled','disabled');
        });
    });
</script>