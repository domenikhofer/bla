<form action="{{route('category.store')}}" method="post">
@csrf
<label for="name">Name</label>
<input type="text" name="name" id="name">
<label for="parent_id">Parent Category</label>
<select name="parent_id" id="parent_id">
    <option value="">No Category</option>
    @foreach ($categories as $category)
        <option value="{{$category->id}}">{{$category->name}}</option>
    @endforeach

</select>
<button type="submit">Save</button>
</form>
