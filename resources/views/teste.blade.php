<h1> wwwwwwwwwwwwwwww234234234234324234</h1>
<p> {{ session('token2') }}</p>
<p> {{ session('token') }}</p>
<p> {{ session('teste') }}</p>
<h2>*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/</h2>
<!-- Exibindo valores dos cookies -->
<p>Token2 (cookie): {{ request()->cookie('token2') }}</p>
<p>Token (cookie): {{ request()->cookie('token') }}</p>
<p>Teste (cookie): {{ dd(request()->cookies->all()); }}</p>
