<div class="col-md-4">
    <div class="sidebar-items">
        <div class="card my-4">
            <div class="card-header bg-dark text-white">
                <h4>Категории книг</h4>
            </div>
            <div class="card-body">
                <ul class="ctg-list">
                    @foreach($categories as $category)
                    <li class="ctg-item">
                        <a href="{{route('category', $category->slug)}}" class="ctg-link d-block">{{$category->name}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="card my-3">
            <div class="card-header bg-dark text-white">
                <h4>Недавние книги</h4>
            </div>
            <div class="card-body">
                @foreach($recent_books as $book)
                <div class="recent-book-list">
                    <a href="{{route('book-details', $book->id)}}" class="d-flex flex-row mb-3">
                        <div class="book-img mr-2"><img src="{{$book->image_url}}" alt="" width="80"></div>
                        <div class="book-text">
                            <p>{{$book->title}}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
