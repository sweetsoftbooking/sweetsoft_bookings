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
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="sticky-top mb-3">
                        <!-- !CREATE EVENT -->
                        <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Create Booking</h3>
                                </div>
                                <div class="card-body">
                                    <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                        <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                                        <ul class="fc-color-picker" id="color-chooser">
                                            <li><a class="text-primary" id="blue"><i class="fas fa-square"></i></a></li>
                                            <li><a class="text-warning" id="orange"><i class="fas fa-square"></i></a></li>
                                            <li><a class="text-success" id="green"><i class="fas fa-square"></i></a></li>
                                            <li><a class="text-danger" id="orangered"><i class="fas fa-square"></i></a></li>
                                            <!-- <li><a class="text-muted" href="#" id="gray"><i class="fas fa-square"></i></a></li> -->
                                        </ul>
                                    </div>
                                    <!-- /input-group -->
                                </div>
                            </div>
                        <!-- !BOOKING OF ROOM -->
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Bookings of Room</h4>
                            </div>
                            <div class="card-body">
   
                                <select class="js-example-theme-multiple" name="rooms[]" multiple="multiple" style="width:190px" id="bookings_rooms">
                                    
                                    <option value=""></option>
                                </select>
                                 
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        
                    </div>
                </div>
                <!-- !THE CALENDAR -->
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card card-primary">
                        <div class="card-body p-0">
                           
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
                                data-post-edit="{{route('bookings.edit')}}"
                                data-post-delete="{{route('bookings.delete')}}"
                                data-post-drag="{{route('bookings.drag')}}"></div>
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
    @include('partials.modal-booking')

    <!-- {{-- MODAL DELETE --}}
    <div class="modal modal-delete" tabindex="-1" role="dialog" id="">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Delete Booking</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <p>Are you sure want to delete this booking?</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger" id="confirm_delete">OK</button>
            <input type="hidden" id="delete_id">
            </div>
        </div>
        </div>
    </div> -->
@endsection

@section('script')
<script src="js/moment.js"></script>
<script>
    $(document).ready(function () {

        $('.js-example-basic-single').select2({

        });
        // $('.js-example-basic-multiple').select2();
        $(".js-example-theme-multiple").select2({
            theme: "classic"
        });
    });
</script>
<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // TODO: daterangepicker
        const $reservationtime = $('#reservationtime')
        //Date range picker with time picker
        $reservationtime.daterangepicker({
            parentEl: '#modal_booking',
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
        var Draggable = FullCalendarInteraction.Draggable;

        let shiftIsPressed = false;

        function setEventsCopyable(isCopyable) {
        shiftIsPressed = !shiftIsPressed;
        calendar.setOption("droppable", isCopyable);
        calendar.setOption("editable", !isCopyable);
        }

        document.addEventListener("keydown", event => {
        if (event.keyCode === 16 && !shiftIsPressed) {
            setEventsCopyable(true);
        }
        });

        document.addEventListener("keyup", event => {
        if (shiftIsPressed) {
            setEventsCopyable(false);
        }
        });

        let containerEl = document.getElementById("calendar");
        let calendarEl = document.getElementById("calendar");

        new Draggable(containerEl, {
            itemSelector: ".fc-event",
            eventData: function(eventEl) {
            return {
                title: eventEl.innerText
            };
            }
        });

        //clear modal
        function clear(){
            $('#add_event').data('action', 'add_event');
            $('#modal_title').text("Create Booking");
            $('.modal').find('input').val('');
            $('.modal').find('textarea').val('');
            $('#room').find('option').remove();
            $('#message_error').hide();
        }

        // FIXME: button add event / push event to calendar / click event
        var calendar = new Calendar(calendarEl, {
            plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'], //TODO: add view type list
            defaultView: 'dayGridMonth',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
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
            dropAccept(el) {
                return shiftIsPressed;
            },

            //TODO: add events to calendar
            events: function (info, successCallback, failureCallback) {
                console.log(info);
                var rooms = $('#bookings_rooms').val();
                
                $.ajax({
                    url: $('#calendar').data('get-listing'),
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        start: info.startStr,
                        end: info.endStr,
                        rooms
                    },
                    success: function (response) {
                        if (response.error == false) {
                            let events = [];
                            const data = response.data
                            //$("#bookings_rooms").html('');   // search full
                            data.map(function (val) { // map == foreach
                                events.push({
                                    id: val.id,
                                    title: val.title + ' ( ' + val.room.name + ' )',
                                    start: moment(val.from_datetime).format('YYYY-MM-DD HH:mm:ss'),
                                    end: moment(val.to_datetime).format('YYYY-MM-DD HH:mm:ss'),
                                    backgroundColor: val.color,
                                    textColor: 'white',
                                    borderColor: 'white'

                                })

                                $("#bookings_rooms").append('<option value="' + val.room.id + '">' + val.room.name + '</option>')
                                var optionValues =[];
                                $('#bookings_rooms option').each(function(){
                                if($.inArray(this.value, optionValues) >-1){
                                    $(this).remove()
                                }else{
                                    optionValues.push(this.value);
                                }
                                });

                                var select = $('#bookings_rooms');
                                select.html(select.find('option').sort(function(x, y) {
                                    // to change to descending order switch "<" for ">"
                                    return $(x).text() > $(y).text() ? 1 : -1;
                                }));

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
                $('#delete_event').show();
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
                        const data = response.data;
                        $('#modal_header').css('background-color',data.color);
                        $('#modal_title').text(data.title);
                        $('.modal').find('#title').val(data.title);
                        $('.modal').find('#exclude').val(data.room_id);
                        $('.modal').find('#booking_id').val(data.id);
                        $('.modal').find('#people').val(data.people);
                        $('.modal').find('#content').val(data.content);

                        var start = moment(data.from_datetime),
                            end = moment(data.to_datetime);

                        $reservationtime.data('daterangepicker').setStartDate(start);
                        $reservationtime.data('daterangepicker').setEndDate(end);
                        console.log([start, end])

                        $('#reservationtime').val(start.format('DD-MM-YYYY HH:mm') + ' - ' + end.format('DD-MM-YYYY HH:mm'));
                        $('.modal').find('#start').val(start.format('DD-MM-YYYY HH:mm'));
                        $('.modal').find('#end').val(end.format('DD-MM-YYYY HH:mm'));


                        const room = data.room;
                        $("#room").html('')
                        $("#room").append('<option selected="selected" value="' + room.id + '">' + room.name + '</option>')

                       if(data.has_edit){
                           $('#add_event').hide();
                           editable : false;
                       }
                    },
                    error: function (response) {

                    }
                })
            },

            // TODO: store drag event
            eventDrop : function(info,event, delta, revertFunc){ 
                const url = $('#calendar').data('post-drag');
                var start = moment(info.event.start).format('DD-MM-YYYY HH:mm');
                var end = moment(info.event.end).format('DD-MM-YYYY HH:mm');
                $.ajax({
                    url,
                    type: 'GET',
                    dataType: 'json',
                    data:{id:info.event.id, start , end},
                    success:function(){
                        calendar.refetchEvents();
                    },error:function(){ 
                        alert("error drag");  
                        calendar.refetchEvents();
                    }
                });
            }
        });

        window.focus();
        
        $('#blue').on('click',function(){
            $('#modal_header').css("background-color", "blue");
            clear();
            $('#delete_event').hide();
            $('.modal').modal('show');
            $('.modal').find('#exclude').val('');
            $('#color').val("blue");
        });
        $('#green').on('click',function(){
            $('#modal_header').css("background-color", "green");
            clear();
            $('#delete_event').hide();
            $('.modal').modal('show');
            $('.modal').find('#exclude').val('');
            $('#color').val("green");
        });
        $('#orange').on('click',function(){
            $('#modal_header').css("background-color", "orange");
            clear();
            $('#delete_event').hide();
            $('.modal').modal('show');
            $('.modal').find('#exclude').val('');
            $('#color').val("orange");
        });
        $('#orangered').on('click',function(){
            $('#modal_header').css("background-color", "orangered");
            clear();
            $('#delete_event').hide();
            $('.modal').modal('show');
            $('.modal').find('#exclude').val('');
            $('#color').val("orangered");
        });

        $('#close_event').on('click', function () {
            clear();

        });

        $('#top_close').on('click', function () {
            clear();
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

        //FIXME: add event / edit event
        $('#add_event').on('click', function () {
            var title = $('#title').val();
            var people = $('#people').val();
            var start = $('#start').val();
            var end = $('#end').val();
            var content = $('#content').val();
            var room = $('#room').val();
            var id = $('#booking_id').val();
            var color = $('#color').val();
            // alert(color);

            //TODO: add event
            if ($('#add_event').data('action') == 'add_event') {
                const url = $('#calendar').data('post-create');
                $.ajax({
                    url,
                    type: 'POST',
                    dataType: 'json',
                    data: { title, people, start, end, content, room, color },
                    success: function (response) {
                        if (response.error == false) {
                            calendar.refetchEvents();
                            $('#message_error').hide(); //refresh fullcalendar
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
                            $('#message_error').hide(); //refresh fullcalendar
                            
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

        // TODO: delete event
        $('#delete_event').on('click',function(info){
            var id = $('#booking_id').val();
            $.ajax({
                url: $('#calendar').data('post-delete'),
                type: 'POST',
                dataType: 'json',
                data: {id},
                    
                success:function(response){
                    if (response.error == false) {
                            calendar.refetchEvents(); //refresh fullcalendar
                            $('.modal').find('input').val('');
                            $('.modal').find('textarea').val('');
                            $('#room').find('option').remove();
                            $('#message_error').hide();
                            $('.modal').modal('hide');
                        }
                        else {
                            alert(response.message)
                        }
                },
                error:function(response){

                }
                
            });
        });

        $('#bookings_rooms').on('change',function(){
            calendar.refetchEvents();
        });
    });

    
</script>
@endsection