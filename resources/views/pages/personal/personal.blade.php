<!DOCTYPE html>
<html>
<head>
    <title>Personal Information</title>
</head>
<body>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>

<form action="{{route('personalInfo.update')}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div class="form-group">
        <label for="inputAddress2">Admin Name</label>
        <input name="name" type="text" value={{$personalInfo['name']}}  class="form-control" >
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input name="Email" type="email" value={{$personalInfo['Email']}} class="form-control"
               id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    </div>

    <div class="form-group">
        <label for="inputAddress">Country</label>
        <input name="country" type="text" value={{$personalInfo['country']}} class="form-control" id="inputAddress" >
    </div>
    <div class="form-group">
        <label for="inputAddress2">City</label>
        <input name="city" type="text" value={{$personalInfo['city']}}  class="form-control" >
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputCity">Age</label>
            <input name="age" type="number" value={{$personalInfo['age']}} class="form-control">
        </div>
    </div>

        <div>
            <label class="form-label" for="customFile">Default file input example</label>
            <input name="photo" value={{$personalInfo['photo']}} type="file" class="form-control" id="customFile" />

        </div>

    <div>
        <img src='{{URL::asset('personal_info/'.$personalInfo['photo'])}}'
              alt="This is something wrong"
              style= "width: 10%;
              height: 140px;
              background-repeat: no-repeat;
              background-size: contain;
              border: 1px solid red;">
    </div> <br>

 <div>
    <button type="submit" class="btn btn-primary mb-2">Update Personal Info</button>
</div>

</form>
</body>
</html>
