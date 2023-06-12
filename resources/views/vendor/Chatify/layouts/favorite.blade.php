<div class="favorite-list-item">
    @if($user)
        <div data-id="{{ $user->id }}" data-action="0" class="avatar av-m"
            style="background-image: url('{{ asset('storage/' . $user->foto) }}');">
        </div>
        <p>{{ strlen($user->nickname) > 5 ? substr($user->nickname,0,6).'..' : $user->nickname }}</p>
    @endif
</div>
