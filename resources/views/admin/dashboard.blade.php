@extends("admin.layout.base")
@section('footerJs')

@endsection
@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <span>user name: </span>
        {{adminAuth()->user()->name}}
    </div>
  </div>
@endsection

