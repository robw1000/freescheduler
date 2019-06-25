@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Client</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <form class="form-group" method="post" action="\client">

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
                            <td><input type="text" class="form-control" maxlength="30" name="clientname" value='' required/></td>
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