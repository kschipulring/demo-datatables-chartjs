<?php
require_once 'main_include.php';

//for the plugin
$data_cols = array_map(function($n){
	return [ "data" => $n ];
}, $cols);

//html table columns
$table_cols = array_map(function($n){
	return "<th>{$n}</th>";
}, $cols);

$css_files = array_map(function($u){
	return "\t<link href=\"{$u}\" rel=\"stylesheet\" />\n";
}, [
    "//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css",
    "//maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css",
    "//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css"
]);

$js_files = array_map(function($u){
	return "\t<script type=\"text/javascript\" language=\"javascript\" src=\"{$u}\"></script>\n";
}, [
    "//code.jquery.com/jquery-3.3.1.js",
    "//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js",
    "//maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js",
    "//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js",
    "static_assets/index.js?i=" . rand(1, 700),
]);
?>
<!DOCTYPE html>
<html>
<head>
<?= implode("", $css_files); ?>

<?= implode("", $js_files); ?>

    <script>
    window.data_cols = <?= json_encode( $data_cols, true ); ?>;
    </script>
</head>
<body>
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <?= implode("", $table_cols); ?>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <?= implode("", $table_cols); ?>
            </tr>
        </tfoot>
    </table>

    <a href="https://github.com/kschipulring/demo-datatables-chartjs" target="_blank">
        View Github Repo
    </a>

    <h1>Chart.JS Bar Chart</h1>

    <canvas id="barChart" width="400" height="400"></canvas>
    
    <button id="randomizeData">Randomize Data</button>
    
    <h1>Chart.JS Pie Chart</h1>

	<div id="canvas-holder-pie">
		<canvas id="chart-area-pie"></canvas>
    </div>
    
    <script>
    renderBarChart("barChart");

    renderPieChart("canvas-holder-pie", "canvas-area-pie");
    </script>

</body>
</html>