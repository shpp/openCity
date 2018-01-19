<div id="right-bar">
    <div id="right-bar-header">
        <span id="right-bar-close"><i class="material-icons">close</i></span>
        <h3 id="right-bar-heading"></h3>
    </div>
    <div id="right-bar-address"></div>
    <div id="right-bar-access"></div>
    <div class="right-bar-comments"></div>
    <div class="right-bar-comments__form">
        <hr style="margin: 0">
        <div class="input-field">
            <input type="hidden" id="right-bar-place-id__input">
            <label for="comment">Лишіть коментар</label>
            <textarea name="comment" id="comment" rows="2"></textarea>
        </div>
        @if(auth()->guest())
            {{-- todo: make modal login form --}}
            Щоб лишити коментар <a href="{{ url('/login') }}">увійдіть.</a>
        @else
            <input type="submit" class="btn" value="Додати коментар" id="right-bar-comment__submit">
        @endif
    </div>
</div>