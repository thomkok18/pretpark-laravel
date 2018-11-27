@include('inc/header')

<div class="container-fluid">
    <div class="page-header">
        <h1>Attractie overzicht</h1>
        <hr>
    </div>

    <div class="row">
        @if(count($attracties) > 0)
            @foreach($attracties as $attractie)
                <div class="col-xs-12 col-md-6 col-lg-4 attractieDiv">
                    <div>
                        <img width="300px" height="300px" src="/storage/cover_images/{{$attractie->cover_image}}">
                    </div>
                    <div class="textDiv">
                        <h3>{!!$attractie->title!!}</h3>
                        <p>{!!$attractie->description!!}</p>
                        <i>Gemaakt door: {!!$attractie->user->name!!}</i>
                        <br>
                        <a class="btn btn-secondary" href="/attractie/{{$attractie->id}}">Lees meer</a>
                    </div>
                    <br>
                </div>
            @endforeach
        @else
            <p>Er zijn nog geen attracties</p>
        @endif
    </div>
    {{$attracties->render()}}
</div>

@include('inc/footer')
