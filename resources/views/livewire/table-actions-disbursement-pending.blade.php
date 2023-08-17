<div class="btn-group" role="group" aria-label="Basic example">
    <button type="button" data-toggle="modal" data-target="#Disburse" class="button mr-4">Disburse</button>
    <button type="button" class="button">View</button>
</div>

@section('modal_content')

<!-- Modal -->
<div class="modal fade" id="Disburse" tabindex="-1" role="dialog" aria-labelledby="DisburseCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
          @if(isset($user))
            <p>{{ $user }}</p>
          @else
            <p>User is not set</p>
          @endif

        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

@endsection

