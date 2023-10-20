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
  <a href="{{ route('user.form') }}" class="btn btn-primary">Cipta </a>
  </div>

  

  
  
 

    <h2>Senarai User</h2>  
        <hr>  
        
        


  <table id="example" class="table table-bordered mt-2">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama</th>
        <th>Email</th>		    
        <th>Role</th>	 
        <th>  </th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $index => $user)
      <tr>
        <td> {{  $index+1 }}.  </td>
        <td>{{  $user->name }} </td>
        <td> {{  $user->email }} </td>
         <td> {{  $user->roles->role }} </td>
		     
        <td class="justify-content-center"> 
           
          

          <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm"   >
            <i class='fas fa-edit'></i>
          </a>

          
          
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
