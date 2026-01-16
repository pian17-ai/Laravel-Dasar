<h1>Blog Sederhana</h1>
<!-- FORM INPUT -->
<form action="/posts" method="POST">
  @csrf <!-- Wajib di Laravel -->
  <input type="text" name="title" placeholder="Judul">
  <textarea name="content" placeholder="Isi konten"></textarea>
  <button type="submit">Simpan</button>
</form>
<hr>
<!-- LIST DATA -->
<ul>
  @foreach($posts as $post)
    <li>
      <strong>{{ $post->title }}</strong>
      <p>{{ $post->content }}</p>
    </li>
  @endforeach
</ul>