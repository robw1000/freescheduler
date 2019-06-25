@extends('layouts.app')

@section ('extraheader')

<link href="{{ asset('/css/fullcalendar.css') }}" rel="stylesheet">

<!--
<link href="/css/fullcalendar.print.min.css" rel="stylesheet">
!-->

<link href="{{ asset('/css/scheduler.min.css') }}" rel="stylesheet">


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
<script src='/js/scheduler.min.js'></script>

<script>

  $(document).ready(function() {

    var calendar = $('#calendar').fullCalendar({
      themeSystem: 'standard',
      schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'agendaWeek,agendaDay,month,listWeek'
      },
      height: 600,
      allDaySlot: false,
      businessHours: {
            start: '07:00',
            end:   '22:00',
            dow: [ 0, 1, 2, 3, 4, 5, 6]
      },
      firstDay: 1,
      defaultView: 'agendaDay',
      defaultDate: '{{ $defaultdate }}',
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      eventStartEditable: false, //dont allow times to change
      eventDurationEditable: false,
      eventDrop:function(event, delta, revertFunc) {
        $.ajaxSetup({
           headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
        });

        $.ajax({
          type: "POST",
          url: "/schedule/update",
          data: "staff_id="+ event.resourceId+"&id="+ event.id,
          success: function(data) {
            alert(data.success);
           //
          },
          error: function(data){ 
            alert("Not able to move appointment");
            revertFunc()
          }
        });
      },
      resources: {!! json_encode($staff) !!},
      events: {!! json_encode($events) !!}
    });

  });

</script>

@endsection

