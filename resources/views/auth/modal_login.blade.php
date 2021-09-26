 <!-- Modal Login-->
 <div class="modal fade" id="modal_login" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header" style="background-color:#f5f5f5; color:gray;">
                 <h4 class="modal-title" id="myModalLabel">Login</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
             </div>
             <div class="modal-body">
                 {!! Form::open(['route' => 'auth.login', 'class' => 'login100-form validate-form', 'id' => 'formlogin']) !!}

                 <div class="form-group">
                     <label class="col-md-4 control-label">Email</label>
                     <div class="col-md-12">
                         <input type="email" class="form-control" id="email" name="email" value="{{old('email_forgot')}}" placeholder="Masukan Email" style="background-color: #F0FFFF;">
                         @if(Session::has('email_not_found'))
                         <p class="help-block error-help-block"><em> {!! session('email_not_found') !!} </em></p>
                         @endif
                     </div>
                 </div>
                 <div class="form-group">
                     <label class="col-md-4 control-label">Password</label>
                     <div class="col-md-12">
                         <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}" placeholder="Masukan Password" style="background-color: #F0FFFF;">
                     </div>
                 </div>
                 <div class="form-group">
                     <div class="col-md-6">
                         <div class="checkbox icheck">
                             <label>
                                 <a href="#" style="font-size: 12px;" id="forgot_password"> Lupa Password </a>
                             </label>
                         </div>
                     </div>
                 </div>
                 <div class="form-group">
                     <div class="col-md-4 col-md-offset-4">
                         <button type="submit" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" id="button-reg">
                             Log-In
                         </button>
                     </div>
                 </div>
                 {!! Form::close() !!}
                 <div class="form-group">
                     <div class="col-md-12">
                         <div class="checkbox icheck">
                             <label>
                                 <p style="font-size: 12px;">Jika anda tidak memiliki akun silahkan mendaftar terlebih dahulu <a href="{{ url('register') }}" style="font-size: 12px; color: green;">disini!</a></p>
                             </label>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <!--end of Modal Login -->