@extends('layouts.admin')

@section('content')
<form action="{{ route('admin.logos.store') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <select name="type">
    <option value="pti">Logo PTI</option>
    <option value="footer">Logo Footer</option>
    <option value="client">Logo Client</option>
  </select>

  <input type="file" name="logo">

  <button type="submit">Upload</button>
</form>
@endsection