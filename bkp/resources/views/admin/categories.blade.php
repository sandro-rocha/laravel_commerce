<h1>Admin Categories</h1>

<ul>
   @foreach($categories as $category)
        <li>{{ $category->name }}</li>
   @endforeach
</ul> 
