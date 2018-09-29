<form id="frmQuestion">
    <select name="schoolyear_id" id="schoolyear_id"></select>
    <select name="category_id" id="category_id"></select>
    <input type="text" name="question_id" id="question_id" placeholder="Question ID" readonly>
    <input type="text" name="question" id="question" placeholder="Question">
    <input type="radio" name="answer" id="answer_a" value="a" class="answers"><input type="text" name="choice_a" id="choice_a" placeholder="Choice A" class="choices">
    <input type="radio" name="answer" id="answer_b" value="b" class="answers"><input type="text" name="choice_b" id="choice_b" placeholder="Choice B" class="choices">
    <input type="radio" name="answer" id="answer_c" value="c" class="answers"><input type="text" name="choice_c" id="choice_c" placeholder="Choice C" class="choices">
    <input type="radio" name="answer" id="answer_d" value="d" class="answers"><input type="text" name="choice_d" id="choice_d" placeholder="Choice D" class="choices">

    <button id="btnAdd" type="submit">Add</button>
    <button id="btnUpdate" type="submit" disabled>Update</button>
    <button id="btnCancel" type="button">Cancel</button>
</form>

<table id="tblQuestion" class="datatable-table">
    <thead>
        <tr>
            <th>question</th>
            <th>choice a</th>
            <th>choice b</th>
            <th>choice c</th>
            <th>choice d</th>
            <th>answer</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        getQuestion();
        getCategory();
        getSchoolYear();

        function getQuestion() {
            $(".datatable-table").DataTable().clear().destroy();

            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("Question/get"); ?>',
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
                                            'type="button" class="btnEdit">Edit</button>';
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
        }

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

        function getCategory() {
            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("Category/get"); ?>',
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
                url: '<?php echo base_url("Question/add"); ?>',
                data: $("#frmQuestion").serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        alert("Question addded successfully!");
                        getQuestion();
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
                        getQuestion();
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
            $(".choices").prop("");
            $(".answers").prop("checked",false);
            
            $("#btnAdd").removeAttr('disabled');
            $("#btnUpdate").attr('disabled','disabled');
        });
    });
</script>