<form class="form-horizontal" method="POST" action="{{ route('email.send') }}">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="subject" class="col-md-4 control-label">@lang('dashboard::main.subject')</label>

        <div class="col-md-6">
            <input id="subject" type="text" class="form-control" name="subject" required>
            @if ($errors->has('subject'))
                <span class="help-block">
                <strong>{{ $errors->first('subject') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="content" class="col-md-4 control-label">@lang('dashboard::main.message')</label>
        <div class="col-md-6">
            <textarea id="content" class="form-control" name="content" required></textarea>
            @if ($errors->has('content'))
                <span class="help-block">
                <strong>{{ $errors->first('content') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="date" class="col-md-4 control-label">@lang('dashboard::main.something_date')</label>
        <div class="col-md-6">
            <input id="date" type="date" class="form-control" name="date" required>
            @if ($errors->has('date'))
                <span class="help-block">
                <strong>{{ $errors->first('date') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="agreement" value="1"> @lang('dashboard::main.something_agreement')
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                @lang('dashboard::main.send')
            </button>
        </div>
    </div>
</form>