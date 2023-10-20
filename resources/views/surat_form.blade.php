@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Maklumat Surat <?php echo strtoupper($type); ?></div>

                     <div class="card-body">
                        @if($act=='edit')
                        <form method="POST" action="{{ route('surat.update') }}">
                        @else
                        <form method="POST" action="{{ route('surat.store') }}">
                        @endif
                        @csrf

                        @if($type=='in')

                         <div class="form-group">
                            <label for="pwd">Tajuk Surat :</label>
                            <input type="text" class="form-control"  name="title" value="@if(!empty($users->title)){{$users->title}} @endif" required>
                          </div>


                            <div class="form-group">
                            <label for="email">Surat Dikirim pada : </label>
                            <input type="text" class="form-control"  name="ref_no" value="@if(!empty($users->ref_no)){{$users->ref_no}} @endif" required>
                          </div>

                          <div class="form-group">
                            <label for="email">Bertarikh : </label>
                            <input type="text" class="form-control"  name="ref_no" value="@if(!empty($users->ref_no)){{$users->ref_no}} @endif" required>
                          </div>

                          <div class="form-group">
                            <label for="email">Dirangkum pada : </label>
                            <input type="text" class="form-control"  name="ref_no" value="@if(!empty($users->ref_no)){{$users->ref_no}} @endif" required>
                          </div>

                          
                          @else

                          @endif

                          
                          <div class="form-group">
                            <input   type="hidden"  name="id" value="@if(!empty($users->id)) {{$users->id}} @endif">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                          </div>
                         
						
						
                      

                      



                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
