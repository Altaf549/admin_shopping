<?php
/**
 * Banner Create/Edit Modal
 */
?>
<div class="modal fade" id="bannerModal" tabindex="-1" aria-labelledby="bannerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bannerModalLabel">Create Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="bannerForm" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="bannerId">
                    <div class="mb-3">
                        <label for="bannerTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="bannerTitle" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="bannerSubtitle" class="form-label">Subtitle</label>
                        <input type="text" class="form-control" id="bannerSubtitle" name="subtitle">
                    </div>
                    <div class="mb-3">
                        <label for="bannerButtonText" class="form-label">Button Text</label>
                        <input type="text" class="form-control" id="bannerButtonText" name="button_text">
                    </div>
                    <div class="mb-3">
                        <label for="bannerButtonLink" class="form-label">Button Link</label>
                        <input type="text" class="form-control" id="bannerButtonLink" name="button_link">
                    </div>
                    <div class="mb-3">
                        <label for="bannerImage" class="form-label">Banner Image</label>
                        <input type="file" class="form-control" id="bannerImage" name="image" accept="image/*">
                        <div id="bannerImagePreview" class="mt-2"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveBanner">Save changes</button>
            </div>
        </div>
    </div>
</div>
