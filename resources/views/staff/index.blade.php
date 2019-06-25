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


                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Colour</th>
                            <th>Created</th>
                            <th> </th>
                          </tr>
                        </thead>

                        <tbody>

                            @foreach ($staff as $line )
                            
                            <tr>

                                <td> {{ $line ->name }} </td>

                                <td style='color:{{$line ->colour }}'>Colour </td>

                                <td> {{ $line ->created_at }} </td>

                                <td> <a href="/staff/{{$line->id}}/delete"> delete</a></td>

                            </tr>

                            @endforeach
                        
                        </tbody>

                    </table>

                    {{ $staff ->links() }}

                    <div class="form-group">

                        <button type='button' class='btn btn-info'><a href='/staff/create'>Add Staff</a></button>

                    </div>

                      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection