@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Staff</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif



                    <form class="form-group" method="post" action="\staff">

                      {{ csrf_field() }}

                      <table class="table">
                        <thead>
                          <tr>
                            <th>Field name</th>
                            <th>Data</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Name</td>
                            <td><input type="text" class="form-control" maxlength="30" name="staffname" value='' required/></td>
                          </tr>

                          <tr>
                            <td>Colour</td>
                            <td><input type="color" class="form-control" name="staffcolour" /></td>
                          </tr>

                        </tbody>
                      </table>

                      <div class="form-group">
                   
                        <input type="submit" value="Add" class="btn btn-danger" name="form_action">
                      
                      </div>
                            
                  </form>


                  @include ('partials.errors')

                      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection