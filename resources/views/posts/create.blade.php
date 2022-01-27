<!DOCTYPE html>
<html lang="en">
<head>
  <title>create Post</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
   @endif

  <h2> New Post </h2>


  <form action="{{url('/post')}}" method="post" enctype="multipart/form-data">

    @csrf

    <div class="form-group">


        <div class="form-group">
            <label for="exampleInputName">Image</label>
            <input type="file" name="image">
        </div>


        <label for="exampleInputName">caption</label>
        <textarea type="text" class="form-control" id="exampleInputName" name="caption" aria-describedby=""
            placeholder="Enter Title">{{old('caption')}}</textarea>
    </div>


    <div class="form-group">
        <label for="exampleInputName"> date</label>
        <input type="date"  class="form-control" id="exampleInputName" name="date" value={{old('date')}}>
    </div>
    <div class="form-group">
        <label for="exampleInputName">addedBy</label>
        <input type="text"  class="form-control" id="exampleInputName" name="addedBy" value={{old('addedBy')}}>
    </div>






    <button type="publish" class="btn btn-primary">Submit</button>
</form>




</div>

</body>
</html>
