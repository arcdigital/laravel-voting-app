<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CWDG Voting</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/bootstrap-social.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
            <ul class="nav navbar-nav">
                <a class="navbar-brand" href="#">CWDG Voting</a>
            </ul>
            @if (Auth::check())
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Logged in as {{Auth::user()->github_username}} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="/logout">Logout</a></li>
                        @if (Auth::user()->is_admin)
                        <li class="divider"></li>
                        <li class="dropdown-header">Admin Stuff</li>
                        <li><a href="#">Nothing Yet.</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
            @endif
    </div>
</div>

<div class="container">

    @if (!Auth::check())
    <div class="jumbotron">
        <h1>Welcome!</h1>
        <p class="lead">You must be a member of the CWDG organization on GitHub to use this application. If you aren't, please contact <a href="http://github.com/tarebyte">Mark</a>.</p>
        <p><a href="/login" class="btn btn-block btn-lg btn-social btn-github"><i class="fa fa-github"></i> Login with GitHub</a></p>
    </div>
    @endif


    <div class="footer">
        <p>&copy; CWDG 2014</p>
    </div>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<!-- Placed at the end of the document so the pages load faster -->
</body>
</html>