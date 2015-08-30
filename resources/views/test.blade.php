<form action="{{ route('projects.store') }}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="text" name="name">
<input type="text" name="description">
<input type="submit">
</form>