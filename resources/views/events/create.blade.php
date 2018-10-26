<form action="{{ route('event.store') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control">
    </div>

    <div class="form-group">
        <label for="title">Conent</label>
        <input type="text" name="content" class="form-control">
    </div>

    <div class="form-group">
        <label for="featured">Flyer</label>
        <input type="file" name="flyer" class="form-control-file">
    </div>
   
    <div class="form-group">
        <div class="text-center">
            <button class="btn btn-success" type="submit">Submit</button>
        </div>
    </div>
</form>