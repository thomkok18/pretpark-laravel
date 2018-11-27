@include('inc/header')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <div>
                        <h3>Persoonsgegevens</h3>
                    </div>
                    <form action="{{url('/home/update/'.auth()->user()->id.'/persoonsgegevens')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Naam" value="{{auth()->user()->name}}">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email" value="{{auth()->user()->email}}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control">Opslaan</button>
                        </div>
                    </form>
                    <div>
                        <h3>Wachtwoord</h3>
                    </div>
                    <form action="{{url('/home/update/'.auth()->user()->id.'/wachtwoord')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Wachtwoord" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Herhaal Wachtwoord" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control">Opslaan</button>
                        </div>
                    </form>
                    <div>
                        <h3>Profielfoto</h3>
                    </div>
                    <form action="{{url('/home/update/'.auth()->user()->id.'/profielfoto')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" name="cover_image" accept="image/*">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control">Opslaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('inc/footer')
