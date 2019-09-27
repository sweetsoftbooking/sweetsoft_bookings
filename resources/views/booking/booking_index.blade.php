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
                        <!-- !DARAGBLE EVENT -->
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
                        <!-- !CREATE EVENT -->
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
                            <!-- !THE CALENDAR -->
                            @if(session('alert'))
                            <div class="col-md-8 alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                                <h5> {{session('alert')}}</h5>
                            </div>
                            @endif
                            <div id="calendar" data-get-listing="{{ route('bookings.listing') }}"
                                data-get-edit="{{route('bookings.edit')}}"
                                data-post-create="{{route('bookings.create')}}"
                                data-post-edit="{{route('bookings.edit')}}"></div>
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

<!-- !MODAL -->
<div class="modal fade" id="orangeModalSubscription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-notify modal-warning" role="document">
        <!--Content-->
        <div class="modal-content">
            <!-- !Header-->
            <div class="modal-header text-center">
                <h4 class="modal-title white-text w-100 font-weight-bold py-2">Create Booking</h4>
                <button type="button" class="close" id="top_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!-- !Body-->
            <div class="modal-body">

                <!-- *error message -->
                <div class="col-md-12 form-group">
                    <p style="color:orangered" id="message_error"></p>
                </div>

                <!-- *input TITLE -->
                <div class="form-group">
                    <label>Title:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="title" id="title">
                    </div>
                </div>



                <!-- *input PEOPLE -->
                <div class="form-group">
                    <label>Number of People:</label>
                    <div class="input-group">
                        <input type="number" class="form-control" name="people" id="people" min="1" max="300">
                    </div>
                    <!-- <style>
              .people {
                padding: 0px 0px 0px 10px !important;
              }
            </style> -->
                </div>

                <!-- *input START-END -->
                <div class="form-group">
                    <label>Date & Time:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                        </div>
                        <input type="text" class="form-control float-right" id="reservationtime" autocomplete="off"
                            name="datetimes">
                        <input type="hidden" id="start" name="start">
                        <input type="hidden" id="end" name="end">
                        <input type="hidden" id="exclude" name="exclude">
                        <input type="hidden" id="booking_id">
                    </div>
                </div>

                <!-- *input ROOM -->
                <div class="form-group">
                    <label>Room:</label>
                    <div class="input-group">
                        <select name="room" class="js-example-basic-single" style="width:400px;" id="room">
                            <!-- <option>--- List Room ---</option> -->
                        </select>
                        <button type="button" style="font-size: 15px; color:white" class="btn btn-warning form-control col-sm-2"
                            id="check_room">Check</button>
                    </div>
                </div>

                <!-- *input CONTENT -->
                <div class="form-group">
                    <label>Content:</label>
                    <div class="input-group">
                        <textarea class="form-control" rows="5" cols="10" name="content" id="content"></textarea>
                    </div>
                </div>

            </div>
            <!-- end body -->

            <!-- !Footer-->
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="close_event">Close</button>
                <button type="button" class="btn btn-primary" id="add_event">Save</button>
            </div>

        </div>
        <!--/.Content-->
    </div>
</div>
@endsection

@section('script')
<script src="public/js/moment.js"></script>
<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
    $('.js-example-basic-single').select2({
    
    });
});
</script>
<script>
    $(function () {
        
        // TODO: daterangepicker
        const $reservationtime = $('#reservationtime')
        //Date range picker with time picker
        $reservationtime.daterangepicker({
            parentEl: '#orangeModalSubscription',
            autoUpdateInput: false,
            timePicker: true,
            timePickerIncrement: 15,
            locale: {
                format: 'DD-MM-YYYY hh:mm A'
            }
        }, function (start, end, label) {
            $('#start').val(start.format('DD-MM-YYYY HH:mm'));
            $('#end').val(end.format('DD-MM-YYYY HH:mm'));

            console.log("A new date selection was made: " + start.format('DD-MM-YYYY HH:mm') + ' to ' + end.format('DD-MM-YYYY HH:mm'));
        })
        $reservationtime.on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('DD-MM-YYYY HH:mm') + ' - ' + picker.endDate.format('DD-MM-YYYY HH:mm'));
        });

        $reservationtime.on('cancel.daterangepicker', function (ev, picker) {
            // $(this).val('');
        });

        var Calendar = FullCalendar.Calendar;
        var calendarEl = document.getElementById('calendar');

        // FIXME: button add event / push event to calendar / click event
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

            //TODO: button add event
            customButtons: {
                addEventButton: {
                    text: 'add event...',
                    click: function () {
                        $('#add_event').data('action', 'add_event');
                        $('.modal').modal('show');
                        $('.modal').find('#exclude').val('');

                    }
                }
            },

            //TODO: add events to calendar
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
                                    backgroundColor: 'green',
                                    textColor: 'white'

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

            //TODO: click event
            eventClick: function (info) {
                $('#add_event').data('action', 'edit_event');

                $('.modal').modal('show');
                var id = info.event.id
                // if id = event.id
                $.ajax({
                    url: $('#calendar').data('get-edit'),
                    type: 'GET',
                    dataType: 'json',
                    data: { id },
                    success: function (response) {
                        console.log(response.data);
                        $('.modal').find('#title').val(response.data.title);
                        $('.modal').find('#exclude').val(response.data.room_id);
                        $('.modal').find('#booking_id').val(response.data.id);
                        $('.modal').find('#people').val(response.data.people);
                        $('.modal').find('#content').val(response.data.content);

                        var start = moment(response.data.from_datetime),
                            end = moment(response.data.to_datetime);

                        $reservationtime.data('daterangepicker').setStartDate(start);
                        $reservationtime.data('daterangepicker').setEndDate(end);
                        console.log([start, end])

                        $('#reservationtime').val(start.format('DD-MM-YYYY HH:mm') + ' - ' + end.format('DD-MM-YYYY HH:mm'));
                        $('.modal').find('#start').val(start.format('DD-MM-YYYY HH:mm'));
                        $('.modal').find('#end').val(end.format('DD-MM-YYYY HH:mm'));


                        const room = response.data.room;
                        $("#room").html('')
                        $("#room").append('<option selected="selected" value="' + room.id + '">' + room.name + '</option>')
                    },
                    error: function (response) {

                    }


                })


            }
        });

        $('#close_event').on('click', function () {
            $('.modal').find('input').val('');
            $('.modal').find('textarea').val('');
            $('#room').find('option').remove();
            $('#message_error').hide();

        });

        $('#top_close').on('click', function () {
            $('.modal').find('input').val('');
            $('.modal').find('textarea').val('');
            $('#room').find('option').remove();
            $('#message_error').hide();
        });

        $('.modal').modal('hide');
        calendar.render();

        //TODO: get room available
        $('#check_room').on('click', function () {
            // alert('ok');

            var start = $('#start').val();
            var end = $('#end').val();
            var people = $('#people').val();
            var exclude = $('#exclude').val();

            const from = moment(start, 'DD-MM-YYYY HH:mm');
            const to = moment(end, 'DD-MM-YYYY HH:mm');

            $.ajax({
                url: "{{ route('bookings.rooms') }}",
                type: 'GET',
                dataType: 'json',
                data: { start, end, people, exclude },
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
        $('#add_event').on('click', function () {
            var title = $('#title').val();
            var people = $('#people').val();
            var start = $('#start').val();
            var end = $('#end').val();
            var content = $('#content').val();
            var room = $('#room').val();
            var id = $('#booking_id').val();

            //TODO: add event
            if ($('#add_event').data('action') == 'add_event') {
                const url = $('#calendar').data('post-create');
                $.ajax({
                    url,
                    type: 'POST',
                    dataType: 'json',
                    data: { title, people, start, end, content, room },
                    success: function (response) {
                        if (response.error == false) {
                            calendar.refetchEvents(); //refresh fullcalendar
                            $('.modal').modal('hide');
                        }
                        else {
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

            } 
            //TODO: edit event
            else if ($('#add_event').data('action') == 'edit_event') {
                const url = $('#calendar').data('post-edit');
                $.ajax({
                    url,
                    type: 'POST',
                    dataType: 'json',
                    data: { id, title, people, start, end, content, room },
                    success: function (response) {
                        if (response.error == false) {
                            calendar.refetchEvents(); //refresh fullcalendar
                            $('.modal').modal('hide');
                        }
                        else {
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

            } else {
                alert('fail');
                return false;
            }
            // console.log([title,people,from_datetime,to_datetime,content,room,user_id]);

        });

    });
</script>
@endsection