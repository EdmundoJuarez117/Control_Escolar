@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-5">
            <div class="card">
                <div class="card-header bg-primary text-white">{{ __('Iniciar sesión') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

												<div class="row">
													<div class="col-12">
														<div class="form-group">
															<label for="email" class="form-label">{{ __('Usuario') }}</label>
															<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

															@error('email')
																	<span class="invalid-feedback" role="alert">
																			<strong>{{ $message }}</strong>
																	</span>
															@enderror
														</div>
													</div>
												</div>

												<div class="row">
												<div class="col-12 mt-3">
												<div class="form-group">
													<label for="password" class="form-label">{{ __('Clave') }}</label>
													<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
													@error('password')
															<span class="invalid-feedback" role="alert">
																	<strong>{{ $message }}</strong>
															</span>
													@enderror
												</div>
												</div>
												</div>

												@if (FALSE)
                        <div class="row">
                            <div class="col-12 mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
												@endif

												<div class="row">
														<div class="col-12 col-md-12 mt-3">
															@if (Route::has('password.request'))
																	<a class="btn btn-link" href="{{ route('password.request') }}">
																			{{ __('Forgot Your Password?') }}
																	</a>
															@endif
                            </div>
											  </div>
												<div class="row justify-content-center">
														<div class="col-12 col-md-3 mt-3">
															<button type="submit" class="btn btn-primary w-100 text-white">
																	{{ __('Iniciar') }}
															</button>
														</div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
