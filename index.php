<!DOCTYPE html>
<html>
<head>
    <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css" rel="stylesheet" />

    <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>

    <script type="text/javascript" language="javascript" src="static_assets/index.js?i=<?php echo rand(1, 700); ?>"></script>
</head>
<body>
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>JobTitle</th>
                <th>EmailAddress</th>
                <th>FirstNameLastName</th>
                <th>City</th>
                <th>State</th>
                <th>Phone</th>
                <th>Company</th>
                <th>CollegeName</th>
                <th>Gender</th>
                <th>Department</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>JobTitle</th>
                <th>EmailAddress</th>
                <th>FirstNameLastName</th>
                <th>City</th>
                <th>State</th>
                <th>Phone</th>
                <th>Company</th>
                <th>CollegeName</th>
                <th>Gender</th>
                <th>Department</th>
            </tr>
        </tfoot>
    </table>

    <a href="https://github.com/kschipulring/demo-datatables-chartjs" target="_blank">
        View Github Repo
    </a>

    <h1>Chart.JS Bar Chart</h1>

    <canvas id="barChart" width="400" height="400"></canvas>
    <script>
    renderBarChart("barChart");
    </script>



    
</body>
</html>