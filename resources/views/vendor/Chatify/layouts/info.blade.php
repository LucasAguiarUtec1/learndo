
{{-- user info and avatar --}}
<div class="avatar av-l chatify-d-flex" style="background-image: url('{{ asset('storage/' . $foto) }}');"></div>
<p class="info-name">{{ $nombre }}</p>
{{-- shared photos --}}
<div class="messenger-infoView-shared">
    <p class="messenger-title"><span>Imágenes compartidas</span></p>
    <div class="shared-photos-list"></div>
</div>
