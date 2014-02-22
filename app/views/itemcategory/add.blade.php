@extends("layout")
@section("content")
<div class="additemcategory">
    {{ Form::open([
        "route"        => "items/categories/add",
        "autocomplete" => "off"
    ]) }}
    <table class="itemcategories_table">
        <tr>
            <td>
                {{ Form::label("name", "Category Name") }}
            </td>
            <td>
                {{ Form::text("name", Input::get("name"), []) }}
            </td>
        </tr>
        <tr>
            <td>
                {{ Form::label("category", "Description") }}
            </td>
            <td>
                {{ Form::text("description", Input::get("description"), []) }}
            </td>
        </tr>
    </table>
        @if ($error = $errors->first("name"))
            <div class="error">
                {{ $error }}
            </div>
        @endif
        {{ Form::submit("Add Item Category") }}
    {{ Form::close() }}
</div>
@stop