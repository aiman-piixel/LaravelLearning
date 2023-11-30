<h1>Book Review Page</h1>

@foreach ($books as $book)
    <div>
        <p>{{ $book }}</p>
        {{-- Display reviews for the current book --}}
{{--         <ul>
            @foreach ($book->reviews as $review)
                <li>{{ $review->review }}</li>
            @endforeach
        </ul> --}}
    </div>    
@endforeach
