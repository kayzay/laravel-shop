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
        <form name="group_form"
              id="group_form"
              action="{{route('admin.group.update', $group['id'])}}"
              method="POST"
              class="row">
            @csrf
            @method('PATCH')
            @include('admin.partial.adminUser.groupForm', [
                    'policyList' => $policyList,
                    'group' => $group,
                    'policy' => $policy
                    ])
        </form>
        <div class="row pb-2">
            <div class="col-12">
                <button type="submit" form="group_form"
                        class="btn btn-success float-right">{{getTextAdmin('btnSave')}}</button>
            </div>
        </div>
    </section>
@endsection
