@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Clients</div>

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
                            <th>Created</th>
                            <th> </th>
                            <th> </th>
                          </tr>
                        </thead>

                        <tbody>

                            @foreach ($client as $line )
                            
                            <tr>

                                <td> {{ $line ->name }} </td>

                                <td> {{ $line ->created_at }} </td>

                                <td> <a href="/schedule/{{$line->id}}"> schedule</a></td>

                                <td> <a href="/client/{{$line->id}}/delete"> delete</a></td>

                            </tr>

                            @endforeach
                        
                        </tbody>

                    </table>

                    {{ $client ->links() }}

                    <div class="form-group">

                        <button type='button' class='btn btn-info'><a href='/client/create'>Add Client</a></button>

                    </div>

                      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection