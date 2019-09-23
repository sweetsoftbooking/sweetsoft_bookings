@extends('admin.layout.main')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Calendar</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Calendar</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <div class="sticky-top mb-3">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Draggable Events</h4>
              </div>
              <div class="card-body">
                <!-- the events -->
                <div id="external-events">

                  <div class="checkbox">
                    <label for="drop-remove">
                      <input type="checkbox" id="drop-remove">
                      remove after drop
                    </label>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Create Event</h3>
              </div>
              <div class="card-body">
                <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                  <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                  <ul class="fc-color-picker" id="color-chooser">
                    <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                    <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                    <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                    <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                    <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                  </ul>
                </div>
                <!-- /btn-group -->
                <div class="input-group">
                  <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                  <div class="input-group-append">
                    <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                  </div>
                  <!-- /btn-group -->
                </div>
                <!-- /input-group -->
              </div>
            </div>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card card-primary">
            <div class="card-body p-0">
              <!-- THE CALENDAR -->

              <div id="calendar" data-get-listing="{{ route('bookings.listing') }}"></div>

              <div id="datepicker"></div>

              <div class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">

                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Create new event</h4>
                    </div>

                    <div class="modal-body">
                      <div class="row">
                        <div class="col-xs-12">
                          <label class="col-xs-4" for="title">Event title</label>
                          <input type="text" name="title" id="title" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12">
                          <label class="col-xs-4" for="starts-at">Starts at</label>
                          <input type="text" name="starts_at" id="starts-at" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12">
                          <label class="col-xs-4" for="ends-at">Ends at</label>
                          <input type="text" name="ends_at" id="ends-at" />
                        </div>
                      </div>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal" id="close-event">Close</button>
                      <button type="button" class="btn btn-primary" id="save-event">Save changes</button>
                    </div>

                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection

@section('script')
<script src="public/js/moment.js"></script>
<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/


    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)

    var Calendar = FullCalendar.Calendar;

    var calendarEl = document.getElementById('calendar');

    // initialize the external events
    // -----------------------------------------------------------------



    var calendar = new Calendar(calendarEl, {
      plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'addEventButton,dayGridMonth,timeGridWeek,timeGridDay'
      },
      select: function (start, end) {
        // Display the modal.
        // You could fill in the start and end fields based on the parameters
        $('.modal').modal('show');

      },

      
      droppable: false, // this allows things to be dropped onto the calendar !
      selectable: false,
      selectHelper: true,
      editable: true,
      eventLimit: true,
      //Random default events
      customButtons: {
        addEventButton: {
          text: 'add event...',
          click: function () {
            $('.modal').modal('show');
          }
        }
      },
      events: function (info, successCallback, failureCallback) {
        $.ajax({
          url: $('#calendar').data('get-listing'),
          type: 'GET',
          dataType: 'json',
          data: {
            start: info.start.valueOf(),
            end: info.end.valueOf()
          },
          success: function (response) {
            
            if(response.error == false){
              let events = [];
              const data = response.data
              data.map(function( val ) {
                events.push({
                  id: val.id,
                  title: val.title,
                  start: val.start_date,
                  end: val.end_date,
                  backgroundColor: '#f39c12', //yellow
                  borderColor    : '#f39c12' //yellow
                })
              });
              successCallback(events)
             
            }else{
              alert(response.message)
            }
            
           
          },
          error: function (response) {
            console.log(response)
          }
        });
      },

      eventClick: function(info) {
        // alert('Event: ' + info.event.title);
        
        $('.modal').modal('show');
        
        $('.modal').find('#title').val(info.event.title);
        $('.modal').find('#starts-at').val(moment(info.event.start).format('DD-MM-YYYY, HH:mm:ss '));
        $('.modal').find('#ends-at').val(moment(info.event.end).format('DD-MM-YYYY, HH:mm:ss '));

      }


      // this allows things to be dropped onto the calendar !!!

    });
    
    $('#save-event').on('click', function () {
      var title = $('#title').val();
      if (title) {
        var eventData = {
          title: title,
          start: $('#starts-at').val(),
          end: $('#ends-at').val()
        };
        calendar.addEvent(eventData);
        $('.modal').modal('hide');
        // $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
      }
    });

    $('#close-event').on('click', function () {
      $('.modal').find('input').val('');
    });

    


    // Clear modal inputs

    // hide modal
    $('.modal').modal('hide');

    calendar.render();
    // $('#calendar').fullCalendar()

    /* ADDING EVENTS */


  })

</script>
@endsection