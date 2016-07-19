<?php
    require_once 'inc/init.php';
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Dashboard - Admin</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo basedirhttp; ?>css/bootstrap.min.css" id="basecss">
        <link rel="stylesheet" href="<?php echo basedirhttp; ?>css/main.css">
        <script src="<?php echo basedirhttp; ?>js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>
        <div class="container-fluid">
        	<div class="row">
        		<div class="col-md-4" id="users">
                    <h3>Benutzer:</h3>
                    <div></div>
        		</div>
        		<div class="col-md-4" id="todo">
                    <h3>ToDo:</h3>
                    <div></div>
        		</div>
        		<div class="col-md-4" id="buy">
                    <h3>Einkaufsliste:</h3>
                    <div></div>
        		</div>
        	</div>
            <div class="row">
                <div class="col-md-2">
                    <a href="update.php" class="btn btn-warning btn-block">Update</a>
                </div>
            </div>
        </div>


        <div class="modal fade" id="addTodo" tabindex="-1" role="dialog" aria-labelledby="addTodoLable">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Schließen"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="addTodoLable">ToDo hinzufügen</h4>
              </div>
              <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="todoname" class="control-label">Aufgabe:</label>
                        <input type="text" class="form-control" id="todoname">
                    </div>
                    <div class="form-group">
                        <label for="user" class="control-label">Zu erledigen von:</label>
                        <select id="user_todo" name="user" class="form-control userfill"></select>
                    </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                <button type="button" class="btn btn-primary" id="saveTodoBtn">Speichern</button>
              </div>
            </div>
          </div>
        </div>


        <div class="modal fade" id="addBuy" tabindex="-1" role="dialog" aria-labelledby="addBuyItem">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Schließen"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="addBuyItem">Item hinzufügen</h4>
              </div>
              <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="item" class="control-label">Item:</label>
                        <input type="text" class="form-control" id="item">
                    </div>
                    <div class="form-group">
                        <label for="quantity" class="control-label">Anzahl:</label>
                        <input type="number" class="form-control" id="quantity">
                    </div>
                    <div class="form-group">
                        <label for="user" class="control-label">Von:</label>
                        <select id="user_buy" name="user" class="form-control userfill"></select>
                    </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                <button type="button" class="btn btn-primary" id="saveBuyBtn">Speichern</button>
              </div>
            </div>
          </div>
        </div>


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="<?php echo basedirhttp; ?>js/vendor/bootstrap.min.js"></script>
        <script src="<?php echo basedirhttp; ?>js/main.js"></script>
        <script src="<?php echo basedirhttp; ?>js/admin.js"></script>
    </body>
</html>
