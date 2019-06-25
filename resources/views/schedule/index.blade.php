@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $client->name }} - Schedule</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Day</th>
                            <th>Time</th>
                            <th>Duration</th>
                            <th>Staff</th>
                            <th> </th>
                          </tr>
                        </thead>

                        <tbody>

                            @foreach ($schedule as $line)
                            
                            <tr>

                                <td> {{ $line ->day }} </td>

                                <td> {{ $line ->time }} </td>                                

                                <td> {{ $line ->duration }} </td>

                                <td style='color:{{$line["staff"] ->colour }}'> {{ $line["staff"] ->name }} </td>

                                <td> <a href="/schedule/{{$line->id}}/delete"> delete</a></td>

                            </tr>

                            @endforeach
                        
                        </tbody>

                    </table>

                    <div class="form-group">

                        <button type='button' class='btn btn-info'><a href='/schedule/{{$client->id}}/create'>Add Entry</a></button>

                    </div>

                      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection