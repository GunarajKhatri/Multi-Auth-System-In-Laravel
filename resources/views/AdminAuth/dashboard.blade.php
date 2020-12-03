<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="margin-top:100px;">
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card">
<h4 class="card-header">User Profile</h4>
<div class="card-body">
<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
    </tr>
  </tbody>
</table>
<a href="{{ route('admin.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
 </a>
 <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                        @csrf
 </form>
</div>
</div>
</div>
</div>
</div>
</body>
</html>