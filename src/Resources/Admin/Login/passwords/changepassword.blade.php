@extends('Admin.adminapp')
@section('content')
<div class="page animsition" style="animation-duration: 800ms; opacity: 1;">
   <div class="col-md-12 col-xs-12 padding-0">
      <h1>Đổi mật khẩu</h1> 
   </div>
   <div class="page-content padding-30 container-fluid">    
      <div class="col-xs-12 padding-0 margin-top-30">
         <div class="card-body">
            <form method="POST" action="{!! route('admin.changepass') !!}">
               @csrf
               <div class="form-group row">
                  <label for="oldpass" class="col-md-4 col-form-label text-md-right">Mật khẩu cũ</label>
                  <div class="col-md-6">
                     <input id="oldpass" type="password" class="form-control{{ $errors->has('oldpass')? ' is-invalid' : ''}}" name="oldpass" value="{{ $oldpass ?? old('oldpass') }}" required autofocus>
                     @if ($errors->has('oldpass'))
                        <span class="invalid-feedback">
                           <strong>{{ $errors->first('oldpass') }}</strong>
                        </span>
                     @endif
                  </div>
               </div>
               <div class="form-group row">
                  <label for="password" class="col-md-4 col-form-label text-md-right">Mật khẩu</label>
                  <div class="col-md-6">
                     <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                     @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                     @endif
                  </div>
               </div>
               <div class="form-group row">
                  <label for="confirm" class="col-md-4 col-form-label text-md-right">Xác nhận mật khẩu</label>
                     <div class="col-md-6">
                        <input id="confirm" type="password" class="form-control" name="confirm" required>
                        @if ($errors->has('confirm'))
                           <span class="invalid-feedback">
                              <strong>{{ $errors->first('confirm') }}</strong>
                           </span>
                        @endif
                     </div>
               </div>
               <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                     <button type="submit" class="btn btn-primary">Gửi</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>   
</div>
@endsection