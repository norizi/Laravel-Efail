@extends('layouts.app')

@section('content')
<div class="container">
  @if(Session::has('success'))
  <p class="alert alert-info d-print-none">{{ Session::get('success') }}</p>
  @endif

  @if(Session::has('error'))
  <p class="alert alert-danger d-print-none">{{ Session::get('error') }}</p>
  @endif
    
  @if ($errors->any())
    <div class="alert alert-danger d-print-none">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">      
  

<h2 class="text-center py-3 d-print-none">Senarai Surat Keluar / Masuk</h2>
<div class="d-print-none"> 
<hr class="d-print-none">

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



</div>
</div>

    @if(!empty($fail_id))
    <div class="d-print-none"> 
    <div class="container ml-3"> 
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalKeluar">Surat Keluar : </button>
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModalMasuk">Surat Masuk </button> 
    <button type="button" class="btn btn-secondary" onclick="window.print()">Cetak </button>
  </div>

    <!-- The Modal -->
                <div class="modal" id="myModalKeluar">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                
                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Surat Keluar </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                
                      <!-- Modal body -->
                      <div class="modal-body">
                       
                        
                        
                        <form method="POST" action="{{ route('surat.store') }}">
                        
                        @csrf

                       

                         <div class="form-group">
                            <label for="pwd">Tajuk Surat :</label>
                            <input type="text" class="form-control"  onkeyup="this.value=this.value.toUpperCase()" name="letter" value="@if(!empty($users->letter)){{$users->letter}} @endif" required>
                          </div>


                            <div class="form-group">
                            <label for="email">Surat Dikirim pada : </label>
                            <input type="text" class="form-control"  name="sent_to" onkeyup="this.value=this.value.toUpperCase()"  value="" required>
                          </div>

                          <div class="form-group">
                            <label for="email">Bertarikh : </label>
                            <input type="date" class="form-control"  name="date_letter" value="<?php echo date('d-m-Y'); ?>" required>
                          </div>

                          <div class="form-group">
                            <label for="email">Dirangkum pada : </label>
                            <input type="text" class="form-control"  name="" value="<?php echo date('d-m-Y h:i:s'); ?>" readonly>
                          </div>

                          
                          
                          <div class="form-group">
                            <input   type="hidden"  name="in_out" value="2">
                            <input   type="hidden"  name="fail_id" value="{{$fail_id}}">
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
                <div class="modal" id="myModalMasuk">
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
                                <input type="text" class="form-control"  onkeyup="this.value=this.value.toUpperCase()" name="ref_letter" value="@if(!empty($users->ref_letter)){{$users->ref_letter}} @endif" required>
                              </div>
    
    
                              <div class="form-group">
                                <label for="pwd">Tajuk Surat :</label>
                                <input type="text" class="form-control"  onkeyup="this.value=this.value.toUpperCase()" name="letter" value="{{ $letter->letter ?? '' }}"  >
                              </div>
    
                              <div class="form-group">
                                <label for="email">Daripada : </label>
                                <input type="text" class="form-control"  onkeyup="this.value=this.value.toUpperCase()" name="sent_from" value="@if(!empty($users->sent_from)){{$users->sent_from}} @endif" required>
                              </div>

                              <div class="form-group">
                                <label for="email">Tarikh : </label>
                                <input type="date" class="form-control"  id="datetimepicker4" name="date_letter" value="<?php echo date('d-m-Y'); ?>" required>
                              </div>
    
                              <div class="form-group">
                                <label for="email">dikandung pada : </label>
                                <input type="text" class="form-control"  name="" value="<?php echo date('d-m-Y h:i:s'); ?>" readonly>
                              </div>
    
                              
                              
                              <div class="form-group">
                                <input   type="hidden"  name="in_out" value="1">
                                <input   type="hidden"  name="fail_id" value="{{$fail_id}}">
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
@endif

<?php //echo count($letters); ?>



<div class="container py-2 mt-4 mb-4">

 
  <div class="ml-3 d-print-none">
  <form class="form-inline" action="{{ route('fail.search') }}" method="POST">
  @csrf
    
    
    <select class="form-control mb-2 mr-sm-2" name="type" required>
      <option value="">-Pilih-</option>
      <option value="ref_letter">Rujukan Masuk</option>
      <option value="letter">Tajuk Surat</option>
      
    </select>

    
    <input type="text" class="form-control mb-2 mr-sm-2 w-50"    name="val" required>
    
    <button type="submit" class="btn btn-primary mb-2">Cari</button>&nbsp;
    <a href="{{ route('home') }}" class="btn btn-danger mb-2">Reset</a>
  </form>
</div>
  
  <hr class="d-print-none">


@foreach($letters as $index => $letter)


   

  @if($letter->in_out==1)
   
  <!-- timeline item 2 -->
  <div class="row">

    @if($index+1==1)
    <!-- timeline item 1 left dot -->
    <div class="col-auto text-center flex-column d-none d-sm-flex d-print-none">
      <div class="row h-50">
        <div class="col">&nbsp;</div>
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
    @else
    <div class="col-auto text-center flex-column d-none d-sm-flex d-print-none">
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
    @endif
    
    <div class="col py-2">
      <div class="card border-danger">
        <div class="card-body">
          <div class="float-right">
            <span class="badge badge-primary"><?php echo $date_letter = date("d-m-Y", strtotime($letter->date_letter));  ?>
            </span>
            </div>
            <a href=""  class="text-decoration-none" data-toggle="modal" data-target="#myModalEditIn{{$letter->id}}"> 
          <h5 class="card-title"><span class="badge badge-danger">{{$letter->fails->ref_no}} ({{$letter->seq_no}}) {{$letter->fails->kulits->kulit}} - {{$letter->fails->title}} </h5>
            </a>
          <p class="card-text">Daripada : {{$letter->sent_from}}</p>   
          
          {{$letter->letter ?? ''}}<br>
          Rujukan : {{$letter->ref_letter}}
              
            </span>
           
          <div class="float-right">dikandung pada : <?php echo $letter->created_at->format('d M Y h:i A') ?> 
            <span class="d-print-none">
              oleh 
            <span class="badge badge-warning">{{$letter->users->name}}</span>
            </span>
           </div>
        </div>
      </div>
    </div>
  </div>
  <!--/row-->


  <!-- The Modal -->
  <div class="modal" id="myModalEditIn{{$letter->id}}">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Surat Masuk </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
         
          
          <form method="POST" action="{{ route('suratIn.update') }}">
          
              @csrf
              <div class="form-group">
                No Fail : <span class="badge badge-danger">
                  {{$letter->fails->ref_no}} ({{$letter->seq_no}}) {{$letter->fails->kulits->kulit ?? ''}} - {{$letter->fails->title}}
                </span>
                
              </div>
             
              <div class="form-group">
                <label for="pwd">Seq :</label>
                <input type="number" class="form-control"  name="seq_no" value="{{ $letter->seq_no ?? '' }}" required>
              </div>

              <div class="form-group">
                <label for="pwd">Tajuk Surat :</label>
                <input type="text" class="form-control"  onkeyup="this.value=this.value.toUpperCase()" name="letter" value="{{ $letter->letter ?? '' }}" required>
              </div>


               <div class="form-group">
                  <label for="pwd">Rujukan :</label>
                  <input type="text" class="form-control"  onkeyup="this.value=this.value.toUpperCase()" name="ref_letter" value="{{ $letter->ref_letter ?? '' }}" required>
                </div>


                 

                <div class="form-group">
                  <label for="email">Daripada : </label>
                  <input type="text" class="form-control"  onkeyup="this.value=this.value.toUpperCase()" name="sent_from" value="{{ $letter->sent_from ?? '' }}" required>
                </div>

                <div class="form-group">
                  <label for="email">Tarikh : </label>
                  <input type="date" class="form-control"  id="datetimepicker4" name="date_letter" value="{{ $letter->date_letter ?? '' }}" required>
                </div>

                <div class="form-group">
                  <label for="email">dikandung pada : </label>
                  <input type="text" class="form-control"  name="" value="{{ $letter->created_at ?? '' }}" readonly>
                </div>

                
                
                <div class="form-group">
                  <input   type="hidden"  name="in_out" value="1">
                  <input   type="hidden"  name="id" value="{{$letter->id}}">
                  <input   type="hidden"  name="fail_id" value="{{$fail_id}}">
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



  @else
   
  <!-- timeline item 2 -->
  <div class="row">
    <div class="col-auto text-center flex-column d-none d-sm-flex d-print-none">
      <div class="row h-50">
        <div class="col border-right">&nbsp;</div>
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
    <div class="col py-2">
      <div class="card border-primary">
        <div class="card-body">
          <div class="float-right">
            <span class="badge badge-primary">
              <?php echo $date_letter = date("d-m-Y", strtotime($letter->date_letter));  ?>
            </span>
          </div>
          <a href=""  class="text-decoration-none" data-toggle="modal" data-target="#myModalEdit{{$letter->id}}"> 
          <h5 class="card-title"><span class="badge badge-primary">{{$letter->fails->ref_no}} ({{$letter->seq_no}}) {{$letter->fails->kulits->kulit}} - {{$letter->fails->title}}</h5>
          </a>
          <p class="card-text">Surat dikirim pada : {{$letter->sent_to}}</p>
           {{$letter->letter}}
          </span>
          <div class="float-right">dirangkum pada : <?php echo $letter->created_at->format('d M Y h:i A') ?> 
          <span class="d-print-none">  
            oleh<span class="badge badge-warning"> {{$letter->users->name}}</span> 
          </span>

            </div>
        </div>
      </div>
    </div>
  </div>
  <!--/row-->


  <!-- The Modal -->
  <div class="modal" id="myModalEdit{{$letter->id}}">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Surat Keluar 
        </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
         
          
          
          <form method="POST" action="{{ route('suratOut.update') }}">
          
          @csrf
          <div class="form-group">
            No Fail : <span class="badge badge-primary">
              {{$letter->fails->ref_no}} ({{$letter->seq_no}}) {{$letter->fails->kulits->kulit ?? ''}} - {{$letter->fails->title}}
            </span>
            
          </div>

          <div class="form-group">
            <label for="pwd">Seq :</label>
            <input type="number" class="form-control"  name="seq_no" value="{{ $letter->seq_no ?? '' }}" required>
          </div>
         

           <div class="form-group">
              <label for="pwd">Tajuk Surat :</label>
              <input type="text" class="form-control"  onkeyup="this.value=this.value.toUpperCase()" name="letter" value="{{ $letter->letter ?? '' }}" required>
            </div>


              <div class="form-group">
              <label for="email">Surat Dikirim pada : </label>
              <input type="text" class="form-control"  name="sent_to" onkeyup="this.value=this.value.toUpperCase()"  value="{{ $letter->sent_to ?? '' }}" required>
            </div>

            <div class="form-group">
              <label for="email">Bertarikh : </label>
              <input type="date" class="form-control"  name="date_letter" value="{{ $letter->date_letter ?? '' }}" required>
            </div>

            <div class="form-group">
              <label for="email">Dirangkum pada : </label>
              <input type="text" class="form-control"  name="" value="{{ $letter->created_at ?? '' }}" readonly>
            </div>

            
            
            <div class="form-group">
              <input   type="hidden"  name="in_out" value="2">
              <input   type="hidden"  name="id" value="{{$letter->id}}">
              <input   type="hidden"  name="fail_id" value="{{$fail_id}}">
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


  @endif

  

  


  
  

             



  @endforeach



 
 
</div>
    

  <div class="d-flex justify-content-center d-print-none">
  
    {!! $letters->links() !!}
    
</div>

  
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.js"></script>

<script>
     

  function OnChangeFail(val)
  {
   //alert(val);
   var base_url = "<?php echo url("home"); ?>";
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

 
</script>  

@endsection

