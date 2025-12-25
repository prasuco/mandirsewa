<form
    id="createMandirForm"
    method="post"
    action="add-mandir.php"
    enctype="multipart/form-data"
    class="modal bg-white w-full! max-w-2xl! rounded-lg p-6 space-y-4">

    <!-- Header -->
    <div>
        <h3 class="text-base font-semibold text-gray-800">
            Create a new mandir
        </h3>
        <p class="text-sm text-gray-500 mt-1">
            Basic information used to create your mandir profile.
        </p>
    </div>

    <!-- BASIC INFO -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

        <div class="form-group">
            <label class="form-label">Mandir name</label>
            <input name="name" class="form-input" placeholder="Shiva Mandir">
        </div>

        <div class="form-group">
            <label class="form-label">Mandir slug</label>
            <input name="slug" class="form-input" placeholder="shiva-mandir">
        </div>

    </div>

    <div class="form-group">
        <label class="form-label">Short description</label>
        <input name="description" class="form-input"
            placeholder="A peaceful Hindu temple in the hills">
    </div>

    <div class="form-group">
        <label class="form-label">About mandir</label>
        <textarea name="about_content" class="form-textarea"
            placeholder="History, significance, rituals..."></textarea>
    </div>

    <!-- LOCATION -->
    <div>
        <h4 class="text-sm font-medium text-gray-700 mb-2">
            Location
        </h4>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="form-group">
                <label class="form-label">Latitude</label>
                <input name="address_lat" class="form-input" placeholder="27.7172">
            </div>
            <div class="form-group">
                <label class="form-label">Longitude</label>
                <input name="address_long" class="form-input" placeholder="85.3240">
            </div>
        </div>
    </div>

    <!-- CONTACT -->
    <div>
        <h4 class="text-sm font-medium text-gray-700 mb-2">
            Contact
        </h4>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="form-group">
                <label class="form-label">Primary contact</label>
                <input name="primary_contact" class="form-input" placeholder="+977 98XXXXXXXX">
            </div>

            <div class="form-group">
                <label class="form-label">Secondary contact</label>
                <input name="secondary_contact" class="form-input" placeholder="Optional">
            </div>
        </div>
    </div>


    <div>
        <h4 class="text-sm font-medium text-gray-700 mb-2">
            Online presence
        </h4>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <input name="website" class="form-input" placeholder="Website">
            <input name="facebook" class="form-input" placeholder="Facebook">
            <input name="youtube" class="form-input" placeholder="YouTube">
        </div>
    </div>


    <div>
        <h4 class="text-sm font-medium text-gray-700 mb-2">
            Media
        </h4>

        <div class="grid grid-cols-1 gap-4">
            <div class="form-group">
                <label class="form-label">Logo</label>
                <input type="file" name="logo" class="form-input">
            </div>
        </div>
    </div>
    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
        <button type="submit" class="btn-primary">
            Create Mandir
        </button>
    </div>

</form>