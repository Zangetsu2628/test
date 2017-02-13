<div class="starter-template">
  <h1>My Bookshelf</h1>
  
  <h4>View <?php echo $this->params['name']; ?></h4>

  <table id="bookshelf" class="display" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th class="dt-center">Name</th>
        <th class="dt-center">Options</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach($this->params['books'] as $book):
      ?>
        <tr>
          <td><?php echo $book['book_name']; ?></td>
          <td>
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Options <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <li><a href="/bookshelf/editbook/<?php echo $book['id']; ?>">Edit Book</a></li>
                <li><a href="#" id="<?php echo $book['id']; ?>" data-shelfid="<?php echo $this->params['shelf_id']; ?>" class="deletebook">Remove Book from Shelf</a></li>
              </ul>
            </div>
          </td>
        </tr>
      <?php
      endforeach;
      ?>
    </tbody>
  </table>
  
  <a class="btn btn-default" href="/bookshelf" role="button">Back</a>
</div>