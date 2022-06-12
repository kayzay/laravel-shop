<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{getTextAdmin('general')}}</h3>
            <div class="card-tools">
                <button type="submit" class="btn btn-tool" title="{{getTextAdmin('btnSave')}}">
                    <i class="fas fa-save"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <!--Tab-->
            <div
                class="nav flex-row nav-tabs h-100"
                id="vert-tabs-tab"
                role="tablist"
                aria-orientation="vertical">
                <a
                    class="nav-link active"
                    id="vert-tabs-base-tab"
                    data-toggle="pill"
                    href="#vert-tabs-base"
                    role="tab"
                    aria-controls="vert-tabs-base"
                    aria-selected="true">{{getTextAdmin('tab_base')}}</a>
                <a
                    class="nav-link"
                    id="vert-tabs-policy-tab"
                    data-toggle="pill"
                    href="#vert-tabs-policy"
                    role="tab"
                    aria-controls="vert-tabs-policy"
                    aria-selected="false">{{getTextAdmin('tab_policy')}}</a>
            </div>
            <div class="tab-content mt-3" id="vert-tabs-tabContent">
                <div
                    class="tab-pane text-left fade show active"
                    id="vert-tabs-base"
                    role="tabpanel"
                    aria-labelledby="vert-tabs-base-tab">
                        <div class="form-group">
                        <label for="name">{{getTextAdmin('adm_name')}}</label>
                        <input
                            name="name"
                            type="text"
                            id="name"
                            value="{{old('name', $group['name'] ?? '')}}"
                            class="form-control">
                    </div>
                </div>
                <div
                    class="tab-pane text-left fade"
                    id="vert-tabs-policy"
                    role="tabpanel"
                    aria-labelledby="vert-tabs-policy-tab">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{getTextAdmin('tb_name')}}</th>
                            <th scope="col">{{getTextAdmin('tb_show')}}</th>
                            <th scope="col">{{getTextAdmin('tb_create')}}</th>
                            <th scope="col">{{getTextAdmin('tb_update')}}</th>
                            <th scope="col">{{getTextAdmin('tb_delete')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($policyList as $item)
                                <tr>
                                <td>{{$item['id']}}</td>
                                <td>{{$item['name']}}</td>
                                <td>
                                    <div class="icheck-danger d-inline">
                                        <input
                                            name="rule[{{$item['id']}}][show]"
                                            {{(old('rule.'. $item["id"] . '.show', $policy($group['roles'], $item['id'], 's'))) ? 'checked' : ''}}
                                            type="checkbox"
                                            id="sh_{{$item['id']}}"
                                            value="1">
                                        <label for="sh_{{$item['id']}}"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="icheck-danger d-inline">
                                        <input
                                            name="rule[{{$item['id']}}][create]"
                                            type="checkbox"
                                            id="cr_{{$item['id']}}"
                                            {{old('rule.'. $item["id"] . '.create', $policy($group['roles'], $item['id'], 'c')) ? 'checked' : ''}}
                                            value="1">
                                        <label for="cr_{{$item['id']}}"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="icheck-danger d-inline">
                                        <input
                                            name="rule[{{$item['id']}}][update]"
                                            type="checkbox"
                                            id="up_{{$item['id']}}"
                                            {{old('rule.'. $item["id"] . '.update', $policy($group['roles'], $item['id'], 'u')) ? 'checked' : ''}}
                                            value="1">
                                        <label for="up_{{$item['id']}}"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="icheck-danger d-inline">
                                        <input
                                            name="rule[{{$item['id']}}][delete]"
                                            type="checkbox"
                                            id="dl_{{$item['id']}}"
                                            {{old('rule.'. $item["id"] . '.delete', $policy($group['roles'], $item['id'], 'd')) ? 'checked' : ''}}
                                            value="1">
                                        <label for="dl_{{$item['id']}}"></label>
                                    </div>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
