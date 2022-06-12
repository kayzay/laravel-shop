@extends("admin.layout.base")
@section('footerJs')

@endsection
@section('content')
<div class="row row mb-4">
    <div class="col-md-3">
        @can('create', \App\Models\Shop\Product\Product::class)
            <a
                href="{{route('product.create')}}"
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
            <th scope="col">{{getTextAdmin('tb_alias')}}</th>
            <th scope="col">{{getTextAdmin('tb_category')}}</th>
            <th scope="col">{{getTextAdmin('tb_quantity')}}</th>
            <th scope="col">{{getTextAdmin('tb_status')}}</th>
            <th scope="col">{{getTextAdmin('tb_action')}}</th>
          </tr>
        </thead>
        <tbody>
            @if (!empty($data))
                @foreach ($data as $item)
                    <tr>
                        <th>{{$item['id']}}</th>
                        <td>{{$item['name']}}</td>
                        <td>{{$item['alias']}}</td>
                        <td>
                            @foreach($item['categories'] as $category)
                                <span style="display: block;">{{$category['name']}}</span>
                            @endforeach
                        </td>
                        <td>{{$item['quantity']}}</td>
                        <td>
                            <span class="badge {{($item['status_id'] == 1) ? 'bg-success': 'bg-danger'}}">
                                {{$item['status']}}
                            </span>
                        </td>
                        <td>
                            @can('update', \App\Models\Shop\Product\Product::class)
                            <a
                                href="{{route('product.edit', $item['id'])}}"
                                title="{{__('product.bt_edit')}}"
                                class="btn btn-info btn-sm">
                                    <i class="fas fa-pencil-alt"></i>
                            </a>
                            @endcan
                            @if ($item['status_id'] == 1)
                                    @can('delete', \App\Models\Shop\Product\Product::class)
                            <form
                            name="category-form"
                            id="categoryForm"
                            action="{{route('product.destroy', $item['id'])}}"
                            method="POST"
                            style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm"
                                    title="{{getTextAdmin('product.bt_inactive')}}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                                    @endcan
                            @endif
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
