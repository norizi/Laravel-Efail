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
        
      </tr>
    </thead>
    <tbody>
      @foreach($fails as $index => $fail)
      <tr <?php if($fail->status_id==2){ echo 'style="background-color:yellow"'; } ?>>
        <td>{{  $index+1 }}</td>
        <td>{{  $fail->ref_no }} ( ) {{ $fail->kulits->kulit ?? '' }}</td>
        <td> {{  $fail->title }} </td>
		     <td> {{ $fail->type_fails->type_fail }} </td>
        <td class="justify-content-center"> {{ $fail->status->status }}  </td> 
        <td class="justify-content-center">  {{$fail->desc_fail}} </td> 
         
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="d-flex justify-content-center">
  

    
</div>

  
</div>

<script type="text/javascript">

  function changeFunc() {
   var selectBox = document.getElementById("ipt_id");
   var selectedValue = selectBox.options[selectBox.selectedIndex].value;
   alert(selectedValue);
 url='aduan_list.php?ipt_id='+selectedValue;
 window.location = url;
  }

  new DataTable('#example');

 </script>

@endsection
