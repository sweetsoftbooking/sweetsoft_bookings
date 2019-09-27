@extends('admin.layout.main')

@section('content')
<style>
  label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: 700;
    padding: 10px !important;
    justify-content: left !important;
  }
</style>

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
              @if(session('alert'))
              <div class="col-md-8 alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5> {{session('alert')}}</h5>
              </div>
              @endif
              <div id="calendar" data-get-listing="{{ route('bookings.listing') }}"></div>

              <!-- <div id="datepicker"></div> -->


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
<div class="modal fade" id="orangeModalSubscription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-warning" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header text-center">
        <h4 class="modal-title white-text w-100 font-weight-bold py-2">Create Booking</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>

      <form>

        <!--Body-->
        <div class="modal-body">

          <!-- *error message -->

          <div class="col-md-12 form-group">
            <p style="color:orangered" id="message_error"></p>
          </div>


          <!-- *input TITLE -->

          <div class="col-md-12 form-group">
            <label class="col-sm-12" for="name">Title</label>
            <input type="text" class="form-control col-sm-7" name="title" id="title">
          </div>


          <!-- *input PEOPLE -->

          <div class="col-md-12 form-group">
            <label class="col-sm-12 people" for="name">Number of People</label>
            <input type="number" class="form-control col-sm-7" name="people" id="people" min="1" max="300">
            <style>
              .people {
                padding: 0px 0px 0px 10px !important;
              }
            </style>
          </div>


          <!-- *input START-END -->

          <div class="form-group">
            <label>Date and time range:</label>

            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-calendar"></i></span>
              </div>
              <input type="text" class="form-control float-right" id="reservationtime" autocomplete="off">

              <input type="hidden" id="start" name="start">
              <input type="hidden" id="end" name="end">

            </div>
            <!-- /.input group -->
          </div>

          <!-- *input ROOM -->

          <div class="form-group">
            <label>Room</label>
            <div class="input-group">
              <select name="room" class="form-control" id="room">
                <option>--- List Room ---</option>
                <!-- @foreach($rooms as $r)
                                    <option value="{{$r->id}}">{{$r->name}}</option>
                                    @endforeach -->
              </select>
              <button type="button" style="font-size: 15px" class="btn btn-primary form-control col-sm-2"
                id="check_room">Select</button>
            </div>

          </div>


          <!-- *input CONTENT -->

          <div class="col-md-12 form-group">
            <label class="col-sm-12" for="name">Content</label>
            <textarea class="form-control col-sm-7 input" rows="5" cols="10" name="content" id="content"></textarea>
          </div>

        </div>

        <!-- !Footer-->
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-default" data-dismiss="modal" id="close-event">Close</button>
          <button type="button" class="btn btn-primary" id="save-event">Save</button>
        </div>
      </form>

    </div>
    <!--/.Content-->
  </div>
</div>
@endsection

@section('script')
<script src="public/js/moment.js"></script>

<script>
  $(function () {

    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      parentEl: '#orangeModalSubscription',
      autoUpdateInput: false,
      timePicker: true,
      timePickerIncrement: 15,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    }, function (start, end, label) {
      $('#start').val(start.format('DD-MM-YYYY HH:mm'));
      $('#end').val(end.format('DD-MM-YYYY HH:mm'));

      console.log("A new date selection was made: " + start.format('DD-MM-YYYY HH:mm') + ' to ' + end.format('DD-MM-YYYY HH:mm'));
    })
    $('#reservationtime').on('apply.daterangepicker', function (ev, picker) {
      $(this).val(picker.startDate.format('DD-MM-YYYY HH:mm') + ' - ' + picker.endDate.format('DD-MM-YYYY HH:mm'));
    });

    $('#reservationtime').on('cancel.daterangepicker', function (ev, picker) {
      $(this).val('');
    });

  })
</script>
<script>
  $(function () {
    var Calendar = FullCalendar.Calendar;
    var calendarEl = document.getElementById('calendar');

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

      droppable: false, /* this allows things to be dropped onto the calendar ! */
      selectable: false, // TODO: true => config
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
        console.log(info);
        $.ajax({
          url: $('#calendar').data('get-listing'),
          type: 'GET',
          dataType: 'json',
          data: {
            start: info.startStr,
            end: info.endStr
          },
          success: function (response) {
            if (response.error == false) {
              let events = [];
              const data = response.data
              data.map(function (val) { // map == foreach
                events.push({
                  id: val.id,
                  title: val.title,
                  start: moment(val.from_datetime).format('YYYY-MM-DD HH:mm:ss'),
                  end: moment(val.to_datetime).format('YYYY-MM-DD HH:mm:ss'),
                  backgroundColor: 'green', //yellow

                })
              });
              successCallback(events)
            } else {
              alert(response.message)
            }
          },
          error: function (response) {
            console.log(response)
          }
        });
      },

      eventClick: function (info) {
        $('.modal').modal('show');
        $('.modal').find('#title').val(info.event.title);
        $('.modal').find('#starts-at').val(moment(info.event.start).format('DD-MM-YYYY, HH:mm:ss '));
        $('.modal').find('#ends-at').val(moment(info.event.end).format('DD-MM-YYYY, HH:mm:ss '));
      }
    });

    // $('#save-event').on('click', function () {
    //   var title = $('#title').val();
    //   if (title) {
    //     event = {
    //       title: title,
    //       start: $('#starts-at').val(),
    //       end: $('#ends-at').val()
    //     };

    //     calendar.addEvent(event);
    //     $('.modal').modal('hide');


    //   }
    // });

    $('#close-event').on('click', function () {
      $('.modal').find('input').val('');
    });

    // hide modal
    $('.modal').modal('hide');
    calendar.render();

    $('#check_room').on('click', function () {
      // alert('ok');

      var start = $('#start').val();
      var end = $('#end').val();
      var people = $('#people').val();

      const from = moment(start, 'DD-MM-YYYY HH:mm');
      const to = moment(end, 'DD-MM-YYYY HH:mm');

      $.ajax({
        url: "{{ route('bookings.rooms') }}",
        type: 'GET',
        dataType: 'json',
        data: { start, end, people },
        success: function (response) {
          if (response.error == false) {
            $("#room").html('');
            if (response.data && response.data.length) {
              $('#message_error').hide();
              response.data.map(function (value, index) {
                $("#room").append('<option value="' + value.id + '">' + value.name + '</option>')
              })

            }

          } else {
            alert(response.message)
          }
        },
        error: function (response) {
          console.log(response)
          if (response.status == 422) {
            const errors = response.responseJSON.errors;
            let message_error = ''
            for (var error in errors) {

              errors[error].map(function (value, index) {
                message_error += (value + '<br>')
              })
            }
            $('#message_error').html(message_error);
            $('#message_error').show();

          }

        }
      });

    });
 
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('#save-event').on('click', function () {
      var title = $('#title').val();
      var people = $('#people').val();
      var start = $('#start').val();
      var end = $('#end').val();
      var content = $('#content').val();
      var room = $('#room').val();

      // console.log([title,people,from_datetime,to_datetime,content,room,user_id]);

      $.ajax({
        url: "{{ route('bookings.create') }}",
        type: 'POST',
        dataType: 'json',
        data: { title, people, start, end, content, room },
        success: function (response) {
          if (response.error == false) {
            calendar.refetchEvents();
            $('.modal').modal('hide');
          }


        },
        error: function (response) {

        }
      });

    });
  });
</script>
@endsection