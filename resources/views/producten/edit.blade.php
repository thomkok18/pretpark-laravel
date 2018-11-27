@include('inc/header')

<form action="{{url('/beheerder/product/update/'.$product->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <input type="text" class="form-control" name="title" placeholder="Titel" value="{!!$product->title!!}">
    </div>
    <div class="form-group">
        <textarea id="article-ckeditor" class="form-control" name="description" placeholder="Omschrijving">{!!$product->description!!}</textarea>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" name="price" placeholder="Prijs" value="{!!$product->price!!}">
    </div>
    <div class="form-group">
        <input type="number" class="form-control" name="stock" placeholder="Voorraad" value="{!!$product->stock!!}">
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
