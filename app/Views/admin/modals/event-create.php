<?php
/**
 * Event Create/Edit Modal
 */
?>
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Create Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="eventForm" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="eventId">
                    <div class="mb-3">
                        <label for="eventName" class="form-label">Event Name</label>
                        <input type="text" class="form-control" id="eventName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="eventDescription" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="eventType" class="form-label">Event Type</label>
                        <select class="form-select" id="eventType" name="type" required>
                            <option value="">Select Event Type</option>
                            <option value="puja">Puja</option>
                            <option value="event">Event</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="eventImage" class="form-label">Event Image</label>
                        <input type="file" class="form-control" id="eventImage" name="image" accept="image/*">
                        <div id="eventImagePreview" class="mt-2"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveEvent">Save changes</button>
            </div>
        </div>
    </div>
</div>
