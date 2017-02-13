<div class="starter-template">
  <h1>My Bookshelf</h1>
  
  <h4>Add Bookshelf</h4>

  <div class="col-md-6 col-md-offset-3 gap-top">
    <form class="form-horizontal" action="/bookshelf/add/" method="POST" name="bookshelf_add" id="bookshelf_add">
      <div class="form-group">
        <label for="bookshelfName" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="bookshelfName" name="bookshelfName" placeholder="Bookshelf Name">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-12">
          <input type="submit" class="btn btn-default" value="Save" />
        </div>
      </div>
    </form>
    <a class="btn btn-default" href="/bookshelf" role="button">Back</a>
  </div>
</div>