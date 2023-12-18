<!--Live Deduction Data-->
<div class="card-header">
  <div class="col-md-6 d-block">
    <a href="{{ $add_new }}" class="btn btn-sm btn-dark float-left"><i class="ik plus-square ik-plus-square"></i> Create Deduction</a>
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
        <th width="35" class="text-center">Employee(s)</th>
        <th width="10" class="text-center">Amount</th>
        <th width="10" class="text-center">Duration</th>
        <th width="45">Description</th>
        <th width="45">Date</th>
        <th width="45">Status</th>
        <th width="5">Actions</th>
        <th width="3">
          <div class="custom-control custom-checkbox pl-1 align-self-center">
            <label class="custom-control custom-checkbox mb-0" title="Select All" data-toggle="tooltip" data-placement="right">
              <input type="checkbox" class="custom-control-input" id="master">
              <span class="custom-control-label"></span>
            </label>
          </div>
        </th>
      </tr>
    </thead>
    <tbody>
      @foreach($deductions as $deduction)
      <tr>
        <td class="text-center">
          {{ ($loop->index + 1) }}
        </td>
        <td>
          <div class="text-center">
            <span><b>{{ $deduction->name }}</b></span>
            <code class="pc">{{ $deduction->slug }}</code>
          </div>
        </td>
        <td>
          <p>{{ $deduction->employee_id }}</p>
        </td>
        <td class="text-center">
          <span><b>{{ $deduction->amount }}</b></span>
        </td>
        <td class="text-center">
        
          <span><b>{{ date('d,F-Y',strtotime($deduction->start_date))}} - {{ date('d,F-Y',strtotime($deduction->end_date))}}</b></span>
      
        </td>
        <td>
          <p>{{ $deduction->description }}</p>
        </td>
        <td>
          <p>{{ date('d, F-Y',strtotime($deduction->start_date))  }}</p>
        </td>
        <td>
          <p>{{ $deduction->end_date }}</p>
        </td>
        <td>
            <div class="btn-group btn-sm" role="group" aria-label="Basic example">
              <a href="{{ route('admin.admindeduction.edit',['admindeduction'=>$deduction]) }}" type="button" class="btn btn-sm btn-outline-primary">
                <i class="ik edit-2 ik-edit-2"></i>
              </a>
              <a data-href="{{ route('admin.admindeduction.destroy',['admindeduction'=>$deduction]) }}" type="button" class="btn btn-sm btn-outline-danger delete">
                <i class="ik trash-2 ik-trash-2"></i>
              </a>
            </div>
        </td>
       
        <td>
          <div class="custom-control custom-checkbox pl-1 align-self-center">
            <label class="custom-control custom-checkbox mb-0">
              <input type="checkbox" class="custom-control-input sub_chk" data-id="{{$deduction->id}}">
              <span class="custom-control-label"></span>
            </label>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td colspan="6" class="text-right">
          <h6>Total Deductions : <span class="text-danger">{{ $sum }}</span> </h6>
        </td>
      </tr>
    </tfoot>
  </table>
</div>
<!--EndLive Deduction Data-->
