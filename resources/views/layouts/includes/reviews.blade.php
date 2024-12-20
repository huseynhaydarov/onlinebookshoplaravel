<div class="comments-section">
    <div class="card card-body my-4" id="review-section">
        <div class="comments-area">
        <h4 class="text-center mb-2"><i class="fas fa-comments"></i> {{$book_reviews->count()}} Отзывов</h4>

            @foreach($book_reviews as $review)
            <div class="single-comment my-2">
                <div class="card card-body bg-light">
                    <div class="author-info mb-2 d-flex flex-row">
                        <div class="comment-user-img mr-3">
                            <img src="{{$review->user->image? $review->user->image_url : $book->default_img}}" alt="" width="60">
                        </div>
                        <div>
                            <h5>{{$review->user->name}}</h5>
                        </div>
                    </div>
                    <p>{!! Markdown::convertToHtml(e($review->body)) !!}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="card card-body my-4">
        @if(Auth::check())
            <div class="comment-form">
                <h4 class="text-center">Оставить отзыв</h4>
                <form action="{{route('book.review', $book->id)}}" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea id="" name="body" rows="5" class="form-control {{$errors->has('body')? 'is-invalid': ''}}"></textarea>
                        @if($errors->has('body'))
                          <span class="invalid-feedback">
                              <strong>{{$errors->first('body')}}</strong>
                          </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Отправить отзыв</button>
                </form>
            </div>
        @else
            <div><a href="{{url('login')}}">Войдите здесь</a> чтобы оставить отзыв.</div>
        @endif
    </div>
</div>
