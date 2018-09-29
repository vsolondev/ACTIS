<form id="frmCategory">
    <select name="schoolyear_id" id="schoolyear_id"></select>
    <input type="text" name="category_id" id="category_id" placeholder="Category ID" readonly>
    <input type="text" name="category_name" id="category_name">

    <button id="btnAdd" type="submit">Add</button>
    <button id="btnUpdate" type="submit" disabled>Update</button>
    <button id="btnCancel" type="button">Cancel</button>
</form>

<table id="tblCategory" class="datatable-table">
    <thead>
        <tr>
            <th>category_name</th>
            <th>schoolyear</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        getCategory();
        getSchoolYear();

        function getCategory() {
            $(".datatable-table").DataTable().clear().destroy();

            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("Category/get"); ?>',
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        var tbody = '';

                        response.data.forEach(function(category) {
                            tbody += '<tr>';
                            tbody +=    '<td>';
                            tbody +=        category.category_name;
                            tbody +=    '</td>';
                            tbody +=    '<td>';
                            tbody +=        category.schoolyear;
                            tbody +=    '</td>';
                            tbody +=    '<td>';
                            tbody +=        '<button data-category-id="'+category.category_id+'" data-category-name="'+category.category_name+'" data-schoolyear="'+category.schoolyear+'" data-schoolyear-id="'+category.schoolyear_id+'" type="button" class="btnEdit">Edit</button>';
                            tbody +=    '</td>';
                            tbody += '</tr>';
                        });

                        $("#tblCategory tbody").html(tbody);
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

        $("#btnAdd").click(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("Category/add"); ?>',
                data: $("#frmCategory").serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        alert("Category addded successfully!");
                        getCategory();
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
            $("#category_name").val($(this).attr("data-category-name"));

            $("#btnAdd").attr('disabled','disabled');
            $("#btnUpdate").removeAttr('disabled');
        });

        $("#btnUpdate").click(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url("Category/update"); ?>',
                data: $("#frmCategory").serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        alert("Category updated successfully!");
                        getCategory();
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
            $("#category_id").val("");
            $("#category_name").val("");
            
            $("#btnAdd").removeAttr('disabled');
            $("#btnUpdate").attr('disabled','disabled');
        });
    });
</script>