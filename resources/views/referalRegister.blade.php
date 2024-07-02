<h1>Register</h1>
<form action="{{ route('user.register') }}" method="post">
    @csrf

    <input type="text" name="name" placeholder="name">

    @error('name')
          <span>{{ $message }}</span>
    @enderror
    <br><br>
    <input type="email" name="email" id="" placeholder="email">
    @error('email')
    <span>{{ $message }}</span>
@enderror
<br><br>
<input type="text" name="referal_code" placeholder="referl" value="{{ $referal }}" style="pointer-events:none; background-colloer:light-gray;">
<br><br>

<input type="password" name="password" placeholder="password">
<br>

<input type="submit" value="register">
</form>

@if (Session::has('success'))
    <p style="color:green">{{ Session::get('success') }}</p>
@endif



@if (Session::has('error'))
    <p style="color:red">{{ Session::get('error') }}</p>
@endif
