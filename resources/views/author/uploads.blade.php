@extends('layouts.author')

@section('content')
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th>Title</th>
				<th>Status</th>
				<th>Region</th>
				<th>City</th>
				<th>Village</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
		@foreach ($posts as $post)
			<tr>
				<td>{{ $post->id }}</td>
				@if ($post->published)
				<td><a href="{{$post->path()}}">{{ $post->title }}</a></td>
				@else
				<td>{{ $post->title }}</td>
				@endif
				<td>{{ $post->published ? 'Published' : 'Draft' }}</td>
				<td>{{ $post->region->title }}</td>
				<td>{{ $post->city ? $post->city->title : '-' }}</td>
				<td>{{ $post->village ? $post->village->title : '-' }}</td>
				<td>{{ $post->user->name }}</td>
				<td><a href="{{ route('author.edit', ['id' => $post->id]) }}">Edit</a></td>
				<td>
					<form action="{{ route('author.destroy', ['id' => $post->id]) }}" method="post">
					@csrf
					@method('delete')
					<input type="submit" value="Delete">
					</form>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	{{ $posts->links('pagination.bootstrap') }}
@endsection
