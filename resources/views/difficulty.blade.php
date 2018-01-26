    @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Start Playing</div>

                <div class="panel-body">
                    <form action="#">

                        <div class="row">
                            <div class="col-md-4">
                                <label class="radio-inline">
                                  <input type="radio" name="difficulty" id="easy" value="option1">
                                  <strong class="text-success">Easy</strong>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="radio-inline">
                                  <input type="radio" name="difficulty" id="normal" value="option2">
                                  <strong class="text-primary">Normal</strong>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="radio-inline">
                                  <input type="radio" name="difficulty" id="hard" value="option3">
                                  <strong class="text-danger">Hard</strong>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-default" type="submit"><i class="fa fa-play"></i> start now</button>
                        </div>

                    </form>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
