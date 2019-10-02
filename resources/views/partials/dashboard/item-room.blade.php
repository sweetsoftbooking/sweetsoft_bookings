<li>
    <span class="item text" data-id="{{$book->id}}">
      {{$book->title}}
    </span>
    <small class="badge badge-success"> {{$book->room->name}}</small>
    <small class="badge badge-info"><i class="far fa-clock"></i> {{$book->from_datetime}}</small>
    <small class="badge badge-warning"><i class="far fa-clock"></i> {{$book->to_datetime}}</small>
    <div class="tools">
      <i class="delete fas fa-trash" data-id-delete="{{$book->id}}"></i>
    </div>
  </li>