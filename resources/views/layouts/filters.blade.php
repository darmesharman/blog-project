<div class="d-md-flex justify-content-between">
    <ul class="nav nav-pills mb-3">
        <li class="nav-item">
            <a class="nav-link @if (!request('order') || request('order') === 'latest') active @endif"
                href="{{ route('articles.index', ['order' => 'latest', 'category' => request('category'), 'search' => request('search')]) }}">
                Latest
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if (request('order') === 'popular') active @endif"
                href="{{ route('articles.index', ['order' => 'popular', 'category' => request('category'), 'search' => request('search')]) }}">
                Popular
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if (request('order') === 'random') active @endif"
                href="{{ route('articles.index', ['order' => 'random', 'category' => request('category'), 'search' => request('search')]) }}">
                Random
            </a>
        </li>
    </ul>

    <form
        method="get"
        action="{{ route('articles.index', ['order' => 'popular', 'category' => request('category')]) }}"
        class="form-inline my-2 my-lg-0"
    >
        @csrf

        <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
    </form>
</div>

