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

     

  

<h2 class="text-center py-3">Senarai Surat Keluar / Masuk</h2>

<hr>
  
@foreach($letters as $index => $letter)

<div class="container py-2 mt-4 mb-4">
  <!-- timeline item 1 -->
  <div class="row">
    <!-- timeline item 1 left dot -->
    <div class="col-auto text-center flex-column d-none d-sm-flex">
      <div class="row h-50">
        <div class="col">&nbsp;</div>
        <div class="col">&nbsp;</div>
      </div>
      <h5 class="m-2">
        <span class="badge badge-pill bg-primary border">&nbsp;</span>
      </h5>
      <div class="row h-50">
        <div class="col border-right">&nbsp;</div>
        <div class="col">&nbsp;</div>
      </div>
    </div>
    <!-- timeline item 1 event content -->
    <div class="col py-2">
      <div class="card">
        <div class="card-body">
          <div class="float-right text-muted">Mon, Jan 9th 2019 7:00 AM</div>
          <h4 class="card-title">Day 1 Orientation</h4>
          <p class="card-text">Welcome to the campus, introduction and get started with the tour.</p>
        </div>
      </div>
    </div>
  </div>
  <!--/row-->


  @endforeach




  <!-- timeline item 2 -->
  <div class="row">
    <div class="col-auto text-center flex-column d-none d-sm-flex">
      <div class="row h-50">
        <div class="col border-right">&nbsp;</div>
        <div class="col">&nbsp;</div>
      </div>
      <h5 class="m-2">
        <span class="badge badge-pill bg-danger border">&nbsp;</span>
      </h5>
      <div class="row h-50">
        <div class="col border-right">&nbsp;</div>
        <div class="col">&nbsp;</div>
      </div>
    </div>
    <div class="col py-2">
      <div class="card">
        <div class="card-body">
          <div class="float-right">Tue, Jan 10th 2019 8:30 AM</div>
          <h4 class="card-title">Day 2 Sessions</h4>
          <p class="card-text">Sign-up for the lessons and speakers that coincide with your course syllabus. Meet and greet with instructors.</p>
        </div>
      </div>
    </div>
  </div>
  <!--/row-->


  <!-- timeline item 2 -->
  <div class="row">
    <div class="col-auto text-center flex-column d-none d-sm-flex">
      <div class="row h-50">
        <div class="col border-right">&nbsp;</div>
        <div class="col">&nbsp;</div>
      </div>
      <h5 class="m-2">
        <span class="badge badge-pill bg-light border">&nbsp;</span>
      </h5>
      <div class="row h-50">
        <div class="col border-right">&nbsp;</div>
        <div class="col">&nbsp;</div>
      </div>
    </div>
    <div class="col py-2">
      <div class="card">
        <div class="card-body">
          <div class="float-right">Tue, Jan 10th 2019 8:30 AM</div>
          <h4 class="card-title">Day 2 Sessions</h4>
          <p class="card-text">Sign-up for the lessons and speakers that coincide with your course syllabus. Meet and greet with instructors.</p>
        </div>
      </div>
    </div>
  </div>
  <!--/row-->



  <!-- timeline item 3 -->
  <div class="row">
    <div class="col-auto text-center flex-column d-none d-sm-flex">
      <div class="row h-50">
        <div class="col border-right">&nbsp;</div>
        <div class="col">&nbsp;</div>
      </div>
      <h5 class="m-2">
        <span class="badge badge-pill bg-light border">&nbsp;</span>
      </h5>
      <div class="row h-50">
        <div class="col border-right">&nbsp;</div>
        <div class="col">&nbsp;</div>
      </div>
    </div>
    <div class="col py-2">
      <div class="card">
        <div class="card-body">
          <div class="float-right text-muted">Wed, Jan 11th 2019 8:30 AM</div>
          <h4 class="card-title">Day 3 Sessions</h4>
          <p>Shoreditch vegan artisan Helvetica. Tattooed Codeply Echo Park Godard kogi, next level irony ennui twee squid fap selvage. Meggings flannel Brooklyn literally small batch, mumblecore PBR try-hard kale chips. Brooklyn vinyl lumbersexual
            bicycle rights, viral fap cronut leggings squid chillwave pickled gentrify mustache. 3 wolf moon hashtag church-key Odd Future. Austin messenger bag normcore, Helvetica Williamsburg sartorial tote bag distillery Portland before
            they sold out gastropub taxidermy Vice.</p>
        </div>
      </div>
    </div>
  </div>
  <!--/row-->




  <!-- timeline item 3 -->
  <div class="row">
    <div class="col-auto text-center flex-column d-none d-sm-flex">
      <div class="row h-50">
        <div class="col border-right">&nbsp;</div>
        <div class="col">&nbsp;</div>
      </div>
      <h5 class="m-2">
        <span class="badge badge-pill bg-light border">&nbsp;</span>
      </h5>
      <div class="row h-50">
        <div class="col border-right">&nbsp;</div>
        <div class="col">&nbsp;</div>
      </div>
    </div>
    <div class="col py-2">
      <div class="card">
        <div class="card-body">
          <div class="float-right text-muted">Wed, Jan 11th 2019 8:30 AM</div>
          <h4 class="card-title">Day 3 Sessions</h4>
          <p>Shoreditch vegan artisan Helvetica. Tattooed Codeply Echo Park Godard kogi, next level irony ennui twee squid fap selvage. Meggings flannel Brooklyn literally small batch, mumblecore PBR try-hard kale chips. Brooklyn vinyl lumbersexual
            bicycle rights, viral fap cronut leggings squid chillwave pickled gentrify mustache. 3 wolf moon hashtag church-key Odd Future. Austin messenger bag normcore, Helvetica Williamsburg sartorial tote bag distillery Portland before
            they sold out gastropub taxidermy Vice.</p>
        </div>
      </div>
    </div>
  </div>
  <!--/row-->
  <!-- timeline item 4 -->
  <div class="row">
    <div class="col-auto text-center flex-column d-none d-sm-flex">
      <div class="row h-50">
        <div class="col border-right">&nbsp;</div>
        <div class="col">&nbsp;</div>
      </div>
      <h5 class="m-2">
        <span class="badge badge-pill bg-light border">&nbsp;</span>
      </h5>
      <div class="row h-50">
        <div class="col">&nbsp;</div>
        <div class="col">&nbsp;</div>
      </div>
    </div>
    <div class="col py-2">
      <div class="card">
        <div class="card-body">
          <div class="float-right text-muted">Thu, Jan 12th 2019 11:30 AM</div>
          <h4 class="card-title">Day 4 Wrap-up</h4>
          <p>Join us for lunch in Bootsy's cafe across from the Campus Center.</p>
        </div>
      </div>
    </div>
  </div>
  <!--/row-->





 





</div>
<!--container-->
  
 

    <h2>Senarai Surat</h2>  
        <hr>  
        
        

  <table class="table table-bordered mt-2">
    <thead>
      <tr>
        <th> Tindakan</th>
        <th>No Ruj Terakhir</th>
       
		    <th>No Fail</th>
            <th>Tajuk Surat/Rujukan </th>
        <th>Pada/Daripada </th>
        <th>Tarikh </th>
        <th>Dicipta Pada  </th>
        <th>Dicipta Oleh  </th>
        <th>   </th>
      </tr>
    </thead>
    <tbody>
      @foreach($letters as $index => $letter)
      <tr>

        <td><div class="btn-group">
            
            <div class="btn-group">
              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
              Surat
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#myModal{{  $letter->id }}">Keluar</a>

                



                <a class="dropdown-item btn-primary" href="#" data-toggle="modal" data-target="#myModalMasuk{{  $letter->id }}">Masuk</a>
              </div>
            </div>
          </div>
        
        
        
                <!-- The Modal -->
                <div class="modal" id="myModal{{  $letter->id }}">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                
                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Surat Keluar</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                
                      <!-- Modal body -->
                      <div class="modal-body">
                       
                        
                        
                        <form method="POST" action="{{ route('surat.store') }}">
                        
                        @csrf

                       

                         <div class="form-group">
                            <label for="pwd">Tajuk Surat :</label>
                            <input type="text" class="form-control"  name="letter" value="@if(!empty($users->letter)){{$users->letter}} @endif" required>
                          </div>


                            <div class="form-group">
                            <label for="email">Surat Dikirim pada : </label>
                            <input type="text" class="form-control"  name="sent_to" value="@if(!empty($users->sent_to)){{$users->sent_to}} @endif" required>
                          </div>

                          <div class="form-group">
                            <label for="email">Bertarikh : </label>
                            <input type="text" class="form-control"  name="date_letter" value="" required>
                          </div>

                          <div class="form-group">
                            <label for="email">Dirangkum pada : </label>
                            <input type="text" class="form-control"  name="" value="" required>
                          </div>

                          
                          
                          <div class="form-group">
                            <input   type="hidden"  name="in_out" value="2">
                            <input   type="hidden"  name="fail_id" value="{{$letter->fail_id}}">
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








                <!-- The Modal -->
                <div class="modal" id="myModalMasuk{{  $letter->id }}">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                
                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Surat Masuk</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                
                      <!-- Modal body -->
                      <div class="modal-body">
                       
                        
                        <form method="POST" action="{{ route('surat.store') }}">
                        
                            @csrf
    
                           
    
                             <div class="form-group">
                                <label for="pwd">Rujukan :</label>
                                <input type="text" class="form-control"  name="ref_letter" value="@if(!empty($users->ref_letter)){{$users->ref_letter}} @endif" required>
                              </div>
    
    
                                <div class="form-group">
                                <label for="email">Tarikh : </label>
                                <input type="date" class="form-control"  name="date_letter" value="@if(!empty($users->date_letter)){{$users->date_letter}} @endif" required>
                              </div>
    
                              <div class="form-group">
                                <label for="email">Daripada : </label>
                                <input type="text" class="form-control"  name="sent_from" value="@if(!empty($users->sent_from)){{$users->sent_from}} @endif" required>
                              </div>
    
                              <div class="form-group">
                                <label for="email">dikandung pada : </label>
                                <input type="text" class="form-control"  name="" value="<?php echo date('d-m-Y h:i:s'); ?>" readonly>
                              </div>
    
                              
                              
                              <div class="form-group">
                                <input   type="hidden"  name="in_out" value="1">
                                <input   type="hidden"  name="fail_id" value="{{$letter->fail_id}}">
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



        
        
        </td>
         
        <td></td>
        <td>{{  $letter->fails->ref_no }} </td>
		<td>
            @if($letter->in_out==1) 
            {{  $letter->ref_letter }}
            @else 

            @endif
        </td>
        <td class="justify-content-center">  </td> 
        <td class="justify-content-center">  {{$letter->desc_fail}} </td> 
        <td>{{$letter->desc_fail}}</td>
        <td>  </td>
        <td class="justify-content-center"> 
           
          <a href="{{ route('fail.delete', $letter->id) }}" class="btn btn-danger btn-sm"  onclick="return confirm('anda Pasti ?')">
            <i class='fas fa-trash'></i>
          </a>

          <a href="{{ route('fail.edit', $letter->id) }}" class="btn btn-warning btn-sm"   >
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

 

@endsection
