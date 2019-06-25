@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">New Schedule Entry</div>

                        <div class="card-body">

                        @if (session('status'))

                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
        
                        @endif



                        <form class="form-group" method="post" action="\schedule">

                            {{ csrf_field() }}

                            <input type="hidden" name="client_id" value='{{$cid}}' />

                            <table class="table">

                                <thead>

                                    <tr>
                                    <th>Field name</th>
                                    <th>Data</th>
                                    </tr>

                                </thead>

                                <tbody>
    
                                    <tr>
    
                                    <td>Day</td>
    
                                    <td>
                                        {{ Form::select('day', $daysofweek, NULL, ['class' => 'form-control'] ) }}
                                    </td>

                                    </tr>
                                    
                                    <tr>
                                        <td>Time</td>
                                        <td>
                                        <input type="time" class="form-control" maxlength="10" name="time" value='' />
                                        </td>
                                    </tr>

                                    <tr>

                                        <td>Duration</td>
                                        <td>
                                        {{ Form::select('duration', $apt_durations, NULL, ['class' => 'form-control'] ) }}      
                                        </td>

                                    </tr>

                                    <td>Assign Staff</td>
    
                                    <td>
                                        {{ Form::select('staff_id', $staff, NULL, ['class' => 'form-control'] ) }}
                                    </td>

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