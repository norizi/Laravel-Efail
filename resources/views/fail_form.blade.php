@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Maklumat Fail</div>

                     <div class="card-body">
                        @if($act=='edit')
                        <form method="POST" action="{{ route('fail.update') }}">
                        @else
                        <form method="POST" action="{{ route('fail.store') }}">
                        @endif
                        @csrf


                            <div class="form-group">
                            <label for="email">No. Rujukan :</label>
                            <input type="text" class="form-control"  name="ref_no" value="{{ $fail->ref_no ?? '' }}" required>
                          </div>

                          <div class="form-group">
                            <label for="pwd">Kulit :</label>
                            <select class="form-control" name="kulit_id" >
                                <option value="">-Pilih-</option>
                                @foreach($kulits as $index => $kulit)
                                <option value="{{ $kulit->id }}"  @if($act=='edit') {{ ($fail->kulit_id) == $kulit->id ? 'selected' : '' }} @endif>
                                    {{ $kulit->kulit }}</option>
                                @endforeach
                              </select>
                          </div>


                          <div class="form-group">
                            <label for="pwd">Nama Fail :</label>
                            <input type="text" class="form-control"  name="title" value="{{ $fail->title ?? '' }}" required>
                          </div>

                          <div class="form-group">
                            <label for="pwd">Jenis Fail :</label>
                            <select class="form-control" name="typefail_id" required>
                                <option value="">-Pilih-</option>
                                @foreach($typefails as $index => $typefail)
                                <option value="{{ $typefail->id }}" @if($act=='edit') {{ ($fail->typefail_id) == $typefail->id ? 'selected' : '' }} @endif>
                                    {{ $typefail->type_fail }}</option>
                                @endforeach
                              </select>
                          </div>


                          <div class="form-group">
                            <label for="pwd">Status Fail :</label>
                            <select class="form-control" name="status_id" required>
                                <option value="">-Pilih-</option>
                                @foreach($statuss as $index => $status)
                                <option value="{{ $status->id }}" @if($act=='edit') {{ ($fail->status_id) == $status->id ? 'selected' : '' }} @endif>
                                    {{ $status->status }}</option>
                                @endforeach
                              </select>
                          </div>


                          


                          <div class="form-group">
                            <label for="pwd">Catatan :</label>
                            <input type="text" class="form-control"  name="desc_fail" value="{{ $fail->desc_fail ?? '' }}"  >
                          </div>

                          
                          <div class="form-group">
                            <input   type="hidden"  name="id" value="@if(!empty($fail->id)) {{$fail->id}} @endif">
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
