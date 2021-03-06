@extends('layouts.app')

@section ('extraheader')

<link href="{{ asset('/css/fullcalendar.css') }}" rel="stylesheet">

<!--
<link href="/css/fullcalendar.print.min.css" rel="stylesheet">

<link href="{{ asset('/css/scheduler.min.css') }}" rel="stylesheet">
!-->

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Planner</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div id='calendar'></div>

                      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section ('extrafooter')

<script src="{{ asset('/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('/js/moment.min.js') }}"></script>

<script src="{{ asset('/js/fullcalendar.min.js') }}"></script>

<script type="text/javascript">

  $(document).ready(function() {

    $('#calendar').fullCalendar({
      themeSystem: 'standard',
      header: {
        left: 'prev,next,today',
        center: 'title',
        right: 'agendaWeek,agendaDay,month,listWeek'
      },

      businessHours: {
            start: '07:00',
            end:   '22:00',
            dow: [ 0, 1, 2, 3, 4, 5, 6]
      },
      height: 600,
      slotDuration: '00:15:00',
      firstDay: 1,
      droppable: true,
      editable: true,
      defaultView: 'agendaWeek',
      defaultDate: '{{ $defaultdate }}',
      navLinks: true, // can click day/week names to navigate views
      eventLimit: true, // allow "more" link when too many events
      events: {!! json_encode($events) !!}

        });


  });


</script>


@endsection

