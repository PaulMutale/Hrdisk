<!--Live Deduction Data-->
<div class="card-header">
  <div class="col-md-6 d-block">
    <a href="{{ $add_new }}" class="btn btn-sm btn-dark float-left"><i class="ik plus-square ik-plus-square"></i> Create allowance</a>
  </div>
  <div class="col-md-6">
    <button type="submit" class="btn btn-primary mb-2 h-33 float-right move-to-delete-all" id="apply" disabled="true" data-href="{{ $moveToTrashAllLink }}">Action</button>
  </div>
</div>

<div class="card-body table-responsive p-0">
  <table id="state_data_table" class="table mb-0 table-hover">
    <thead>
      <tr>
        <th width="2" class="text-center">No.</th>
        <th width="35" class="text-center">Name</th>
        <th width="10" class="text-center">Amount</th>
        <th width="45">Description</th>
        <th width="5">Actions</th>
        
      </tr>
    </thead>
    <tbody>
      @foreach($allowances as $allowance)
      <tr>
        <td class="text-center">
          {{ ($loop->index + 1) }}
        </td>
        <td>
          <div class="text-center">
            <span><b>{{ $allowance->name }}</b></span>
            <code class="pc">{{ $allowance->slug }}</code>
          </div>
        </td>
        <td class="text-center">
          <span><b>ZMW {{ $allowance->amount }}</b></span>
        </td>
        <td>
          <p>{{ $allowance->description }}</p>
        </td>
        <td>
            <div class="btn-group btn-sm" role="group" aria-label="Basic example">
              <a href="{{ route('admin.allowance.edit',['allowance'=>$allowance]) }}" type="button" class="btn btn-sm btn-outline-primary">
                <i class="ik edit-2 ik-edit-2"></i>
              </a>
              <a data-href="{{ route('admin.allowance.destroy',['allowance'=>$allowance]) }}" type="button" class="btn btn-sm btn-outline-danger delete">
                <i class="ik trash-2 ik-trash-2"></i>
              </a>
            </div>
        </td>
       
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td colspan="6" class="text-right">
          <h6>Total allowances : <span class="text-danger">ZMW {{ $sum }}</span> </h6>
        </td>
      </tr>
    </tfoot>
  </table>
</div>
<!--EndLive allowance Data-->
