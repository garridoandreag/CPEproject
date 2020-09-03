@extends('layouts.app')

@section('content')
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/calendar/main.js') }}"></script>
  <script src="{{ asset('js/calendar/locales/es.js') }}"></script>
  <link href="{{ asset('js/calendar/main.min.css') }}" rel='stylesheet' />
  <script>
    function loadCalendar() {
      var calendarEl = document.getElementById('calendar')
      var calendar = new FullCalendar.Calendar(calendarEl, {
        eventClick: function(info) {
          alert('Event: ' + info.event.title);
          alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
          alert('View: ' + info.view.type);

          // change the border color just for fun
          info.el.style.borderColor = 'red';
        },
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
        droppable: true,
        initialView: ['dayGridMonth'],
        locale: 'es',
        dayMaxEventRows: true,
        views: {
          dayGridMonth: {
            dayMaxEventRows: 3
          }
        },
        events: [{
            title: 'event1',
            start: '2020-08-31'
          },
          {
            title: 'event2',
            start: '2020-08-31',
            end: '2020-08-07'
          },
          {
            title: 'event5',
            start: '2020-08-31',
            end: '2020-08-07'
          },
          {
            title: 'event8',
            start: '2020-08-31',
            end: '2020-08-07'
          },
          {
            title: 'event3',
            start: '2020-08-02',
            allDay: true // will make the time show
          }
        ]
      })
      calendar.render()
    }
    document.addEventListener('DOMContentLoaded', function() {
      loadCalendar()
    })

  </script>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            Eventos
          </div>
          <div class="card-body">
            <div id="calendar"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
      events: [{
          title: 'event1',
          start: '2020-08-31'
        },
        {
          title: 'event2',
          start: '2020-08-31',
          end: '2020-09-07'
        },
        {
          title: 'event3',
          start: '2020-09-02T12:30:00',
          allDay: false // will make the time show
        }
      ]
    });

  </script>
@endsection
