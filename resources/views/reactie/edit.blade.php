@include('inc/header')

<div class="container-fluid">
    <div class="page-header">
        <h1>Attractie</h1>
        <hr>
    </div>

    <div>
        @auth
            <div style="display: flex;">
                <img id="profielAfbeelding" src="{{url('/storage/cover_images/'.auth()->user()->cover_image)}}" alt="{{auth()->user()->name}}">
                <p style="margin-top:25px; margin-left:15px;">{{auth()->user()->name}}</p>
            </div>
            <form action="{{url('/attractie/update/reactie/'.$reactie->id)}}" method="POST">
                @csrf
                <div class="form-group">
                    <textarea id="article-ckeditor" class="form-control" name="comment" placeholder="Voeg reactie toe">{{$reactie->comment}}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="form-control">Aanpassen</button>
                </div>
            </form>
        @endauth
    </div>
</div>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('article-ckeditor');
</script>

@include('inc/footer')
