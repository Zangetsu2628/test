<div class="starter-template">
  <h1>Music Ranking</h1>
  
  <table id="bookshelf" class="display" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th class="dt-center">Position</th>
        <th class="dt-center">Song</th>
        <th class="dt-center">Artist</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $i = 1;
      foreach($this->params['songs'] as $music):
      ?>
        <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $music['song']; ?></td>
          <td><?php echo $music['artist']; ?></td>
        </tr>
      <?php
      $i++;
      endforeach;
      ?>
    </tbody>
  </table>
</div>