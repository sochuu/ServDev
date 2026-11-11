@csrf

<label>
    Дата
    <input type="date" name="date" value="{{ old('date', isset($article) ? $article->date->format('Y-m-d') : '') }}" required>
    @error('date')<span class="error">{{ $message }}</span>@enderror
</label>

<label>
    Название
    <input type="text" name="name" value="{{ old('name', $article->name ?? '') }}" required>
    @error('name')<span class="error">{{ $message }}</span>@enderror
</label>

<label>
    Превью (имя файла в public)
    <input type="text" name="preview_image" value="{{ old('preview_image', $article->preview_image ?? 'preview.jpg') }}" required>
    @error('preview_image')<span class="error">{{ $message }}</span>@enderror
</label>

<label>
    Полное изображение
    <input type="text" name="full_image" value="{{ old('full_image', $article->full_image ?? 'full.jpeg') }}" required>
    @error('full_image')<span class="error">{{ $message }}</span>@enderror
</label>

<label>
    Краткое описание
    <input type="text" name="short_desc" value="{{ old('short_desc', $article->short_desc ?? '') }}">
    @error('short_desc')<span class="error">{{ $message }}</span>@enderror
</label>

<label>
    Текст статьи
    <textarea name="desc" rows="8" required>{{ old('desc', $article->desc ?? '') }}</textarea>
    @error('desc')<span class="error">{{ $message }}</span>@enderror
</label>
