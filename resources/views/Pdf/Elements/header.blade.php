

<div class="top-bar grid-x">
    <div class="top-bar-left">
        <div class="menu-text">{{ config('app.name') }}</div>
    </div>
    <div class="top-bar-right" style="float:right">
        <div class="">{{Carbon\Carbon::now()->format('H:i:s d-m-Y')}}</div>
    </div>
</div>
