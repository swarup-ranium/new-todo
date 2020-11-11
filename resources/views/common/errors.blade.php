@if (count($errors) > 0)
    <!-- Form Error List -->
    <div class="alert alert-danger">
        <strong>Whoops! Something went wrong!</strong>

        <br><br>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if ($message = Session::get('success'))

<div class="alert alert-success alert-block">

	<button type="button" class="close" data-dismiss="alert">×</button>	

        <strong>{{ $message }}</strong>

</div>

@endif