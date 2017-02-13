<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="Bookshelf">
    <meta name="author" content="Diego">

    <title>Bookshelf Test</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="/css/bookshelf.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Test Project</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/">Home</a></li>
            <li><a href="/bookshelf">Bookshelf</a></li>
            <li><a href="/music">Music Ranking</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
      <?php echo $this->params['content']; ?> 
    </div>

    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
      $('#bookshelf').DataTable();

      $('.delete').click(function() {
        if(confirm('Do you want to delete')) {
          $.ajax({
            url: '/bookshelf/delete/'+$(this).attr('id'),
            type: 'post',
            success: function() {
              alert('Bookshelf Successfully deleted');
              window.location.replace('/bookshelf');
            },
            error: function() {
              alert('Bookshelf Couldnt be deleted');
            }
          });
        }
      });

      $('.deletebook').click(function() {
        if(confirm('Do you want to delete')) {
          $.ajax({
            url: '/bookshelf/removebook/'+$(this).attr('id'),
            type: 'post',
            success: function() {
              alert('Book Successfully deleted');
              window.location.replace('/bookshelf');
            },
            error: function() {
              alert('Book Couldnt be deleted');
            }
          });
        }
      });
    });
    </script>
  </body>
</html>
