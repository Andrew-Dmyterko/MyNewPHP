<!DOCTYPE html>
<html lang="en">

    <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>{TITLE}</title>
       <!-- Подключаем Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap-4.5.3-dist/css/bootstrap.min.css" >
    </head>

    <body>

        <nav class="navbar navbar-default navbar-fixed-top alert alert-primary " style="background-color: #e9ecef" role="navigation">

          <div class="container-fluid">
              <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                      <span class="sr-only">Меню</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
                  <a href="index.php" class="navbar-brand">{HEADER}</a>
                </div>

              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                       <li><a href="index.php?page=main">{HOME}</a></li>
                       <li><a href="index.php?page=about">{ABOUT}</a></li>
                       <li><a href="index.php?page=contact">{CONTACT}</a></li>
                       <li><a href="index.php?page=book">{BOOK}</a></li>
                  </ul>
              </div>
        </div>

        </nav>

        <div class="container">
            <h1>{HEADER}</h1>
             {CONTENT}
        </div>
<?php echo"efdegrg";?>
        <br>

        <div class="alert alert-primary" style="background-color: #e9ecef">
             <footer>
                <h6>
                    <span><b>-- by sky_fox</b>  <br>  e-mail: andrew.dmyterko@gmail.com; sky_fox123@ukr.net</span>
                </h6>
           </footer>
        </div>

        <!-- Подключаем jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Подключаем Bootstrap JS -->
        <script src="css/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
    </body>
</html>