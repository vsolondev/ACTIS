<form id="frmCategory">
    <select name="category_id" id="category_id"></select>
    <button type="submit" id="btnTakeExam">Take Exam</button>
</form>

<form id="frmQuestionsWithAnswers">
    <div id="divQuestionsWithAnswers"></div>
    <button type="submit" id="btnNext">Next</button>
    <button type="submit" class="btn btn-warning btn-sm" id="btnSubmitAnswers">Submit Answers</button>
</form>

<script>
    $(document).ready(function() {
        // tawagon ang ajaxGet para makuha ang is_current
        // if 1 kay e clear else maka take pa sa exam
        getCategoryByActiveSchoolYear();

        function getCategoryByActiveSchoolYear() {
            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("Category/getCategoryByActiveSchoolYear"); ?>',
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

        $("#btnTakeExam").click(function(e) {
            e.preventDefault();
            var category_id = $("#category_id").val();
            displayExamQuestions(category_id);
        });

        function displayExamQuestions(category_id) {
            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("Exam/getExamQuestions"); ?>',
                data: "category_id="+category_id,
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        var html = '';

                        response.questions.forEach(function(question) {
                            html += '<div class="row" id="wrapper_'+question.question_id+'">';
                            html +=    '<div class="col-12">';
                            html +=        question.question;
                            html +=        '<input type="text" name="question_id" value="'+question.question_id+'">';
                            html +=        '<input type="text" name="eqa_id" value="0">';
                            html +=        '<input type="text" name="answer">';
                            html +=    '</div>';
                            html +=    '<div class="col-12">';
                            html +=        '<div class="row">'
                            html +=            '<div class="col-6">';
                            html +=                '<input type="radio" data-question-id="'+question.question_id+'" name="choice_'+question.question_id+'" id="choice_a_'+question.question_id+'" class="choices" value="a">' + '<label for="choice_a_'+question.question_id+'">'+question.choice_a+'</label>';
                            html +=            '</div>';
                            html +=            '<div class="col-6">';
                            html +=                '<input type="radio" data-question-id="'+question.question_id+'" name="choice_'+question.question_id+'" id="choice_b_'+question.question_id+'" class="choices" value="b">' + '<label for="choice_b_'+question.question_id+'">'+question.choice_b+'</label>';
                            html +=            '</div>';
                            html +=        '</div>'
                            html +=    '</div>';
                            html +=    '<div class="col-12">';
                            html +=        '<div class="row">'
                            html +=            '<div class="col-6">';
                            html +=                '<input type="radio" data-question-id="'+question.question_id+'" name="choice_'+question.question_id+'" id="choice_c_'+question.question_id+'" class="choices" value="c">' + '<label for="choice_c_'+question.question_id+'">'+question.choice_c+'</label>';
                            html +=            '</div>';
                            html +=            '<div class="col-6">';
                            html +=                '<input type="radio" data-question-id="'+question.question_id+'" name="choice_'+question.question_id+'" id="choice_d_'+question.question_id+'" class="choices" value="d">' + '<label for="choice_d_'+question.question_id+'">'+question.choice_d+'</label>';
                            html +=            '</div>';
                            html +=        '</div>'
                            html +=    '</div>';
                            html += '</div>';
                        });
                        
                        $("#divQuestionsWithAnswers").html(html);

                        getExamineeAnswers(category_id);
                    } else {
                        alert("Erorr on response!");
                    }
                },
                error: function (response) {
                    alert("Erorr on request!");
                }
            });
        }

        function getExamineeAnswers(category_id) {
            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("Exam/getExamineeAnswers"); ?>',
                data: "category_id="+category_id,
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        response.answers.forEach(function(answer) {
                            var wrapper = $("#wrapper_" + answer.question_id);
                            wrapper.find("input[name=eqa_id]").val(answer.eqa_id);
                            wrapper.find("input[name=answer]").val(answer.answer);
                            wrapper.find("#choice_"+ answer.answer +"_"+ answer.question_id +"").prop("checked", true);
                        });
                    } else {
                        alert("Erorr on response!");
                    }
                },
                error: function (response) {
                    alert("Erorr on request!");
                }
            });
        }

        $(document).on("click", ".choices" ,function() {
            var question_id = $(this).attr("data-question-id");
            var wrapper = $(this).closest("#wrapper_" + question_id);
            
            wrapper.find("input[name=answer]").val($(this).val());
        });

        $("#btnNext").click(function(e) {
            e.preventDefault();

            var json = $("#frmQuestionsWithAnswers").serializeArray();
            var newJson = [];

            json.forEach(function(object) {
                if (object.name.slice(0,6) !== "choice") {
                    newJson.push(object);
                }
            });

            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("Exam/submitPartialAnswers"); ?>',
                data: [
                    { "name": "answers" , "value" : JSON.stringify(newJson) },
                    { "name": "category_id", "value" : $("#category_id").val() }
                ],
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        alert("success");
                    } else {
                        alert("Erorr on response!");
                    }
                },
                error: function (response) {
                    alert("Erorr on request!");
                }
            });
        });

        $("#btnSubmitAnswers").click(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("Exam/endExam"); ?>',
                dataType: 'json',
                success: function (response) {
                    alert("Exam Completed");

                    // E clear ang naa sa exam unya butangan ug thank you.
                    // Dili na ka take balik
                },
                error: function (response) {
                    alert("Erorr on request!");
                }
            });
        });
    });
</script>