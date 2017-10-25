@extends('layouts.app')

@section('styles')
    <style type="text/css" media="screen">
        #social-btn{
            transition: 50ms;
        }
        #social-btn:hover{
            transform: scale(1.3);
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 hide">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
              </ol>

              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
                <?php $i = 0; ?>
                @foreach ($carousels as $carousel)
                    @if ($i == 0)
                        <div class="item active">
                          <img src="{{ $carousel->path }}" alt="">
                        </div>
                        
                    <?php $i++; ?>
                    @elseif ($i > 0)
                        <div class="item">
                          <img src="{{ $carousel->path }}" alt="">
                        </div>
                    @endif
                @endforeach
              </div>

              <!-- Left and right controls -->
              <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
            <br>
            <center> <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p> </center>
        </div>
        <div class="col-md-4 col-md-offset-8">
            <div class="panel panel-default" style="margin-bottom: 2px;">
                <div class="panel-body" style="padding-bottom: 7px;">

                    <!-- Tabs -->
                    <ul class="nav nav-tabs">
                        <li id="login" class="active"><a>Login</a></li>
                        <li id="register" class=""><a>Register</a></li>
                        <a href="login/google"><button id="social-btn" class="btn btn-sm pull-right" style="border-radius: 100px; border: none; padding: 10px; width: 38px; margin-left: 10px; background: #dd4b39;"><span class="fa fa-google" style="color: white;"></span></button></a>
                        <a href="login/facebook"><button id="social-btn" class="btn btn-sm pull-right" style="border-radius: 100px; border: none; padding: 10px; width: 38px; margin-left: 10px; background: #2d4373;"><span class="fa fa-facebook" style="color: white;"></span></button></a>
                        
                    </ul><br>

                    <!-- Login -->
                    <form id="loginform" class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group" style="margin-bottom: 0;">
                            <div class="col-md-12 col-md-offset-4" style="font-size: 10px;">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} > Remember Me
                                <a class="btn btn-link" href="{{ route('password.request') }}" style="font-size: 10px;">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>

                        <div class="form-group" style="margin-bottom: 5px;">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>


                        <!-- &nbsp &nbsp <a href="#" class="pull-right" title="Admin" data-toggle="modal" data-target="#myModal" style="color: #ababab; font-size: 10px; margin: 0 4px 0 0;">Admin</a> -->
                    </form>


                    <!-- Register -->
                    <form id="registerform" class="form-horizontal hidden" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }} hide">
                            <label for="avatar" class="col-md-4 control-label">Avatar</label>

                            <div class="col-md-8">
                                <input id="avatar" type="avatar" class="form-control" name="avatar" value="0" required>

                                @if ($errors->has('avatar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('is_what') ? ' has-error' : '' }} hide">
                            <label for="is_what" class="col-md-4 control-label">is_what</label>

                            <div class="col-md-8">
                                <input id="is_what" type="is_what" class="form-control" name="is_what" value="0" required>

                                @if ($errors->has('is_what'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('is_what') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm</label>

                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog" style="margin-top: 180px;">
                <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content col-md-7 col-md-offset-2">
                    <div class="modal-body" style="padding: 15px 0 15px 0;">  
                        <form>
                            <label for="password-confirm" class="control-label">Username</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            <br>
                            <label for="password-confirm" class="control-label">Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </form>
                    </div>
                </div>

              </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $("#register").click(function(){
            $("#register").addClass('active');
            $("#login").removeClass();
            $("#registerform").removeClass('hidden');
            $("#loginform").addClass('hidden');
        });
        $("#login").click(function(){
            $("#login").addClass('active');
            $("#register").removeClass();
            $("#loginform").removeClass('hidden');
            $("#registerform").addClass('hidden');
        });
    });
</script>
@endsection
