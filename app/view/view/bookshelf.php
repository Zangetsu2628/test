<?php
if(!empty($this->params['save'])):
?>
<div class="container">
  <div class="flash_msg_ok">
    Succesfully Saved!
  </div>
</div>
<?php
endif;
?>

<div class="starter-template">
  <h1>My Bookshelf</h1>
  
  <table id="bookshelf" class="display" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th class="dt-center">Id</th>
        <th class="dt-center">Name</th>
        <th class="dt-center">Options</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach($this->params['shelves'] as $bookshelf):
      ?>
        <tr>
          <td><?php echo $bookshelf['id']; ?></td>
          <td><?php echo $bookshelf['name']; ?></td>
          <td>
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Options <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <li><a href="/bookshelf/view/<?php echo $bookshelf['id']; ?>">View</a></li>
                <li><a href="/bookshelf/edit/<?php echo $bookshelf['id']; ?>">Edit</a></li>
                <li><a href="/bookshelf/addbook/<?php echo $bookshelf['id']; ?>">Add Book to Shelf</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#" id="<?php echo $bookshelf['id']; ?>" class="delete">Delete</a></li>
              </ul>
            </div>
          </td>
        </tr>
      <?php
      endforeach;
      ?>
    </tbody>
  </table>
  <a class="btn btn-default" href="/bookshelf/add" role="button">Add Bookshelf</a>
</div>