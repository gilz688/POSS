@extends("layout")
@section("content")
<div class="addtransaction">
    {{ Form::open([
        "route"        => "transactions/add",
        "autocomplete" => "on"
    ]) }}
    <table class="transaction_table">
        <tr>
            <td>
                {{ Form::label("cashierNumber", "Cashier Number") }}
            </td>
            <td>
                {{ Form::text("cashierNumber", Input::get("cashierNumber"), []) }}
            </td>
        </tr>
    </table>
        @if ($error = $errors->first("name"))
            <div class="error">
                {{ $error }}
            </div>
        @endif
        {{ Form::submit("Add Transaction") }}
    {{ Form::close() }}
</div>
@stop