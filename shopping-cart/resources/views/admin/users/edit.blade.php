<div class="p2">
    <input type="hidden" id="id" name="id" value="{{ $user->id}}">
    <div class="form-group">
        <label for="name">Tên người dùng</label>
        <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control"
            placeholder="name user">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="{{ $user->email }}" class="form-control"
            placeholder="email">
    </div>
    <div class="form-group">
        <div class="form-group">
            <label for="my-select">Role</label>
            <select id="my-select" class="form-control" name="type">
                @if ($user->type == 'ADMIN')
                    <option value="ADMIN" selected>ADMIN</option>
                @else
                    <option value="ADMIN">ADMIN</option>
                    <option value="USER" selected>USER</option>
                @endif
            </select>
        </div>
    </div>
    <div class="form-group mt-2">
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </div>
</div>