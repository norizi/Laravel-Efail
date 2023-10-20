@extends('layouts.app')

@section('content')
<div class="container">
  @if(Session::has('success'))
  <p class="alert alert-info">{{ Session::get('success') }}</p>
  @endif

  @if(Session::has('error'))
  <p class="alert alert-danger">{{ Session::get('error') }}</p>
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



     

<?php //echo count($letters); ?>

<div class="container">
  
  <form method="POST" action="{{ route('fail.update') }}" class="ml-3">
    
    @csrf
 


      <div class="form-group">
        <label for="pwd">Sila Pilih Fail :</label>
        <select class="form-control select2-single" name="status_id" required onchange="OnChangeFail(this.options[this.selectedIndex].value)">
            <option value="">-Pilih-</option>
            @foreach($fails as $index => $fail)
            <option value="{{ $fail->id }}" @php if(!empty($fail_id)){ if($fail_id==$fail->id){ echo "selected"; }} @endphp>
                {{ $fail->title }}  {{ $fail->ref_no }} {{ $fail->kulits->kulit ?? '' }} </option>
            @endforeach
          </select>
      </div>


       
    
</form>

@foreach($letters as $index => $letter)


   

  @if($letter->in_out==1)
   
  <!-- timeline item 2 -->
  <div class="row">

    @if($index+1==1)
    <!-- timeline item 1 left dot -->
    <div class="col-auto text-center flex-column d-none d-sm-flex">
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
    @endif
    
    <div class="col py-2">
      <div class="card border-danger">
        <div class="card-body">
          <div class="float-right">
            <span class="badge badge-primary"><?php echo $date_letter = date("d-m-Y", strtotime($letter->date_letter));  ?>
            </span>
            </div>
            
          <h5 class="card-title"><span class="badge badge-danger">{{$letter->fails->ref_no}} ({{$letter->seq_no}}) {{$letter->fails->kulits->kulit}} - {{$letter->fails->title}}</h5>
         
          <p class="card-text">Daripada : {{$letter->sent_from}}</p>       
          {{$letter->letter ?? ''}}<br> 
          Rujukan : {{$letter->ref_letter}}
            </span>
           
          <div class="float-right">dikandung pada : <?php echo $letter->created_at->format('d M Y h:i A') ?> oleh 
            <span class="badge badge-warning">{{$letter->users->name ?? '' }}</span>
           </div>
        </div>
      </div>
    </div>
  </div>
  <!--/row-->


   


  @else
   
  <!-- timeline item 2 -->
  <div class="row">
    <div class="col-auto text-center flex-column d-none d-sm-flex">
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
          
          <h5 class="card-title"><span class="badge badge-primary">{{$letter->fails->ref_no ?? '' }} ({{$letter->seq_no ?? '' }}) {{$letter->fails->kulits->kulit ?? ''}} - {{$letter->fails->title ?? ''}}</h5>
          
          <p class="card-text">Surat dikirim pada : {{$letter->sent_to}}</p>
          {{$letter->letter}}
          </span>
          <div class="float-right">dirangkum pada : <?php echo $letter->created_at->format('d M Y h:i A') ?> 
            oleh<span class="badge badge-warning"> {{$letter->users->name ?? '' }}</span>

            </div>
        </div>
      </div>
    </div>
  </div>
  <!--/row-->

 

  @endif

  

  


  


             



  @endforeach



 
 
</div>
    

  <div class="d-flex justify-content-center">
    

    
</div>

  
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.js"></script>
<script>
     

  function OnChangeFail(val)
  {
   //alert(val);
   var base_url = "{{url()->current()}}";
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

