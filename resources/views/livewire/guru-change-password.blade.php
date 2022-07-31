<div>
    <div class="form-group">
        <label>Password Sekarang</label>
        <input wire:model="oldPassword" type="password" class="form-control" name="oldPassword">
        @error('oldPassword')
            <h6 class="text-danger">{{ $message }}</h6>
        @enderror
    </div>
    <div class="form-group">
        <label>Password Baru</label>
        <input wire:model="newPassword" type="password" class="form-control" name="newPassword">
        @error('newPassword')
            <h6 class="text-danger">{{ $message }}</h6>
        @enderror
    </div>
    <div class="form-group">
        <label>Konfirmasi Password Baru</label>
        <input wire:model="newPasswordConfirmation" type="password" class="form-control" name="newPasswordConfirmation">
        @error('newPasswordConfirmation')
            <h6 class="text-danger">{{ $message }}</h6>
        @enderror
    </div>
    <button wire:click="changePassword" type="submit" class="btn btn-gradient-primary float-right">Submit</button>
</div>
