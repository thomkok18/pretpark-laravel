@include('inc/header')

<div class="container-fluid">
    <div class="page-header">
        <h1>Winkelwagen</h1>
        <hr>
    </div>

    @foreach($cart_items as $cart_item)
        @if($cart_item->cart_id == auth()->user()->id)
            <div class="row">
                <div class="col-xs-12 col-md-2">
                    <img id="reactieProfielfoto" src="{{url('/storage/cover_images/'.$cart_item->product->cover_image)}}" alt="{{$cart_item->product->title}}">
                </div>
                <div class="col-xs-12 col-md-2">
                    <p style="margin-top: 8px; margin-bottom: 8px;">{{$cart_item->product->title}}</p>
                </div>
                <div class="col-xs-12 col-md-3">
                    <form action="{{url('/winkelwagen/destroy/'.$cart_item->id)}}" method="POST">
                        @csrf
                        {{method_field('DELETE')}}
                        <input style="padding:0; margin-top:8px; margin-bottom: 15px;" type="submit" class="btn btn-light text-danger" value="Verwijderen">
                    </form>
                </div>
                <div class="col-xs-12 col-md-3">
                    <form action="{{url('/product/'.$cart_item->id.'/update/winkelwagen')}}" method="post">
                        @csrf
                        <select onchange="this.form.submit()" style="width: 100%; padding-top: 6px; padding-bottom: 6px;" id="voorraadSelectbox" class="tabelWinkel" name="aantal">
                            @for($i = 0; $i <= $cart_item->product->stock; $i++)
                                <option {{$i == $cart_item->aantal ? 'selected' : '' }}>{{$i}}</option>
                            @endfor
                        </select>
                    </form>
                </div>
                <div style="margin-top: 8px; margin-bottom: 8px;" class="col-xs-12 col-md-2">
                    <b>€ {{number_format($cart_item->aantal * $cart_item->product->price, 2, '.', ',')}}</b>
                </div>
            </div>
            <hr style="margin-top: 0;">
        @endif
        @if($cart_item->getCartByUserId($cart_item->user_id) == 0 && count($cart_items) == 0)
            <p style="margin-bottom: 30px;">Er zijn geen producten in het winkelwagentje geplaatst.</p>
            @break
        @endif
    @endforeach
    <div class="row">
        <div class="col-xs-12 col-md-2"></div>
        <div class="col-xs-12 col-md-2"></div>
        <div class="col-xs-12 col-md-3"></div>
        <div class="col-xs-12 col-md-3"></div>
        <div class="col-xs-12 col-md-2 row">
            <b class="col-xs-12 col-sm-12">Subtotaal</b>
            <b class="col-xs-12 col-sm-12">€ {{number_format($product->getPrijsByProductId($cart->id), 2, '.', ',')}}</b>
            <p class="col-xs-12 col-sm-12" style="margin:0;">Verzendskosten</p>
            <p class="col-xs-12 col-sm-12" style="margin:0;">€ {{number_format($product->getVerzendskosten($product->getCartItemByCartId(auth()->user()->id)), 2, '.', ',')}}</p>
            <b class="col-xs-12 col-sm-12">Totaal</b>
            <b class="col-xs-12 col-sm-12">€ {{number_format($product->getPrijsByProductId($cart->id) + $product->getVerzendskosten($product->getCartItemByCartId(auth()->user()->id)), 2, '.', ',')}}</b>
            @if($product->getCartItemByCartId(auth()->user()->id) > 0)
                <form class="col-xs-12 col-sm-12" action="{{url('/winkelwagen/betalen'.$cart_item->cart_id.'/destroy')}}" method="POST">
                    @csrf
                    {{method_field('DELETE')}}
                    <div style="margin-top: 40px;">
                        <button style="width: 100%;" id="winkelwagenButton" class="tabelWinkel btn" type="submit" name="betalen">Betalen</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>

@include('inc/footer')
