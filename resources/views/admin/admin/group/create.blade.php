@extends("admin.layout.base")
@section('footerJs')

@endsection
@section('content')
    @if ($errors->any())
        <div class="callout callout-danger">
            @foreach ($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif
    <section class="content">
        <form   name="admin_form"
                id="admin_form"
                action="{{route('admin.group.store')}}"
                method="POST"
                class="row">
            @csrf
            @include('admin.partial.adminUser.form', ['groupList' => $groupList, 'statusList' => $statusList])
        </form>
        <div class="row pb-2">
            <div class="col-12">
                <button type="submit" form="admin_form" class="btn btn-success float-right">{{__('admin_user.btnSave')}}</button>
            </div>
        </div>
    </section>
@endsection
