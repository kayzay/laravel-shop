<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <div
                class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success"
                style="display: inline-block">
                <input
                    name="available"
                    type="checkbox"
                    {{(isset($info['available']) && $info['available']) ? 'checked' : ''}}
                    class="custom-control-input"
                    value="1"
                    id="available">
                <label class="custom-control-label" for="available">
                    {{getTextAdmin('available_form')}}
                </label>
            </div>
            <div class="card-tools">
                <button type="submit" class="btn btn-tool" title="{{getTextAdmin('btnSave')}}">
                    <i class="fas fa-save"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="name">{{getTextAdmin('name')}}</label>
                <input
                    name="name"
                    type="text"
                    id="name"
                    value="{{old('name', $info['name'] ?? '')}}"
                    class="form-control">
            </div>
            <div class="form-group">
                <label for="abr">{{getTextAdmin('abr')}}</label>
                <input
                    name="abr"
                    type="text"
                    id="abr"
                    maxlength="2"
                    value="{{old('email', $info['abr'] ?? '')}}"
                    class="form-control">
            </div>
            <div class="form-group">
                <label for="local">{{getTextAdmin('local')}}</label>
                <input
                    name="local"
                    type="text"
                    id="local"
                    maxlength="5"
                    value="{{old('local', $info['local'] ?? '')}}"
                    class="form-control">
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
