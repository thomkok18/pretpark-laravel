@include('inc/header')

<form action="{{url('/beheerder/attractie/update/'.$attractie->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    {{method_field('PUT')}}
    <div class="form-group">
        <input type="text" class="form-control" name="title" placeholder="Titel" value="{!!$attractie->title!!}">
    </div>
    <div class="form-group">
        <textarea id="article-ckeditor" class="form-control" name="description" placeholder="Omschrijving">{!!$attractie->description!!}</textarea>
    </div>
    <div class="form-group">
        <input type="file" name="cover_image" accept="image/*">
    </div>
    <div class="form-group">
        <button type="submit" class="form-control">Verzenden</button>
    </div>
</form>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'article-ckeditor' );
</script>

@include('inc/footer')
