@props(
    ['post' => $post]
)
<div class="mb-4">
    <a href="{{ route('user.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a>
    <span class="text-gray-600 text-small">{{ $post->created_at->diffForHumans() }}</span>
    <p class="mb-2">{{ $post->body }}</p>
    <div>
        @can('delete', $post)
            
       
        <form action="{{ route('posts.destroy', $post) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="text-blue-500">delete</button>
        </form>
        @endcan
    </div>
</div>
<div class="flex items-center">
    @auth
        @if (!$post->likedBy(auth()->user()))
            <form action="{{ route('posts.likes', $post) }}" class="mr-1" method="post">
                @csrf
                <button type="submit" class="text-blue-500">Like</button>
            </form>
        @else
        <form action="{{ route('posts.likes', $post) }}" class="mr-1" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="text-blue-500">un Like</button>
        </form>
        @endif
    @endauth
    <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
</div>