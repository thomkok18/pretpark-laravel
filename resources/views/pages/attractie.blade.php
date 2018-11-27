@include('inc/header')

<div class="container-fluid">
    <div class="page-header">
        <h1>Attractie</h1>
        <hr>
    </div>

    <div class="row" style="margin-bottom:15px;">
        <div class="col-xs-12 col-sm-12">
            <img id="attractieImage" src="{{url('/storage/cover_images/'.$attractie->cover_image)}}" alt="Attractie">
        </div>
        <div class="col-xs-12 col-sm-12">
            <h3>{{$attractie->title}}</h3>
            <p style="word-wrap: break-word; white-space: pre-wrap;">{!!$attractie->description!!}</p>
        </div>
    </div>
    <hr>
    <div>
        @auth
            <div style="display: flex;">
                <img id="profielAfbeelding" src="{{url('/storage/cover_images/'.auth()->user()->cover_image)}}" alt="{{auth()->user()->name}}">
                <p style="margin-top:25px; margin-left:15px;">{{auth()->user()->name}}</p>
            </div>
            <form action="{{url('/attractie/'.$attractie->id.'/store/reactie')}}" method="POST">
                @csrf
                <div class="form-group">
                    <textarea id="article-ckeditor" class="form-control" name="comment" placeholder="Voeg reactie toe"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="form-control">Reageren</button>
                </div>
            </form>
            @if(count($reacties) > 0)
                <hr>
            @endif
        @endauth

        @foreach($reacties as $reactie)
            @if($reactie->attractie_id == $attractie->id)
                <div class="row">
                    <div class="col-xs-12 col-md-1">
                        <img id="reactieProfielfoto" src="{{url('/storage/cover_images/'.$reactie->user->cover_image)}}" alt="{{$reactie->user->name}}">
                    </div>
                    <div class="col-xs-12 col-md-10">
                        <b id="gebruikersnaam">{{$reactie->user->name}}</b>
                        <div id="reactieTekst">
                            {!!$reactie->comment!!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-1">
                        <div style="display: flex;">
                            <form action="{{url('/attractie/edit/reactie/'.$reactie->id)}}" method="GET">
                                @csrf
                                <input style="margin-right: 5px;" id="bewerkImage" type="image" src="{{url('/storage/cover_images/bewerk.jpg')}}">
                            </form>
                            <form action="{{url('/attractie/destroy/reactie/'.$reactie->id)}}" method="POST">
                                @csrf
                                {{method_field('DELETE')}}
                                <input id="prullenbak" type="image" src="{{url('/storage/cover_images/prullenbakOpen.jpg')}}">
                            </form>
                        </div>
                    </div>
                </div>
                <hr style="margin-top: 0;">
            @endif
            @if($reactie->getReactiesByAttractieId($attractie->id) == 0 || count($reacties) == 0)
                <p style="margin-bottom: 30px;">Er zijn geen reacties geplaatst.</p>
                @break
            @endif
        @endforeach
    </div>
</div>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('article-ckeditor');
</script>

@include('inc/footer')
