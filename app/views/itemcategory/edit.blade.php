@extends("layout")
@section("content")
<div class="additemcategory">
    {{ Form::open([
        "route"        => "items/categories/edit",
        "autocomplete" => "on"
    ]) }}
    <table class="itemcategories_table">
        <tr>
            <td>
                {{ Form::hidden('categoryId', $categoryId) }}
                {{ Form::label("name", "Category Name") }}
            </td>
            <td>
                {{ Form::text("name", $name, []) }}
            </td>
        </tr>
        <tr>
            <td>
                {{ Form::label("category", "Description") }}
            </td>
            <td>
                {{ Form::text("description", $description, []) }}
            </td>
        </tr>
    </table>
        @if ($error = $errors->first("name"))
            <div class="error">
                {{ $error }}
            </div>
        @endif
        {{ Form::submit("Edit Item Category") }}
    {{ Form::close() }}
</div>
@stop