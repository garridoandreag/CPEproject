@if ($grade->image_path)

    <div class="container-profile">
        <img src="{{ route('grade.icon', ['id' => $grade->id]) }}" class="picture_profile" />
    </div>

@endif
