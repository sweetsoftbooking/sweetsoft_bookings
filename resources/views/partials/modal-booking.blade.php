<div class="modal modal-booking fade" id="modal_booking" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-warning" role="document">
        <!--Content-->
        <div class="modal-content">
            <!-- !Header-->
            <div class="modal-header text-center" style="background-color: ora" id="modal_header">
                <div class="pull-left">
                    <button type="button" class="btn btn-danger" id="delete_event">Delete</button>
                </div>
                <h4 class="modal-title white-text w-100 font-weight-bold py-2" id="modal_title" style="color:white">Create Booking</h4>
                <button type="button" class="close" id="top_close" data-dismiss="modal" aria-label="Close" style="color:white">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
                <style>
                    h4 {
                        display: inline-block;
                    }

                    .pull-left {
                        display: inline-block;
                    }
                </style>
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
                        <input type="hidden" id="color">
                    </div>
                </div>

                <!-- *input ROOM -->
                <div class="form-group">
                    <label>Room:</label>
                    <div class="input-group">
                        <select name="room" class="js-example-basic-single" style="width:400px;" id="room">
                           
                        </select>
                        
                        <button type="button" style="font-size: 15px"
                            class="btn btn-primary form-control col-sm-2" id="check_room">Check</button>
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
                <button type="button" class="btn btn-success" id="add_event">Save</button>
            </div>

        </div>
        <!--/.Content-->
    </div>
</div>