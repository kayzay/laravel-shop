@extends("admin.layout.base")
@section('footerJs')

@endsection
@section('content')
    <div class="row row mb-4">
        <div class="col-md-3">
            @can('create', \App\Models\Admin\AdminUserGroup::class)
                <a
                    href="{{route('admin.group.create')}}"
                    type="button"
                    class="btn btn-block btn-outline-success">
                    {{getTextAdmin('add_btn')}}
                </a>
            @endcan
        </div>
    </div>
    @if(Session::has('status'))
        <div class="callout callout-success">
            {!!Session::get('status')!!}
        </div>
    @endif
    <div class="card card-outline card-primary">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{getTextAdmin('tb_name')}}</th>

                    <th scope="col">{{getTextAdmin('tb_action')}}</th>
                </tr>
                </thead>
                <tbody>
                @if (!empty($data))
                    @foreach ($data as $item)
                        <tr>
                            <th>{{$item['id']}}</th>
                            <td>{{$item['name']}}</td>

                            <td>
                                @can('update', \App\Models\Admin\AdminUserGroup::class)
                                   <a
                                        href="{{route('admin.group.edit', $item['id'])}}"
                                        title="{{getTextAdmin('bt_edit')}}"
                                        class="btn btn-info btn-sm">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-center">
                            ....
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
            @if (!empty($pagination))
                @if ($pagination['total'] > $pagination['from'])

                    <ul class="pagination pagination mt-2 ">
                        @foreach ($pagination['links'] as $item)
                            <li class="page-item">
                                <a class="page-link" href="{{$item['url']}}">
                                    {{html_entity_decode($item['label'])}}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                @endif
            @endif
        </div>
    </div>
@endsection

