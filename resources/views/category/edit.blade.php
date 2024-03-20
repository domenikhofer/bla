<form action="{{route('category.update',  ['category' => $category->id])}}" method="post">
@csrf
@method('PUT')
<label for="name">Name</label>
<input type="text" name="name" id="name" value="{{$category->name}}">
<label for="parent_id">Parent Category</label>
<select name="parent_id" id="parent_id">
    <option value="">No Category</option>
    @foreach ($categories as $c)
        <option value="{{$c->id}}" @if($category->parent_id == $c->id) selected @endif>{{$c->name}}</option>
    @endforeach

</select>
<button type="submit">Save</button>
</form>
