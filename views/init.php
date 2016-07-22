<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Eduard Roccatello">
    <title>Static DHCP and DNS editor</title>
    <link href="lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="lib/bootstrap3-dialog/dist/css/bootstrap-dialog.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Static DHCP DNS editor</a>
        </div>

        <form class="navbar-form navbar-left">
          <a class="btn btn-primary" href="#" role="button" id="new-host"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add host</a>
        </form>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="logout">Logout</a></li>
        </ul>
        <form class="navbar-form navbar-right">
          <a class="btn btn-danger" href="#" role="button" id="generate-configuration">Generate configuration</a>
        </form>
      </div>
    </nav>

    <div class="container">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Hostname</th>
            <th>Domain</th>
            <th>IPv4</th>
            <th>PTR</th>
            <th>DHCP</th>
            <th>HW Address</th>
            <th>Tools</th>
          </tr>
        </thead>
        <tbody>
<?php $i = 1; foreach ($hosts as $h) : ?>
          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $h['hostname']; ?></td>
            <td><?php echo $h['domain']; ?></td>
            <td><?php echo $h['ipv4']; ?></td>
            <td><span class="glyphicon glyphicon-<?php echo $h['ptr'] == 1 ? 'ok' : 'remove'; ?>" aria-hidden="true"></span></td>
            <td><span class="glyphicon glyphicon-<?php echo $h['dhcp'] == 1 ? 'ok' : 'remove'; ?>" aria-hidden="true"></span></td>
            <td><?php echo $h['hwaddr']; ?></td>
            <td>
              <button type="button" class="btn btn-warning btn-sm edit-host" data-id="<?php echo $h['id']; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
              <button type="button" class="btn btn-danger btn-sm delete-host" data-host="<?php echo $h['hostname']; ?>" data-id="<?php echo $h['id']; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
            </td>
          </tr>
<?php endforeach; ?>
        </tbody>
      </table>
    </div>

<div class="modal fade" id="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Host</h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="modal-save">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="lib/jquery/dist/jquery.min.js"></script>
    <script src="lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="lib/bootstrap3-dialog/dist/js/bootstrap-dialog.min.js"></script>
    <script src="lib/bootstrap-validator/dist/validator.min.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
