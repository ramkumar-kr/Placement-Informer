<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>datepicker demo</title>
    <style>
        body{background-color:white;}
    </style>
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css1/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <script src="js/bootstrap.js"></script>
    <script src="js1/bootstrap-datetimepicker.min.js"></script>
    <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
        </script>
    </div>
</div>

</body>
</html>