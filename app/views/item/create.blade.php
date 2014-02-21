@extends("layout")
@section("content")
<div class="addItem-form">
    {{ Form::open([
        "route"        => "items/add",
        "autocomplete" => "off"
    ]) }}
    <table style="width:300px">
        <tr>
            <td>
                {{ Form::label("barcode", "Barcode") }}
            </td>
            <td>
                {{ Form::text("barcode", Input::get("barcode"), []) }}
            </td>
        </tr>
		<tr>
            <td>
                {{ Form::label("name", "Name") }}
            </td>
            <td>
                {{ Form::text("name", Input::get("name"), []) }}
            </td>
        </tr>
		<tr>
            <td>
                {{ Form::label("price", "Price") }}
            </td>
            <td>
                {{ Form::text("price", Input::get("price"), []) }}
            </td>
        </tr>
		<tr>
            <td>
                {{ Form::label("description", "Description") }}
            </td>
            <td>
                {{ Form::text("description", Input::get("description"), []) }}
            </td>
        </tr>
		<tr>
            <td>
                {{ Form::label("size_or_weight", "Size/Weight") }}
            </td>
            <td>
                {{ Form::text("size_or_weight", Input::get("size_or_weight"), []) }}
            </td>
        </tr>
		<tr>
            <td>
                {{ Form::label("category_id", "Category") }}
            </td>
            <td>
                {{ Form::text("category_id", Input::get("category_id"), []) }}
            </td>
        </tr>
    </table>
        {{ Form::submit("Add Item") }}
    {{ Form::close() }}
</div>
@stop