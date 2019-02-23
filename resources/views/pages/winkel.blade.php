@include('inc/header')

<div class="container-fluid">
    <div class="page-header">
        <h1>Winkel</h1>
        <hr>
    </div>

    @if(count($producten) > 0)
        @foreach($producten as $product)
            @if($product->getCartByProductId($product->id) == 0)
                <form class="form-horizontal" method="post" action="{{url('/product/'.$product->id.'/store/winkel')}}"></form>
            @else
                <form class="form-horizontal" method="post" action="{{url('/product/'.$product->getCartIdByProductUserId($product->id, auth()->user()->id).'/update/winkel')}}">
            @endif
                @csrf
                <div style="text-align: center;" id="winkelDiv" class="row">
                    <div id="productAfbeeldingDiv" class="col-xs-12 col-sm-6 col-lg-3">
                        <img class="productAfbeelding" src="/storage/cover_images/{{$product->cover_image}}" alt="Product">
                    </div>
                    <div style="margin-top: 42px;" class="col-xs-12 col-sm-6 col-lg-2">
                        <h3 id="productTitel">{{$product->title}}</h3>
                    </div>
                    <div class="col-sm-6 col-lg-1"></div>
                    <div style="margin-top: 45px;" class="col-xs-12 col-sm-6 col-lg-2">
                        <b>€ {{number_format($product->price, 2, '.', ',')}}</b>
                    </div>
                    <div style="margin-top: 40px;" class="col-xs-12 col-sm-6 col-lg-2">
                        <select style="width: 100%; padding-top: 6px; padding-bottom: 6px;" id="voorraadSelectbox" class="tabelWinkel" name="aantal">
                            @for($i = 0; $i <= $product->stock; $i++)
                                <option>{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div style="margin-top: 40px;" class="col-xs-12 col-sm-6 col-lg-2">
                        <button style="width: 100%;" id="winkelwagenButton" class="tabelWinkel btn" type="submit" name="winkelwagen">Winkelwagen</button>
                    </div>
                </div>
                <hr>
            </form>
        @endforeach
    @endif
</div>

@include('inc/footer')
