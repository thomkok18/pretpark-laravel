@include('inc/header')

<form action="{{url('/product/store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <input type="text" class="form-control" name="title" placeholder="Titel">
    </div>
    <div class="form-group">
        <textarea id="article-ckeditor" class="form-control" name="description" placeholder="Omschrijving"></textarea>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" name="price" placeholder="Prijs">
    </div>
    <div class="form-group">
        <input type="number" class="form-control" name="stock" placeholder="Voorraad">
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
