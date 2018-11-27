@if(session('success'))
    <div class="alert alert-success">
        <b>{{session('success')}}</b>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        <b>{{session('error')}}</b>
    </div>
@endif
