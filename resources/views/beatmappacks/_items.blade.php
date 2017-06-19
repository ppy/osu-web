<div class="beatmap-pack-items">
  @foreach ($items as $item)
  <div class="beatmap-pack-item">
    {{ $item['beatmapset_id'] }}
  </div>
  @endforeach
</div>
