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
  <a href="{{ route('fail.form') }}" class="btn btn-primary">Cipta </a>
  </div>

  

  
  
 

    <h2>Senarai Fail</h2>  
        <hr>  
        
        

  <table id="example" class="table table-bordered mt-2">
    <thead>
      <tr>
        <th>No. </th>
        <th>Ruj Fail</th>
        <th>Nama Fail</th>
		    <th>Jenis Fail</th>
        <th>Status Fail </th>
        <th>Catatan </th>
        <th>  </th>
      </tr>
    </thead>
    <tbody>
      @foreach($fails as $index => $fail)
      <tr <?php if($fail->status_id==2){ echo 'style="background-color:yellow"'; } ?>>
        <td>{{  $index+1 }}. </td>
        <td>{{  $fail->ref_no }} ( ) {{ $fail->kulits->kulit ?? '' }}</td>
        <td> {{  $fail->title }} </td>
		     <td> {{ $fail->type_fails->type_fail }} </td>
        <td class="justify-content-center"> {{ $fail->status->status }}  </td> 
        <td class="justify-content-center">  {{$fail->desc_fail}} </td> 
        <td class="justify-content-center"> 

          <div class="btn-group-vertical">
            <a href="{{ route('fail.edit', $fail->id) }}" class="btn btn-warning btn-sm"   >
              <i class='fas fa-edit'></i>
            </a>

            <a href="{{ route('fail.delete', $fail->id) }}" class="btn btn-danger btn-sm"  onclick="return confirm('anda Pasti ?')">
              <i class='fas fa-trash'></i>
            </a>
           
            
          </div>

           
         

         

          
          
        </td> 
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="d-flex justify-content-center">
  

    
</div>

  
</div>

<script type="text/javascript">

  

  new DataTable('#example');

 </script>

@endsection
