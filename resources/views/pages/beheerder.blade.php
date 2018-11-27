@include('inc/header')

<div class="container-fluid">
    <div class="page-header">
        <h1>Admin overzicht</h1>
        <hr>
    </div>

    <div>
        <div>
            <h3 style="float:left;">Gebruikers</h3>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Id</th>
                <th>Naam</th>
                <th>Email</th>
            </tr>
            </thead>
            @if(count($users) > 0)
                @foreach($users as $user)
                    <tbody>
                    <tr>
                        @if($user->id == 1)
                            <th><input class="prullenbak" type="image" src="/storage/cover_images/prullenbakDicht.jpg"></th>
                        @else
                            <form action="/beheerder/destroy/gebruiker/{{$user->id}}" method="POST">
                                @csrf
                                {{method_field('DELETE')}}
                                <th><input class="prullenbak" type="image" src="/storage/cover_images/prullenbakOpen.jpg"></th>
                            </form>
                        @endif
                        <th class="tabelText"><a id="formAttractieButton" class="btn btn-primary" role="button" href="/beheerder/gebruiker/edit/{{$user->id}}">{{$user->id}}</a></th>
                        <th class="tabelText">{{$user->name}}</th>
                        <th class="tabelText">{{$user->email}}</th>
                    </tr>
                    </tbody>
                @endforeach
            @endif
        </table>
        {{$users->render()}}
        <br>
    </div>

    <div>
        <div>
            <h3 style="float:left;">Voorraad</h3>
            <a style="float:right;" id="formAttractieToevoegenButton" class="btn btn-secondary" role="button" href="{{url('/create/product')}}">+</a>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Id</th>
                <th>Titel</th>
                <th>Omschrijving</th>
                <th>Voorraad</th>
            </tr>
            </thead>
            @if(count($producten) > 0)
                @foreach($producten as $product)
                    <tbody>
                    <tr>
                        <form action="/beheerder/destroy/product/{{$product->id}}" method="POST">
                            @csrf
                            {{method_field('DELETE')}}
                            <th><input class="prullenbak" type="image" src="/storage/cover_images/prullenbakOpen.jpg"></th>
                        </form>
                        <th class="tabelText"><a id="formAttractieButton" class="btn btn-primary" role="button" href="/beheerder/product/edit/{{$product->id}}">{{$product->id}}</a></th>
                        <th class="tabelText">{!!$product->title!!}</th>
                        <th class="tabelText">{!!$product->description!!}</th>
                        <th class="tabelText">{!!$product->stock!!}</th>
                    </tr>
                    </tbody>
                @endforeach
            @endif
        </table>
        {{$producten->render()}}
        <br>
    </div>

    <div>
        <div>
            <h3 style="float:left;">Attracties</h3>
            <a style="float:right;" id="formAttractieToevoegenButton" class="btn btn-secondary" role="button" href="{{url('/create/attractie')}}">+</a>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Id</th>
                <th>Titel</th>
                <th>Omschrijving</th>
            </tr>
            </thead>
            @if(count($attracties) > 0)
                @foreach($attracties as $attractie)
                    <tbody>
                    <tr>
                        <form action="/beheerder/destroy/attractie/{{$attractie->id}}" method="POST">
                            @csrf
                            {{method_field('DELETE')}}
                            <th><input class="prullenbak" type="image" src="/storage/cover_images/prullenbakOpen.jpg"></th>
                        </form>
                        <th class="tabelText"><a id="formAttractieButton" class="btn btn-primary" role="button" href="/beheerder/attractie/edit/{{$attractie->id}}">{{$attractie->id}}</a></th>
                        <th class="tabelText">{!!$attractie->title!!}</th>
                        <th class="tabelText">{!!$attractie->description!!}</th>
                    </tr>
                    </tbody>
                @endforeach
            @endif
        </table>
        {{$attracties->render()}}
        <br>
    </div>
</div>

@include('inc/footer')
