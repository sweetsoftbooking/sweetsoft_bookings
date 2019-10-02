@extends('admin.layout.main')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>150</h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>44</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable" id="parent_left">

          <!-- LIST BOOKING -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title text-primary">
                <i class="fas fa-book"></i>
                List Booking
              </h3>

              <div class="card-tools">
                <button type="button" class="today btn btn-primary btn-sm float-right mr-1" id="today">Today</button>
                <button type="button" class="week btn btn-secondary btn-sm float-right mr-1" id="week"> Week</button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <style>
                .item {
                  cursor: pointer;
                }
              </style>
              <ul class="todo-list booking-today" data-widget="todo-list" id="booking_today">
                @foreach($bookings as $book)
                @include('partials.dashboard.item-room', ['book' => $book])
                @endforeach
              </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              {!!$bookings->links()!!}
            </div>
          </div>

          <!-- /.card -->
        </section>

        <!-- !MODAL -->
        @include('partials.modal-booking')

        {{-- MODAL DELETE --}}
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
        </div>

        <div id="route" data-get-edit="{{route('bookings.edit')}}"
          data-post-booking-delete="{{route('booking.delete')}}" 
          data-get-booking-week="{{route('booking-week.list')}}"
          data-get-booking-today="{{route('booking-today.list')}}">
        </div>

      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<script type="text/template" id="item-room-template">
  <li>
    <span class="item text" data-id="__id__">__title__</span>
    <small class="badge badge-success"> __room_name__</small>
    <small class="badge badge-info"><i class="far fa-clock"></i> __start__</small>
    <small class="badge badge-warning"><i class="far fa-clock"></i> __end__</small>
    <div class="tools">
      <i class="delete fas fa-trash" data-id-delete="__id__"></i>
    </div>
  </li>
</script>
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

    //TODO: show modal
    $('.booking-today').on('click', '.item', function(e){ //.class-mom .item-son
      $('#delete_event').hide();
      $('.modal-booking').modal('show');
      var id = $(this).data('id'); //$(this).data('name') name=* // data-name

      $.ajax({
          url: $('#route').data('get-edit'),
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
    });
    
    //TODO: delete booking
    $('.booking-today').on('click', '.delete', function(e){
      var id = $(this).data('id-delete');
      $('#delete_id').val(id);
      $('.modal-delete').modal('show');
    });

    // confirm delete
    $('#confirm_delete').on('click',function(){
      var id = $('#delete_id').val();

      $.ajax({
          url: $('#route').data('post-booking-delete'),
          type: 'POST',
          dataType: 'json',
          data: {id},
              
          success:function(response){
            const data = response.data;
            console.log(data)
            if (response.error == false) {
              let listing = '';
              const template = $('#item-room-template').html()
              data.data.map(function(value, index){
                listing += template.replace(/__id__/g, value.id)
                                  .replace(/__title__/g, value.title)
                                  .replace(/__room_name__/g, value.room.name)
                                  .replace(/__start__/g, value.from_datetime)
                                  .replace(/__end__/g, value.to_datetime)
                ;
              });
              $('.booking-today').html(listing)
              $('.modal-delete').modal('hide');
            }
            else {
              alert(response.message)
            }
          },
          error:function(response){

          }
      });
    });
    
    // TODO: booking week
    $('#week').on('click',function(){
      $('.week').removeClass('btn-secondary');
      $('.week').addClass('btn-primary');
      $('.today').removeClass('btn-primary');
      $('.today').addClass('btn-secondary'); 
        // toogle class btn
      $.ajax({
          url: $('#route').data('get-booking-week'),
          type: 'GET',
          dataType: 'json',
          data: {},
              
          success:function(response){
            const data = response.data;
            console.log(data)
              if (response.error == false) {
                // $('.booking-today').html(data)
                let listing = '';
                const template = $('#item-room-template').html()
                data.data.map(function(value, index){
                  listing += template.replace(/__id__/g, value.id)
                                    .replace(/__title__/g, value.title)
                                    .replace(/__room_name__/g, value.room.name)
                                    .replace(/__start__/g, value.from_datetime)
                                    .replace(/__end__/g, value.to_datetime)
                  ;
                });
                $('.booking-today').html(listing)
              }
              else {
                alert(response.message)
              }
          },
          error:function(response){

          }
      });
    });

    //TODO: booking today
    $('#today').on('click',function(){
      
      $('.today').removeClass('btn-secondary');
      $('.today').addClass('btn-primary');
      $('.week').removeClass('btn-primary');
      $('.week').addClass('btn-secondary');  // toogle class btn

      $.ajax({
          url: $('#route').data('get-booking-today'),
          type: 'GET',
          dataType: 'json',
          data: {},
              
          success:function(response){
            const data = response.data;
            console.log(data)
              if (response.error == false) {
                // $('.booking-today').html(data)
                let listing = '';
                const template = $('#item-room-template').html()
                data.data.map(function(value, index){
                  listing += template.replace(/__id__/g, value.id)
                                    .replace(/__title__/g, value.title)
                                    .replace(/__room_name__/g, value.room.name)
                                    .replace(/__start__/g, value.from_datetime)
                                    .replace(/__end__/g, value.to_datetime)
                  ;
                });
                $('.booking-today').html(listing)
              }
              else {
                alert(response.message)
              }
          },
          error:function(response){

          }
      });
    });














  });
  
</script>
@endsection