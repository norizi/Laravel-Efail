@extends('layouts.app')

@section('content')
<div class="container">
  @if(Session::has('success'))
  <p class="alert alert-info">{{ Session::get('success') }}</p>
  @endif
    
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="float-right"> 
@if(!empty(auth()->user()->role_id))
  @if ( auth()->user()->role_id == 1)
    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalAdd">Cipta </a>
  @endif
@endif


                <!-- The Modal -->
                <div class="modal" id="modalAdd">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                
                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Tambah Pergerakan Fail </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                
                      <!-- Modal body -->
                      <div class="modal-body">
                       
                        
                        
                        <form method="POST" action="{{ route('movement.store') }}">
                        
                        @csrf

                       

                         <div class="form-group">
                            <label for="pwd">Pegawai :</label>
                            <select class="select2-single" name="user_id" required >
                              <option value="">-Pilih-</option>
                              @foreach($users as $index => $user)
                              <option value="{{ $user->id }}" >
                                {{ $user->name }}   </option>
                              @endforeach
                            </select>
                          </div>


                          <div class="form-group">
                            <label for="email">Fail : </label>
                             <select class="select2-single" name="fail_id" required >
                              <option value="">-Pilih-</option>
                              @foreach($fails as $index => $fail)
                              <option value="{{ $fail->id }}"  >
                                {{ $fail->title }}  {{ $fail->ref_no }} {{ $fail->kulits->kulit ?? '' }}  </option>
                              @endforeach
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="email">Tarikh Pinjam : </label>
                            <input type="date" class="form-control"  name="date_movement" value="<?php echo date('d-m-Y'); ?>" required>
                          </div>

                          <div class="form-group">
                            <label for="email">Tarikh Jangka Pulang : </label>
                            <input type="date" class="form-control"  name="return_estimate_date" value="<?php echo date('d-m-Y'); ?>" required>
                          </div>

                           <div class="form-group">
                            <label for="email">Catatan : </label>
                            <input type="text" class="form-control"  name="note" value="" >
                          </div>

                          
                          
                          <div class="form-group">
                             
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                          </div> 
                    </form>





                      </div>
                
                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      </div>
                
                    </div>
                  </div>
                </div>



  </div>

  

  
  
 

    <h2>Pergerakan Fail</h2>  
        <hr>  
        
        <form method="POST" action="{{ route('fail.update') }}" class="ml-3 d-print-none">
    
    @csrf
 


      <div class="form-group d-print-none">
        <label for="pwd">Sila Pilih Fail :</label>
        <select class="form-control select2-single" name="status_id" required onchange="OnChangeFail(this.options[this.selectedIndex].value)">
            <option value="">-Pilih-</option>
            @foreach($fails as $index => $fail)
            <option value="{{ $fail->id }}" @php if(!empty($fail_id)){ if($fail_id==$fail->id){ echo "selected"; }} @endphp>
              {{ $fail->title }}  {{ $fail->ref_no }} {{ $fail->kulits->kulit ?? '' }}  </option>
            @endforeach
          </select>
      </div>


       
    
</form>
 <a href="{{ route('movement') }}" class="btn btn-danger mb-2">Reset</a>
  <table id="example" class="table table-bordered mt-2">
    <thead>
      <tr>
        <th>No. </th>
        <th>Fail</th>
        <th>Nama Pegawai</th>
		    <th>Tarikh Pinjam</th>
        <th>Tarikh Jangka Pulang </th>
        <th>Tarikh Pulang </th>
        <th>Catatan</th>
        <th>  </th>
      </tr>
    </thead>
    <tbody>
      @foreach($movements as $index => $movement)
      <tr>
        <td>{{ $index+1 }}. </td>
        <td>{{ $movement->fails->ref_no }}<br> {{  $movement->fails->title }}
        - {{  $movement->fails->type_fails->type_fail }}-
         {{  $movement->fails->status->status }}</td>
        <td>{{ $movement->users->name }}</td>
		    <td>{{ \Carbon\Carbon::parse($movement->date_movement)->format('d M Y') }}</td>
        <td>{{ \Carbon\Carbon::parse($movement->return_estimate_date)->format('d M Y') }}</td>
        <td>{{ \Carbon\Carbon::parse($movement->return_date)->format('d M Y') }}</td> 
        <td>{{ $movement->note }}</td> 
        <td class="justify-content-center"> 
        @if(!empty(auth()->user()->role_id))
          @if ( auth()->user()->role_id == 1)
          <div class="btn-group-vertical">
             
            <a href="#" class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#modalEdit{{ $movement->id }}" >
              <i class='fas fa-edit'></i>
            </a>

            <a href="{{ route('movement.delete', $movement->id) }}" class="btn btn-danger btn-sm"  onclick="return confirm('anda Pasti ?')">
              <i class='fas fa-trash'></i>
            </a>
           
            
          </div> 
          @endif
         @endif 
          
        </td> 
      </tr>


                <!-- The Modal -->
                <div class="modal" id="modalEdit{{ $movement->id }}">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                
                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Kemaskini Pergerakan Fail </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                
                      <!-- Modal body -->
                      <div class="modal-body">
                       
                        
                        
                        <form method="POST" action="{{ route('movement.update') }}">
                        
                        @csrf

                       

                         <div class="form-group">
                            <label for="pwd">Pegawai :</label>
                            <select class="select2-single" name="user_id" required >
                              <option value="">-Pilih-</option>
                              @foreach($users as $index => $user)
                              <option value="{{ $user->id }}"  @if(!empty($movement->user_id)) {{ ($movement->user_id) == $user->id ? 'selected' : '' }} @endif>
                                {{ $user->name }}   </option>
                              @endforeach
                            </select>
                          </div>


                          <div class="form-group">
                            <label for="email">Fail : </label>
                             <select class="select2-single" name="fail_id" required >
                              <option value="">-Pilih-</option>
                              @foreach($fails as $index => $fail)
                              <option value="{{ $fail->id }}"  @if(!empty($movement->fail_id)) {{ ($movement->fail_id) == $fail->id ? 'selected' : '' }} @endif>
                                {{ $fail->title }}  {{ $fail->ref_no }} {{ $fail->kulits->kulit ?? '' }}  </option>
                              @endforeach
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="email">Tarikh Pinjam : </label>
                            <input type="date" class="form-control"  name="date_movement" value="{{ $movement->date_movement }}" required>
                          </div>

                          <div class="form-group">
                            <label for="email">Tarikh Jangka Pulang : </label>
                            <input type="date" class="form-control"  name="return_estimate_date" value="{{ $movement->return_estimate_date }}" required>
                          </div>


                          <div class="form-group">
                            <label for="email">Tarikh Pulang : </label>
                            <input type="date" class="form-control"  name="return_date" value="{{ $movement->return_date ?? '' }}" required>
                          </div>


                           <div class="form-group">
                            <label for="email">Catatan : </label>
                            <input type="text" class="form-control"  name="note" value="{{ $movement->note }}" >
                          </div>

                          
                          
                          <div class="form-group">
                               <input type="hidden" class="form-control"  name="id" value="{{ $movement->id ?? '' }}" >
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                          </div> 
                    </form>





                      </div>
                
                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      </div>
                
                    </div>
                  </div>
                </div>
                <!-- end Modal -->



      @endforeach
    </tbody>
  </table>

  <div class="d-flex justify-content-center">
  

    
</div>

  
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.js"></script>

<script>
     

  function OnChangeFail(val)
  {
   //alert(val);
   var base_url = "<?php echo url("movement"); ?>";
   var url= base_url+"?fail_id="+val;
   window.location = url;
   //alert(url);
  }

   
 
 </script>

 <script>
	$( ".select2-single, .select2-multiple" ).select2( {
		theme: "bootstrap", 
		maximumSelectionSize: 6,
		containerCssClass: ':all:'
	} );

 new DataTable('#example');
</script>  

@endsection
