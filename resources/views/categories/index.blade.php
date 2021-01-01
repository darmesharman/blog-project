<div class="text-right">
    <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <h5 class="d-inline">Categories</h5>
    </a>
    <ul class="dropdown-menu" style="z-index: 3">
        <li class="dropdown-item">
            <a class="nav-link text-capitalize border-bottom text-center p-0 m-0
                    @if (!request('category')) border border-primary rounded @endif"
                href="{{ route('articles.index') }}">
                All
            </a>
        </li>
        @foreach ($categories as $category)
            <li class="dropdown-item">
                <a class="nav-link text-capitalize border-top text-center p-0 m-0
                        @if (request('category') == $category->id) border border-primary rounded @endif"
                    href="{{ route('articles.index', ['category' => $category->id]) }}">
                    {{ $category->name }}
                </a>
            </li>

            <div class="d-flex justify-content-center mb-0">
                @can('update', $category)
                    <form method="get" action="{{ route('categories.edit', ['category' => $category]) }}">
                        @csrf

                        <button class="btn btn-primary py-0 mx-1">edit</button>
                    </form>
                @endcan

                @can('delete', $category)
                    <form method="post" action="{{ route('categories.destroy', ['category' => $category]) }}">
                        @csrf
                        @method('delete')

                        <button class="btn btn-danger py-0 mx-1">delete</button>
                    </form>
                @endcan

            </div>

        @endforeach

        @can('create', App\Models\Category::class)
            <form method="post" action="{{ route('categories.store') }}" class="mt-3 border-top pt-1" style="background-color: silver">
                @csrf

                <div class="d-flex flex-column align-items-center">
                    <input type="text" class="border border-primary rounded mx-2 text-center" name="name" placeholder="New category" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <button class="btn btn-primary py-0 my-1" type="submit">Add</button>
                </div>
            </form>
        @endcan

    </ul>
</div>
