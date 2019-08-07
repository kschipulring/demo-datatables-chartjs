$(document).ready(function() {
    $('#example').DataTable({
        "ajax": "mysql_ajax.php",
        "columns": [
            { "data": "ID" },
            { "data": "JobTitle" },
            { "data": "EmailAddress" },
            { "data": "FirstNameLastName" },
            { "data": "City" },
            { "data": "State" },
            { "data": "Phone" },
            { "data": "Company" },
            { "data": "CollegeName" },
            { "data": "Gender" },
            { "data": "Department" }
        ]
    });
});
